<?php

namespace App\Models;

use App\Models\Billet;
use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_transaction',
        'utilisateur_id',
        'billet_id',
        'montant',
        'methode_paiement',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function billet()
    {
        return $this->belongsTo(Billet::class);
    }
}
