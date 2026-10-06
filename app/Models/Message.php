<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable =[
        'channel_id',
        'user_id',
        'message',
        'file_path',
        'file_type',
    ];

    public function channel()
    {
        return $this->belongsTo(channel::class);
    }
    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }
}
