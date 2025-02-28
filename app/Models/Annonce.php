<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{

    protected $fillable = [
        'name',
        'prix',
        'id_Propriétaire',
        'id_Touriste',
        'disponibilites',
        'localisation',
    ];


    public function proprietaire()
    {
        return $this->belongsTo(User::class, 'id_Propriétaire');
    }


    public function touriste()
    {
        return $this->belongsTo(User::class, 'id_Touriste');
    }
}
