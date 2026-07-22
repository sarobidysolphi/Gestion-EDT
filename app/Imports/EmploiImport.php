<?php

namespace App\Imports;

use App\Models\Emploi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class EmploiImport implements ToModel, WithHeadingRow, WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            // Chaque onglet du fichier Excel correspond à un niveau (ex: "L1", "L2", "M1")
            'L1' => new EmploiSheetImport('L1'),
            'L2' => new EmploiSheetImport('L2'),
            'M1' => new EmploiSheetImport('M1'),
            // Ajoute autant d'onglets que tu veux !
        ];
    }

    public function model(array $row)
    {
        // Cette méthode est appelée automatiquement par Laravel Excel
        return new Emploi([
            'cours' => $row['cours'],
            'date' => $row['date'],
            'heure_debut' => $row['heure_debut'],
            'heure_fin' => $row['heure_fin'],
            'jour_semaine' => \Carbon\Carbon::parse($row['date'])->locale('fr')->isoFormat('dddd'),
            'semaine' => $row['semaine'],
            'semestre' => $row['semestre'],
            'idprof' => $row['idprof'],
            'idclasse' => $row['idclasse'],
            'idsalle' => $row['idsalle'],
        ]);
    }
}