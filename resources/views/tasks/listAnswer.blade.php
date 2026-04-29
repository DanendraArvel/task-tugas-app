@extends('layouts.app')

@section('title', 'Data Jawaban')

@section('content')
<style>
    .search-form {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    .search-box {
        flex: 1;
        padding: 12px 20px;
        border: 2px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
    }

    .btn-search {
        padding: 12px 30px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
    }

    .btn-search:hover {
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

    .btn-reset {
        padding: 12px 20px;
        background: #6c757d;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        display: inline-block;
    }

    .btn-reset:hover {
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

    .search-result {
        color: #666;
        font-style: italic;
    }

    .pagination-wrapper nav {
        display: flex;
        justify-content: center;
    }

    .pagination-wrapper nav > div {
        display: flex;
        gap: 3px;
        flex-wrap: wrap;
    }

    .pagination-wrapper nav a,
    .pagination-wrapper nav span {
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        padding: 8px 12px !important;
        margin: 0 2px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px !important;
        min-width: 38px !important;
        height: 38px !important;
        text-decoration: none;
        color: #007bff;
        background: white;
        box-sizing: border-box;
    }

    /* Hover effect */
    .pagination-wrapper nav a:hover {
        background: #007bff;
        color: white;
        border-color: #007bff;
    }

    .pagination-wrapper nav span[aria-current="page"] {
        background: #007bff;
        color: white;
        border-color: #007bff;
        font-weight: bold;
    }

    .pagination-wrapper nav span[aria-disabled="true"] {
        color: #999;
        background: #f8f9fa;
        border-color: #ddd;
        cursor: not-allowed;
    }

    .pagination-wrapper nav svg {
        width: 14px !important;
        height: 14px !important;
        fill: currentColor;
    }

    .pagination-wrapper nav span[aria-disabled="true"] svg,
    .pagination-wrapper nav a svg {
        margin: 0 !important;
    }
    .page-header { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: 20px; 
    }
    .page-header h1 { color: #333; }
    .btn { 
        margin: 5px;
        padding: 10px 20px; 
        text-decoration: none; 
        border-radius: 5px; 
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
    .btn-warning { background: #ffc107; color: #333; font-size: 12px; padding: 5px 10px; text-decoration: none; }
    .btn-danger { background: #dc3545; color: white; font-size: 12px; padding: 5px 10px; border: none; cursor: pointer; }
    .btn-info { background: #17a2b8; color: white; font-size: 12px; padding: 5px 10px; text-decoration: none; }
    
    table { width: 100%; background: white; border-collapse: collapse; margin-top: 20px; }
    table th { background: #f8f9fa; padding: 12px; text-align: left; border-bottom: 2px solid #dee2e6; }
    table td { padding: 12px; border-bottom: 1px solid #dee2e6; }
    table tr:hover { background: #f8f9fa; }
    
    .actions { display: flex; gap: 5px; }
    .empty { text-align: center; padding: 40px; color: #999; }
    
    .pagination-wrapper { margin-top: 20px; display: flex; justify-content: space-between; align-items: center; }
    .pagination-info { color: #666; font-size: 14px; }
    .pagination { display: flex; gap: 5px; list-style: none; }
    .pagination a, .pagination span { 
        padding: 8px 12px; 
        border: 1px solid #ddd; 
        border-radius: 4px; 
        text-decoration: none; 
        color: #007bff; 
    }
    .pagination .active span { 
        background: #007bff; 
        color: white; 
        border-color: #007bff; 
    }
    .pagination a:hover { background: #f8f9fa; }
    .pagination .disabled span { color: #ccc; cursor: not-allowed; }
</style>

<div class="page-header">
    <h1>Data Jawaban</h1>
    <div>
        <a href="/tasks" class="btn btn-secondary">Kembali</a>
    </div>
</div>

<div class="search-container">
    <form method="GET" action="/tasks" class="search-form">
        <input type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="Cari berdasarkan title atau description..." 
            class="search-box">
        <button type="submit" class="btn-search">Cari</button>
        @if(request('search'))
            <a href="/tasks" class="btn-reset">Reset</a>
        @endif
    </form>
    
    @if(request('search'))
        <span class="search-result">
            Hasil pencarian: "{{ request('search') }}" - 
            Ditemukan {{ $tasks->total() }} data
        </span>
    @endif
</div>

@if(count($answers) > 0)
<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Email</th>
            <th>Nama Tugas</th>
            <th>Pesan</th>
            <th>Attachment</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($answers as $answer)
        <tr>
            <td>{{ $answer->nama }}</td>
            <td>{{ $answer->kelas }}</td>
            <td>{{ $answer->email }}</td>
            <td>{{ $answer->nama_tugas }}</td>
            <td>{{ $answer->pesan }}</td>
            <td>
                @if ($answer->attachmentAnswer)
                    <a href="/download-answer-attachment/{{ $answer->attachmentAnswer }}" class="btn-warning">Download</a>
                @endif
            </td>
            <td>{{ $answer->status }}</td>
            <td>
                <div class="actions">
                    <a href="/answers/{{ $answer->id }}/show" class="btn-info">Detail</a>
                    @if (auth()->user()->token == 'admin')
                        <form method="POST" action="/answers/{{ $answer->id }}/delete" style="display: inline;" 
                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger">Hapus</button>
                        </form>
                @endif
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@else
<div class="empty">
    <p>Belum ada jawaban.</p>
</div>
@endif

@endsection