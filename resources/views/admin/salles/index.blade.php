@extends('admin.layout')

@section('content')
    <h1>Gestion des Salles</h1>

 <!-- BARRE DE RECHERCHE INTÉGRÉE AU-DESSUS DU TABLEAU -->
<div style="display: flex; align-items: center; gap: 15px; background: rgba(255, 255, 255, 0.05); padding: 10px 20px; border-radius: 15px; margin-bottom: 15px; flex-wrap: wrap;">
    <label style="color: #32CD32; font-weight: bold; font-size: 0.95rem;">Rechercher une salle libre :</label>
    
    <input type="date" id="searchDate" 
           style="padding: 8px 15px; border-radius: 30px; border: 1px solid rgba(255,255,255,0.2); background: rgba(255,255,255,0.12); color: white; outline: none; font-size: 0.9rem;">
    
    <button onclick="chercherSalleLibre()" 
            style="background: rgba(50, 205, 50, 0.2); color: white; padding: 8px 20px; border-radius: 30px; border: 1px solid rgba(50, 205, 50, 0.4); cursor: pointer; font-size: 0.9rem; transition: 0.3s;">
        <i class="fas fa-search"></i> Chercher
    </button>

    <!-- Résultat de la recherche (s'affiche ici) -->
    <span id="resultatRecherche" style="color: #32CD32; font-weight: bold; margin-left: 5px;"></span>
</div>

    <div class="admin-table-container">
        <a href="{{ route('salles.create') }}" class="btn-add"><i class="fas fa-plus"></i> Ajouter</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Désignation</th>
                    <th>Occupation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salles as $salle)
                <tr>
                    <td>{{ $salle->idsalle }}</td>
                    <td>{{ $salle->design }}</td>
                    <td>{{ $salle->occupation ? 'Occupée' : 'Libre' }}</td>
                    <td>
                        <a href="{{ route('salles.edit', $salle->idsalle) }}" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('salles.destroy', $salle->idsalle) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete" onclick="return confirm('Supprimer cette salle ?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

      
    </div>


 <script>
    function chercherSalleLibre() {
        const date = document.getElementById('searchDate').value;
        const resultat = document.getElementById('resultatRecherche');

        if (!date) {
            resultat.innerHTML = '<span style="color: #ff6b6b;">Veuillez sélectionner une date.</span>';
            return;
        }

        resultat.innerHTML = 'Recherche en cours...';

        fetch(`/admin/salles/libres?date=${date}`)
            .then(response => response.json())
            .then(data => {
                // 1. On masque le message de résultat (car le tableau va s'afficher)
                resultat.innerHTML = `✅ ${data.length} salle(s) libre(s) trouvée(s)`;

                // 2. On récupère le corps du tableau
                const tbody = document.querySelector('table tbody');
                
                // 3. Si aucune salle libre, on affiche un message dans le tableau
                if (data.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 30px; color: #ff6b6b;">
                                Aucune salle libre pour la date sélectionnée.
                            </td>
                        </tr>
                    `;
                    return;
                }

                // 4. On reconstruit le tableau avec UNIQUEMENT les salles libres
                let html = '';
                data.forEach(salle => {
                    html += `
                        <tr>
                            <td>${salle.idsalle}</td>
                            <td>${salle.design}</td>
                            <td style="color: #32CD32;">Libre</td>
                            <td>
                                <a href="/admin/salles/${salle.idsalle}/edit" style="color: #32CD32; text-decoration: none; margin-right: 10px;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="/admin/salles/${salle.idsalle}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: none; border: none; color: #ff6b6b; cursor: pointer;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    `;
                });
                tbody.innerHTML = html;
            })
            .catch(error => {
                console.error(error);
                resultat.innerHTML = '❌ Erreur lors de la recherche.';
            });
    }
</script>
@endsection