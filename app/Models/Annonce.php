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
        'image',
    ];


    public function proprietaire()
    {
        return $this->belongsTo(User::class, 'id_Propriétaire');
    }


    public function touriste()
    {
        return $this->belongsTo(User::class, 'id_Touriste');
    }
    public function favoritedByUsers()
{
    return $this->belongsToMany(User::class, 'favorite_annonces')->withTimestamps();
}
public function reservations()
{
    return $this->hasMany(Reservation::class);
}


}

