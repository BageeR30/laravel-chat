<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class Message extends Model
{
    use HasFactory;
    use Prunable;

    protected $table = 'messages';

    protected $fillable = [
        'from_user',
        'to_user',
        'text',
    ];
    
    public function prunable()
    {
        return static::where('created_at', '<', now()->subDay());
    }

}
