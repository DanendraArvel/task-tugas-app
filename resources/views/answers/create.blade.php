@extends('layouts.app')

@section('title', 'Kirim Task')

@section('content')

<style>
    .form-container { background: white; padding: 30px; border-radius: 10px; max-width: 800px; margin: 0 auto; }
    .form-container h1 { margin-bottom: 20px; color: #333; }
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; margin-bottom: 5px; color: #555; font-weight: bold; }
    .form-group input, .form-group textarea, .form-group select { 
        width: 100%; 
        padding: 10px; 
        border: 1px solid #ddd; 
        border-radius: 5px; 
        font-size: 14px; 
    }
    .form-group textarea { min-height: 100px; }
    .error { color: #dc3545; font-size: 12px; margin-top: 5px; }
    .form-actions { display: flex; gap: 10px; margin-top: 20px; }
    .btn { 
        padding: 12px 30px; 
        border: none; 
        border-radius: 5px; 
        cursor: pointer; 
        font-size: 14px; 
        text-decoration: none;
        display: inline-block;
    }
    .btn-primary { background: #007bff; color: white; }
    .btn-primary:hover { 
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
    .btn-secondary { background: #6c757d; color: white; }
    .btn-secondary:hover { 
        background: #5a6268; 
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

<div class="form-container">
    <h1>Kirim Task</h1>

    <form method="POST" action="/tasks/{{ $task->id }}/answer" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Nama *</label>
            <input type="text" name="nama" value="{{ old('nama') }}" required>
            @error('nama')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Kelas *</label>
            <input type="text" name="kelas" value="{{ old('kelas') }}" required>
            @error('kelas')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Email *</label>
            <input type="text" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Nama Tugas *</label>
            <input type="text" name="nama_tugas" value="{{ old('nama_tugas') }}" required>
            @error('nama_tugas')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Pesan *</label>
            <input type="text" name="pesan" value="{{ old('pesan') }}" required>
            @error('pesan')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label>File *</label>
            <input type="file" name="attachmentAnswer" value="{{ old('attachmentAnswer') }}" >
            @error('attachmentAnswer')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Kirim</button>
            <a href="/tasks" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<style>

    .swal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        animation: fadeIn 0.2s;
    }
    
    .swal-overlay.active {
        display: flex;
    }
    
    .swal-box {
        background: white;
        padding: 40px;
        border-radius: 15px;
        max-width: 450px;
        width: 90%;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        animation: zoomIn 0.3s;
        text-align: center;
    }
    
    .swal-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        border-radius: 50%;
        background: #dc3545;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 40px;
        color: white;
        animation: pulse 0.5s;
    }
    
    .swal-title {
        font-size: 24px;
        color: #333;
        margin-bottom: 15px;
        font-weight: bold;
    }
    
    .swal-text {
        color: #666;
        margin-bottom: 20px;
        line-height: 1.6;
    }
    
    .swal-errors {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        max-height: 200px;
        overflow-y: auto;
        text-align: left;
    }
    
    .swal-errors ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .swal-errors li {
        padding: 8px 12px;
        margin-bottom: 8px;
        background: white;
        border-left: 3px solid #dc3545;
        border-radius: 4px;
        color: #721c24;
    }
    
    .swal-button {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
        padding: 12px 40px;
        border: none;
        border-radius: 25px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        transition: all 0.3s;
    }
    
    .swal-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
    }
    
    @keyframes zoomIn {
        from {
            transform: scale(0.5);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }
</style>

<div class="swal-overlay" id="swalError">
    <div class="swal-box">
        <div class="swal-icon">⚠️</div>
        <div class="swal-title">Oops!</div>
        <div class="swal-text">Terdapat beberapa kesalahan pada form:</div>
        <div class="swal-errors">
            <ul id="swalErrorList"></ul>
        </div>
        <button class="swal-button" onclick="closeSwal()">Mengerti</button>
    </div>
</div>

<script>
function showSwal(errors) {
    const swal = document.getElementById('swalError');
    const errorList = document.getElementById('swalErrorList');
    
    errorList.innerHTML = '';
    errors.forEach(error => {
        const li = document.createElement('li');
        li.textContent = error;
        errorList.appendChild(li);
    });
    
    swal.classList.add('active');
}

function closeSwal() {
    document.getElementById('swalError').classList.remove('active');
}

document.getElementById('swalError').addEventListener('click', function(e) {
    if (e.target === this) {
        closeSwal();
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeSwal();
    }
});

@if ($errors->any())
    showSwal(@json($errors->all()));
@endif
</script>
@endsection