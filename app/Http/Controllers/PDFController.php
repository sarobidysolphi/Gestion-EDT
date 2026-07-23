<?php

namespace App\Http\Controllers;

use App\Models\Emploi;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class PDFController extends Controller
{
   public function generer(Request $request)
{
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

    // ===== CALCUL DE LA SEMAINE =====
    $premiereDate = $emplois->first() ? $emplois->first()->date : now();
    $debutSemaine = \Carbon\Carbon::parse($premiereDate)->startOfWeek(\Carbon\Carbon::MONDAY);
    $finSemaine = (clone $debutSemaine)->endOfWeek(\Carbon\Carbon::SUNDAY);

    // ===== CRÉATION DU PDF =====
    $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->setFontSubsetting(false);
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 10);

    // Titre avec la semaine
    $pdf->Cell(0, 10, 'EMPLOI DU TEMPS', 0, 1, 'C');
    $pdf->Cell(0, 8, 'Semaine du ' . $debutSemaine->format('d/m/Y') . ' au ' . $finSemaine->format('d/m/Y'), 0, 1, 'C');
    $pdf->Ln(5);

    // En-têtes du tableau
    $pdf->Cell(30, 10, 'Jour', 1);
    $pdf->Cell(30, 10, 'Date', 1);
    $pdf->Cell(40, 10, 'Heure', 1);
    $pdf->Cell(50, 10, 'Cours', 1);
    $pdf->Cell(30, 10, 'Salle', 1);
    $pdf->Cell(30, 10, 'Niveau', 1);
    $pdf->Ln();

    // Liste des jours de la semaine (Lundi à Samedi)
    $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];

    foreach ($jours as $jour) {
        // On cherche les cours de ce jour
        $coursDuJour = $emplois->filter(function($e) use ($jour) {
            return $e->jour_semaine === $jour;
        });

        if ($coursDuJour->isNotEmpty()) {
            // S'il y a des cours, on les affiche
            foreach ($coursDuJour as $e) {
                $pdf->Cell(30, 10, $jour, 1);
                $pdf->Cell(30, 10, $e->date, 1);
                $pdf->Cell(40, 10, $e->heure_debut . '-' . $e->heure_fin, 1);
                $pdf->Cell(50, 10, $e->cours, 1);
                $pdf->Cell(30, 10, $e->salle->design, 1);
                $pdf->Cell(30, 10, $e->classe->niveau, 1);
                $pdf->Ln();
            }
        } else {
            // S'il n'y a pas de cours, on affiche quand même le jour avec des tirets
            $pdf->Cell(30, 10, $jour, 1);
            $pdf->Cell(30, 10, '-', 1);
            $pdf->Cell(40, 10, '-', 1);
            $pdf->Cell(50, 10, '-', 1);
            $pdf->Cell(30, 10, '-', 1);
            $pdf->Cell(30, 10, '-', 1);
            $pdf->Ln();
        }
    }

    $pdf->Output('emploi_du_temps.pdf', 'D');
}
}