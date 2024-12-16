<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RekomtekDocument extends Model
{
    protected $fillable = [
        'rekomtek_application_id',
        'document_type',
        'file_path'
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(RekomtekApplication::class, 'rekomtek_application_id');
    }
}
