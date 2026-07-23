<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $table = 'classes'; // C'est cette ligne qui force le nom !
    protected $primaryKey = 'idclasse';
    protected $fillable = ['niveau', 'mention', 'semestre'];

   
    public function emplois()
{
    return $this->hasMany(Emploi::class, 'idclasse', 'idclasse');
}

    }

