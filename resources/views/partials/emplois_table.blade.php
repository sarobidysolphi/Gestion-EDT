<!-- On a enlevé le message d'alerte. Si pas de cours, on n'affiche rien du tout. -->
<!-- Le bouton PDF s'affiche uniquement si le tableau contient des cours -->
@if(!$emplois->isEmpty())
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('pdf.generer', ['niveau' => request('niveau'), 'mention' => request('mention')]) }}" 
           class="btn btn-primary" style="background-color: #0d6efd; color: white; padding: 8px 20px; border-radius: 6px; text-decoration: none;">
            <i class="fas fa-file-pdf"></i> Télécharger le PDF
        </a>
    </div>
@endif

@if(!$emplois->isEmpty())
    <table class="table table-bordered bg-white shadow-sm text-center w-100" style="border: 1px solid #dee2e6; width: 100%;">
        <thead style="background-color: #f8f9fa; border-bottom: 2px solid #333;">
            <tr>
                <th style="width: 120px; padding: 12px;">Jour</th>
                <th style="width: 20%;">08:00 - 10:00</th>
                <th style="width: 20%;">10:00 - 12:00</th>
                <th style="width: 20%;">14:00 - 16:00</th>
                <th style="width: 20%;">16:00 - 18:00</th>
            </tr>
        </thead>
        <tbody>
            @php
                $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
                $creneaux = [
                    '08:00:00' => '08:00 - 10:00',
                    '10:00:00' => '10:00 - 12:00',
                    '14:00:00' => '14:00 - 16:00',
                    '16:00:00' => '16:00 - 18:00'
                ];
            @endphp

            @foreach($jours as $jour)
            <tr style="border-bottom: 1px solid #dee2e6;">
                <td style="padding: 12px; font-weight: bold; color:#000000; background-color: #fcfcfc; border-right: 1px solid #dee2e6;">{{ $jour }}</td>
                @foreach($creneaux as $heureDebut => $label)
                    <td style="padding: 12px; border-right: 1px solid #dee2e6; min-height: 70px;">
                        @php
                            $coursTrouve = $emplois->first(function($c) use ($jour, $heureDebut) {
                                return $c->jour_semaine === $jour && $c->heure_debut === $heureDebut;
                            });
                        @endphp

                        @if($coursTrouve)
                            <div style="background-color: #e9ecef; padding: 8px; border-radius: 4px; border-left: 4px solid #0d6efd; text-align: left;">
                                <strong style="font-size: 1rem;">{{ $coursTrouve->cours }}</strong><br>
                                <small style="color: #555;">{{ $coursTrouve->professeur->Nom }}</small><br>
                                <div style="margin-top: 4px; display: flex; gap: 4px; flex-wrap: wrap;">
                                    <span style="background-color: #0d6efd; color: white; padding: 2px 8px; border-radius: 12px; font-size: 0.75rem;">
                                        {{ $coursTrouve->salle->design }}
                                    </span>
                                    <span style="background-color: #6c757d; color: white; padding: 2px 8px; border-radius: 12px; font-size: 0.75rem;">
                                        {{ $coursTrouve->classe->niveau }}
                                    </span>
                                </div>
                            </div>
                        @else
                            <span style="color: #ccc;">-</span>
                        @endif
                    </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
@endif