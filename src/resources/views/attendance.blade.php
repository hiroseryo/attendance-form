@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')
<div class="date__container">
    <div class="date-nav">
        <a href="{{ route('attendance', ['date' => $prevDate]) }}" class="button">&lt;</a>
        <span class="date">{{ date('Y/m/d', strtotime($date)) }}</span>
        <a href="{{ route('attendance', ['date' => $nextDate]) }}" class="button">&gt;</a>
    </div>
    <div class="attendance-table">
        <table class="attendance-table__inner">
            <tr class="attendance-table__row">
                <th class="attendance-table__header">名前</th>
                <th class="attendance-table__header">開始時間</th>
                <th class="attendance-table__header">終了時間</th>
                <th class="attendance-table__header">休憩時間</th>
                <th class="attendance-table__header">勤務時間</th>
            </tr>
            @foreach($attendances as $attendance)
            <tr class="attendance-table__row">
                <td class="attendance-table__item">{{ $attendance->user->name }}</td>
                <td class="attendance-table__item">{{ $attendance->start_time ? date('H:i:s', strtotime($attendance->start_time)) : '-' }}</td>
                <td class="attendance-table__item">{{ $attendance->end_time ? date('H:i:s', strtotime($attendance->end_time)) : '-' }}</td>
                <td class="attendance-table__item">{{ $attendance->rest_time ? $attendance->rest_time : '-' }}</td>
                <td class="attendance-table__item">{{ $attendance->work_time ? $attendance->work_time : '-' }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="pagination-container">
        {{ $attendances->appends(['date' => $date])->links('vendor.pagination.custom') }}
    </div>
</div>
<div class="small">
    <small>Atte,inc.</small>
</div>
@endsection