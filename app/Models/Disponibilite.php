<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disponibilite extends Model
{
    use HasFactory;

    protected $table = 'Disponibilite';
      protected $fillable = ['idprof', 'date_debut', 'heure_fin', 'type'];
}
