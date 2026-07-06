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

        if ($request->filled('mention')) {
            $emplois->whereHas('classe', function($q) use ($request) {
                $q->where('mention', $request->mention);
            });
        }

        if ($request->filled('niveau')) {
            $emplois->whereHas('classe', function($q) use ($request) {
                $q->where('niveau', $request->niveau);
            });
        }

        $emplois = $emplois->get();

        // 2. On crée le HTML du PDF (grâce à une vue Blade)
        $html = view('pdf.emploi', compact('emplois'))->render();

        // 3. On utilise DomPDF pour convertir le HTML en PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('emploi_du_temps.pdf', ['Attachment' => 1]);
    }
}