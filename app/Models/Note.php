<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'folder_id',
        'title',
        'visibility',
        'type',
        'text_body',
        'pdf_path'
    ];

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
}
