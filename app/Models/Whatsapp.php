<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whatsapp extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_number',
        'message_count',
        'last_message',
        'status'
    ];
}
