<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Emploi du temps</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
        h1 { text-align: center; font-size: 18px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 8px; text-align: center; min-height: 30px; }
        th { background-color: #f0f0f0; font-weight: bold; }
        .empty { color: #ccc; }
        .cours-cell { border-left: 4px solid #0d6efd; text-align: left; padding: 4px 8px; }
    </style>
</head>
<body>
    <h1>EMPLOI DU TEMPS</h1>

    <table>
        <thead>
            <tr>
                <th style="width: 100px;">Jour</th>
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
            <tr>
                <td style="font-weight: bold; background-color: #fcfcfc;">{{ $jour }}</td>
                @foreach($creneaux as $heureDebut => $label)
                    <td>
                        @php
                            $coursTrouve = $emplois->first(function($c) use ($jour, $heureDebut) {
                                return $c->jour_semaine === $jour && $c->heure_debut === $heureDebut;
                            });
                        @endphp

                        @if($coursTrouve)
                            <div class="cours-cell">
                                <strong>{{ $coursTrouve->cours }}</strong><br>
                                <small>{{ $coursTrouve->professeur->Nom }}</small><br>
                                <span style="display: inline-block; background: #0d6efd; color: white; padding: 2px 6px; border-radius: 4px; font-size: 10px; margin-top: 2px;">
                                    {{ $coursTrouve->salle->design }}
                                </span>
                                <span style="display: inline-block; background: #6c757d; color: white; padding: 2px 6px; border-radius: 4px; font-size: 10px; margin-top: 2px;">
                                    {{ $coursTrouve->classe->niveau }}
                                </span>
                            </div>
                        @else
                            <span class="empty">-</span>
                        @endif
                    </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>