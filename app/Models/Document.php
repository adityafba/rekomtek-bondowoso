<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekomtekDocument extends Model
{
    use HasFactory;

    protected $table = 'documents';

    protected $fillable = [
        'rekomtek_application_id',
        'document_type',
        'file_path',
        'original_name',
        'file_size',
        'mime_type'
    ];

    public function application()
    {
        return $this->belongsTo(RekomtekApplication::class, 'rekomtek_application_id');
    }
}
