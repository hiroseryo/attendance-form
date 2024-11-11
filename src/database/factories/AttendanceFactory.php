<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\User;
use App\Models\Rest;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d');

        $startTime = Carbon::parse($date . ' ' . rand(8, 10) . ':' . rand(0, 59) . ':' . rand(0, 59));

        $workDuration = rand(2, 8) * 60;
        $endTime = (clone $startTime)->addMinutes($workDuration);

        return [
            'user_id' => User::factory(),
            'date' => $date,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Attendance $attendance) {
            $restCount = rand(0,2);

            $restTimes = [];

            for ($i = 0; $i < $restCount; $i++) {
                $restDuration = rand(15, 60);

                $restStartTime = $this->faker->dateTimeBetween(
                    $attendance->start_time,
                    $attendance->end_time->subMinutes($restDuration)
                );

                $restEndTime = Carbon::parse($restStartTime)->addMinutes($restDuration);

                $overlap = false;
                foreach ($restTimes as $existingRest) {
                    if (
                        ($restStartTime >= $existingRest['start_time'] && $restStartTime < $existingRest['end_time']) ||
                        ($restEndTime > $existingRest['start_time'] && $restEndTime <= $existingRest['end_time'])
                    ) {
                        $overlap = true;
                        break;
                    }
                }

                if (!$overlap) {
                    Rest::create([
                        'attendance_id' => $attendance->id,
                        'start_time' => $restStartTime,
                        'end_time' => $restEndTime,
                    ]);

                    $restTimes[] = [
                        'start_time' => $restStartTime,
                        'end_time' => $restEndTime,
                    ];
                }
            }
        });
    }
}
