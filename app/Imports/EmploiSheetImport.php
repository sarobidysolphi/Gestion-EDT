<?php

namespace App\Imports;

use App\Models\Emploi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmploiSheetImport implements ToModel, WithHeadingRow
{
    protected $niveau;

    public function __construct($niveau)
    {
        $this->niveau = $niveau;
    }

    public function model(array $row)
    {
        // Logique pour associer chaque ligne au niveau correspondant
        return new Emploi([
            'cours' => $row['cours'],
            'date' => $row['date'],
            'heure_debut' => $row['heure_debut'],
            'heure_fin' => $row['heure_fin'],
            'jour_semaine' => \Carbon\Carbon::parse($row['date'])->locale('fr')->isoFormat('dddd'),
            'semaine' => $row['semaine'],
            'semestre' => $row['semestre'],
            'idprof' => $row['idprof'],
            'idclasse' => \App\Models\Classe::where('niveau', $this->niveau)->first()->idclasse, // Trouve la classe par son niveau
            'idsalle' => $row['idsalle'],
        ]);
    }
}