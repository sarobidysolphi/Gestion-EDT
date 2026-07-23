<?php

namespace App\Http\Controllers;

use App\Models\Emploi;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class PDFController extends Controller
{
    public function generer(Request $request)
    {
        // 1. Filtrer les emplois du temps
        $emplois = Emploi::with(['professeur', 'salle', 'classe']);

        if ($request->filled('semestre') && $request->semestre !== 'Tous') {
            $emplois->where('semestre', $request->semestre);
        }

        if ($request->filled('niveau') && $request->niveau !== 'Tous') {
            $emplois->whereHas('classe', function($q) use ($request) {
                $q->where('niveau', $request->niveau);
            });
        }

        $emplois = $emplois->get();

        // 2. Calcul de la semaine
        $premiereDate = $emplois->first() ? $emplois->first()->date : now();
        $debutSemaine = \Carbon\Carbon::parse($premiereDate)->startOfWeek(\Carbon\Carbon::MONDAY);
        $finSemaine = (clone $debutSemaine)->endOfWeek(\Carbon\Carbon::SUNDAY);

        // 3. Création du HTML du PDF
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                body { font-family: Arial, sans-serif; font-size: 12px; }
                h1 { text-align: center; }
                .semaine { text-align: center; font-weight: bold; margin-bottom: 20px; }
                table { width: 100%; border-collapse: collapse; margin-top: 10px; }
                th, td { border: 1px solid #333; padding: 8px; text-align: center; }
                th { background-color: #f0f0f0; }
            </style>
        </head>
        <body>
            <h1>EMPLOI DU TEMPS</h1>
            <div class="semaine">
                Semaine du ' . $debutSemaine->format('d/m/Y') . ' au ' . $finSemaine->format('d/m/Y') . '
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Jour</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Cours</th>
                        <th>Salle</th>
                        <th>Niveau</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($emplois as $e) {
            $html .= '
                    <tr>
                        <td>' . $e->jour_semaine . '</td>
                        <td>' . $e->date . '</td>
                        <td>' . $e->heure_debut . '-' . $e->heure_fin . '</td>
                        <td>' . $e->cours . '</td>
                        <td>' . $e->salle->design . '</td>
                        <td>' . $e->classe->niveau . '</td>
                    </tr>';
        }

        $html .= '
                </tbody>
            </table>
        </body>
        </html>';

        // 4. Génération du PDF avec DomPDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('emploi_du_temps.pdf', ['Attachment' => 1]);
    }
}