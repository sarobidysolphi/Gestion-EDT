<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emploi extends Model
{
    use HasFactory;

    protected $table = 'emplois';
      protected $fillable = [ 'idprof', 'idsalle', 'idclasse', 'cours', 'date', 'heure_debut', 'heure_fin', 'jour_semaine', 'semaine'];


      // Relation avec la Classe
public function classe()
{
    return $this->belongsTo(Classe::class, 'idclasse', 'idclasse');
}

public function professeur()
{
    return $this->belongsTo(Professeur::class, 'idprof', 'idprof');
}

public function salle()
{
    return $this->belongsTo(Salle::class, 'idsalle', 'idsalle');
}
}
