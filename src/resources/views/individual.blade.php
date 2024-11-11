@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/individual.css') }}">
@endsection

@section('content')
<div class="individual__container">
    <div class="form-container">
        <form action="{{ route('attendance.individual') }}" method="GET" class="individual-name">
            <input type="text" name="name" value="{{ $name }}" placeholder="名前で検索">
            <button type="submit" class="btn">検索</button>
            <a href="{{ route('attendance.individual') }}" class="reset-btn">リセット</a>
        </form>
    </div>
    <div class="individual-table">
        <table class="individual-table__inner">
            <tr class="individual-table__row">
                <th class="individual-table__header">名前</th>
                <th class="individual-table__header">日付</th>
                <th class="individual-table__header">開始時間</th>
                <th class="individual-table__header">終了時間</th>
                <th class="individual-table__header">休憩時間</th>
                <th class="individual-table__header">勤務時間</th>
            </tr>
            @foreach($attendances as $attendance)
            <tr class="individual-table__row">
                <td class="individual-table__item">{{ $attendance->user->name }}</td>
                <td class="individual-table__item">{{ date('Y/m/d', strtotime($attendance->date)) }}</td>
                <td class="individual-table__item">{{ $attendance->start_time ? date('H:i:s', strtotime($attendance->start_time)) : '-' }}</td>
                <td class="individual-table__item">{{ $attendance->end_time ? date('H:i:s', strtotime($attendance->end_time)) : '-' }}</td>
                <td class="individual-table__item">{{ $attendance->rest_time ? $attendance->rest_time : '-' }}</td>
                <td class="individual-table__item">{{ $attendance->work_time ? $attendance->work_time : '-' }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="pagination-container">
        {{ $attendances->links('vendor.pagination.individual') }}
    </div>
</div>
<div class="small">
    <small>Atte,inc.</small>
</div>
@endsection