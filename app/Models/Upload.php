<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_id',
        'file_path',
        'file_type',
        'file_name',
        'file_size',
    ];

    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'message_id', 'id');
    }
}
