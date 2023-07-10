<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'email',
        'phone',
        'body'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
