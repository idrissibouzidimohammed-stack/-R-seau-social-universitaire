<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificationCustom extends Model
{
    use HasFactory;

    protected $table = 'notification_customs';

    protected $fillable = [
        'user_id',
        'type',
        'message',
        'lu',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}