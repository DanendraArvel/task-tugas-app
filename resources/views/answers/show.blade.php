@extends('layouts.app')

@section('title', 'Detail Jawaban')

@section('content')
<style>
    .detail-container { background: white; padding: 30px; border-radius: 10px; max-width: 800px; margin: 0 auto; }
    .detail-container h1 { margin-bottom: 20px; color: #333; }
    .detail-row { display: flex; padding: 15px 0; border-bottom: 1px solid #eee; }
    .detail-label { width: 200px; font-weight: bold; color: #555; }
    .detail-value { flex: 1; color: #333; }
    .actions { margin-top: 30px; display: flex; gap: 10px; }
    .btn { 
        padding: 10px 20px; 
        text-decoration: none; 
        border-radius: 5px; 
        display: inline-block;
    }
    .btn:hover {
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
    .btn-secondary { background: #6c757d; color: white; }
    .btn-secondary:hover { 
        background: #5a6268; 
    }
    .btn-third { background: #007bff; color: white; }
    .btn-third:hover { 
        background: #0056b3; 
    }
    .btn-warning { background: #ffc107; color: #333; }
    .btn-warning:hover { 
        background: #e0a800; 
    }
    .btn-danger { background: #dc3545; color: white; border: none; cursor: pointer; }
    .btn-danger:hover { 
        background: #c82333; 
    }
</style>

<div class="detail-container">
    <h1>Detail Task</h1>

    <div class="detail-row">
        <div class="detail-label">Id:</div>
        <div class="detail-value">{{ $answer->id }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Nama:</div>
        <div class="detail-value">{{ $answer->nama }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Kelas:</div>
        <div class="detail-value">{{ $answer->kelas }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Email:</div>
        <div class="detail-value">{{ $answer->email }}</div>
    </div>
    
    
    <div class="detail-row">
        <div class="detail-label">Pesan:</div>
        <div class="detail-value">{{ $answer->pesan }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">File:</div>
        <div class="detail-value">{{ $answer->attachment }}</div>
    </div>
    
    <div class="detail-row">
        <div class="detail-label">Dibuat pada:</div>
        <div class="detail-value">{{ $answer->created_at->format('d F Y H:i') }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Terakhir diupdate:</div>
        <div class="detail-value">{{ $answer->updated_at->format('d F Y H:i') }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Status:</div>
        <div class="detail-value">{{ $answer->status }}</div>
    </div>

    

    @if(Auth::user()->token == 'admin')
    <div class="actions">
        <a href="{{ route('tasks.listAnswer', $answer->task_id) }}" class="btn btn-secondary">Kembali</a>
        @if($answer->status != 'Telah Dibaca')
        <form method="POST" action="{{ route('answers.markRead', $answer->id) }}">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-warning">Tandai Telah Di Baca</button>
        </form>
        @else
        <span style="color: green; padding: 10px;">Telah dibaca</span>
        @endif
    </div>
    @endif

    @if(Auth::user()->token == 'siswa')
    <div class="actions">
        <a href="/tasks" class="btn btn-secondary">Kembali</a>
    </div>
    @endif
</div>
@endsection