<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\Rest;
use Carbon\Carbon;
use App\Models\User;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today()->toDateString();

        $attendance = Attendance::where('user_id', $user->id)->whereDate('date', $today)->latest()->first();

        $currentAttendance = Attendance::where('user_id', $user->id)->whereDate('date', Carbon::today()->toDateString())->whereNull('end_time')->first();

        $canStartWork = false;
        $canEndWork = false;
        $canStartRest = false;
        $canEndRest = false;

        if (!$attendance || $attendance->end_time) {
            $canStartWork = true;
        } else {
            $activeRest = Rest::where('attendance_id', $attendance->id)->whereNull('end_time')->latest()->first();

            if ($activeRest) {
                $canEndRest = true;
            } else {
                $canStartRest = true;
                $canEndWork = true;
            }
        }

        return view('index', compact('canStartWork', 'canEndWork', 'canStartRest', 'canEndRest'));
    }
    public function startAttendance()
    {
        $user = Auth::user();
        $today = Carbon::today();

        $attendance = new Attendance();
        $attendance->user_id = $user->id;
        $attendance->date = $today;
        $attendance->start_time = Carbon::now();
        $attendance->save();

        session()->flash('message', '勤務を開始しました。');

        return redirect()->route('index');
    }

    public function endAttendance()
    {
        $user = Auth::user();
        $today = Carbon::today()->toDateString();

        $attendance = Attendance::where('user_id', $user->id)->whereDate('date', $today)->whereNull('end_time')->latest()->first();

        if ($attendance) {
            $attendance->end_time = Carbon::now();
            $attendance->save();

            session()->flash('message', 'おつかれさまでした!');
        }

        return redirect()->route('index');
    }

    public function startRest()
    {
        $user = Auth::user();
        $today = Carbon::today()->toDateString();

        $attendance = Attendance::where('user_id', $user->id)->whereDate('date', $today)->whereNull('end_time')->latest()->first();

        if ($attendance) {
            $rest = new Rest();
            $rest->attendance_id = $attendance->id;
            $rest->start_time = Carbon::now();
            $rest->save();

            session()->flash('message', '休憩を開始しました。');
        }

        return redirect()->route('index');
    }

    public function endRest()
    {
        $user = Auth::user();
        $today = Carbon::today()->toDateString();

        $attendance = Attendance::where('user_id', $user->id)->whereDate('date', $today)->whereNull('end_time')->latest()->first();

        if ($attendance) {
            $rest = Rest::where('attendance_id', $attendance->id)->whereNull('end_time')->latest()->first();

            if ($rest) {
                $rest->end_time = Carbon::now();
                $rest->save();

                session()->flash('message', '休憩を終了しました。');
            }
        }

        return redirect()->route('index');
    }

    public function attendance(Request $request)
    {
        $date = $request->input('date', Carbon::today()->toDateString());

        $attendances = Attendance::with('user', 'rests')->whereDate('date', $date)->paginate(5);

        foreach ($attendances as $attendance) {
            $totalRestTime = 0;
            foreach ($attendance->rests as $rest) {
                if ($rest->start_time && $rest->end_time) {
                    $restDuration = strtotime($rest->end_time) - strtotime($rest->start_time);
                    $totalRestTime += $restDuration;
                }
            }
            $attendance->rest_time = gmdate('H:i:s', $totalRestTime);

            if ($attendance->start_time && $attendance->end_time) {
                $workDuration = strtotime($attendance->end_time) - strtotime($attendance->start_time) - $totalRestTime;
                $attendance->work_time = gmdate('H:i:s', $workDuration);
            } else {
                $attendance->work_time = null;
            }
        }

        $dateCarbon = Carbon::parse($date);
        $prevDate = $dateCarbon->copy()->subDay()->toDateString();
        $nextDate = $dateCarbon->copy()->addDay()->toDateString();

        return view('attendance', compact('attendances', 'date', 'prevDate', 'nextDate'));
    }

    public function staff()
    {
        $users = User::select('name')->get();
        return view('staff', compact('users'));
    }

    public function individual(Request $request)
    {
        $name = $request->input('name', '');

        $attendanceQuery = Attendance::with('user', 'rests');

        if ($name) {
            $attendanceQuery->whereHas('user', function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            });
        }

        $attendances = $attendanceQuery->orderBy('date', 'desc')->paginate(5);

        foreach ($attendances as $attendance) {
            $totalRestTime = 0;
            foreach ($attendance->rests as $rest) {
                if ($rest->start_time && $rest->end_time) {
                    $restDuration = strtotime($rest->end_time) - strtotime($rest->start_time);
                    $totalRestTime += $restDuration;
                }
            }
            $attendance->rest_time = gmdate('H:i:s', $totalRestTime);

            if ($attendance->start_time && $attendance->end_time) {
                $workDuration = strtotime($attendance->end_time) - strtotime($attendance->start_time) - $totalRestTime;
                $attendance->work_time = gmdate('H:i:s', $workDuration);
            } else {
                $attendance->work_time = null;
            }
        }

        return view('individual', compact('attendances', 'name'));
    }
}
