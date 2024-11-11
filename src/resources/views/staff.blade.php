@extends('layouts/app')

@section('content')
<div class="staff-container">
    @foreach($users as $user)
    <div class="staff__user">{{ $user->name }}</div>
    @endforeach
</div>
<div class="small">
    <small>Atte,inc.</small>
</div>

<style>
    .staff-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding: 10px;
    }

    .staff__user {
        padding: 8px 12px;
        flex: 0 1 auto;
    }

    .small {
        align-items: center;
        height: 60px;
        margin: 0 auto;
        display: flex;
        width: 36%;
        justify-content: center;
    }
</style>
@endsection