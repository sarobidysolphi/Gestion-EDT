<?php

namespace App\Imports;

use App\Models\Emploi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmploiImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Emploi([
            'cours' => $row['cours'],
            'date' => $row['date'],
            'heure_debut' => $row['heure_debut'],
            'heure_fin' => $row['heure_fin'],
            'jour_semaine' => $row['jour_semaine'],
            'semaine' => $row['semaine'],
            'semestre' => $row['semestre'],
            'idprof' => $row['idprof'],
            'idclasse' => $row['idclasse'],
            'idsalle' => $row['idsalle'],
        ]);
    }
}