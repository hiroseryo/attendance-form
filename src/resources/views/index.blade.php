@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection
@section('js')
<script src="{{ asset('js/attendance.js') }}"></script>
@endsection

@section('content')
<div class="attendance__container">
    <div class="attendance-form__heading">
        <h2>{{ Auth::user()->name }}</h2>
        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
    </div>

    <div class="button-attendance">
        <form action="{{ route('attendance.startWork') }}" method="post">
            @csrf
            <button type="submit" class="btn" {{ $canStartWork ? '' : 'disabled' }}>勤務開始</button>
        </form>

        <form action="{{ route('attendance.endWork') }}" method="post">
            @csrf
            <button type="submit" class="btn" {{ $canEndWork ? '' : 'disabled' }}>勤務終了</button>
        </form>
    </div>
    <div class="button-attendance__break">
        <form action="{{ route('attendance.startRest') }}" method="post">
            @csrf
            <button type="submit" class="btn" {{ $canStartRest ? '' : 'disabled' }}>休憩開始</button>
        </form>

        <form action="{{ route('attendance.endRest') }}" method="post">
            @csrf
            <button type="submit" class="btn" {{ $canEndRest ? '' : 'disabled' }}>休憩終了</button>
        </form>
    </div>
</div>
<div class="small">
    <small>Atte,inc.</small>
</div>
@endsection