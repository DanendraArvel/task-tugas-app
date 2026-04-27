<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';

    protected $fillable = [
        'task_id',
        'nama',
        'kelas',
        'status',
        'email',
        'nama_tugas',
        'pesan',
        'attachment-answer',
    ];
    
}
