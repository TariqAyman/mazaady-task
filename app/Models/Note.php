<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

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

    protected function pdfPath(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => empty($value) ? null : Storage::url($value),
        );
    }
}
