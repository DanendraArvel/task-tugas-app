@extends('layouts.app')

@section('title', 'Detail Task')

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
        <div class="detail-value">{{ $task->user_id }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Title:</div>
        <div class="detail-value">{{ $task->title }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Description:</div>
        <div class="detail-value">{{ $task->description }}</div>
    </div>
    
    <div class="detail-row">
        <div class="detail-label">Attachment:</div>
        <div class="detail-value">{{ $task->attachment }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Due Date:</div>
        <div class="detail-value">{{ $task->due_date }}</div>
    </div>
    
    <div class="detail-row">
        <div class="detail-label">Dibuat pada:</div>
        <div class="detail-value">{{ $task->created_at->format('d F Y H:i') }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Terakhir diupdate:</div>
        <div class="detail-value">{{ $task->updated_at->format('d F Y H:i') }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Status Jawaban:</div>
        <div class="detail-value">
            @if($userAnswer)
                <span style="color: green; font-weight: bold;">Terdaftar</span>
                <a href="{{ route('tasks.answer.my', $task->id) }}" class="btn btn-third" style="margin-left: 10px; padding: 5px 15px;">Lihat Jawaban Saya</a>
            @else
                <span style="color: red;">Belum Mengirim Jawaban</span>
                <a href="/tasks/{{ $task->id }}/answer" class="btn btn-warning" style="margin-left: 10px; padding: 5px 15px;">Kirim Jawaban</a>
            @endif
        </div>
    </div>

    <div class="actions">
        <a href="/tasks" class="btn btn-secondary">Kembali</a>
        @if(!Auth::user()->token == 'admin')
        <a href="{{ route('tasks.answer.my', $task->id) }}" class="btn btn-third">Lihat Jawaban Saya</a>
        @endif
        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
            @csrf
            @method('DELETE')
        </form>
        @if (auth()->user()->token == 'admin')
        <a href="/tasks/{{ $task->id }}/edit" class="btn btn-warning">Edit</a>
        <form method="POST" action="/tasks/{{ $task->id }}" style="display: inline;" 
            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
            @csrf
            @method('DELETE')
        <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
        @endif
    </div>
</div>
@endsection