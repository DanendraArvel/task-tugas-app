@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    .dashboard { background: white; padding: 30px; border-radius: 10px; }
    .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
    .header h1 { color: #333; }
    .logout-btn { 
        padding: 10px 20px; 
        background: #dc3545; 
        color: white; 
        border: none; 
        border-radius: 5px; 
        cursor: pointer; 
    }
    .logout-btn:hover {
        background: #c82333; 
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        transition: cubic-bezier(0.215, 0.610, 0.355, 1) ease-in-out;
        -webkit-transition: cubic-bezier(0.215, 0.610, 0.355, 1) ease-in-out;
        -moz-transition: cubic-bezier(0.215, 0.610, 0.355, 1) ease-in-out;
        -ms-transition: cubic-bezier(0.215, 0.610, 0.355, 1) ease-in-out;
        -o-transition: cubic-bezier(0.215, 0.610, 0.355, 1) ease-in-out;
        transform: scale(105%);
        -webkit-transform: scale(105%);
        -moz-transform: scale(105%);
        -ms-transform: scale(105%);
        -o-transform: scale(105%);
    }
    .menu { margin-top: 30px; }
    .menu a { 
        display: inline-block;
        padding: 15px 30px; 
        background: #007bff; 
        color: white; 
        text-decoration: none; 
        border-radius: 5px; 
        margin-right: 10px;
    }
    .menu a:hover { 
        background: #0056b3;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        transition: cubic-bezier(0.215, 0.610, 0.355, 1) ease-in-out;
        -webkit-transition: cubic-bezier(0.215, 0.610, 0.355, 1) ease-in-out;
        -moz-transition: cubic-bezier(0.215, 0.610, 0.355, 1) ease-in-out;
        -ms-transition: cubic-bezier(0.215, 0.610, 0.355, 1) ease-in-out;
        -o-transition: cubic-bezier(0.215, 0.610, 0.355, 1) ease-in-out;
        transform: scale(105%);
        -webkit-transform: scale(105%);
        -moz-transform: scale(105%);
        -ms-transform: scale(105%);
        -o-transform: scale(105%);
        }
</style>

<div class="dashboard">
    <div class="header">
        <div>
            <h1>Dashboard</h1>
            <p>Selamat datang, <strong>{{ session('name') }}</strong>!</p>
        </div>
        
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <p>Task App</p>

    @if (Auth::user()->token == 'admin')
    <div class="menu">
        <a href="/tasks">Kelola Task</a>
    </div>
    @endif

    @if (Auth::user()->token == 'siswa')
    <div class="menu">
        <a href="/tasks">Lihat Tugas</a>
    </div>
    @endif
</div>
@endsection