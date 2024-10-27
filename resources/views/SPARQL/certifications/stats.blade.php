@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Statistiques des Certifications</h1>
    <canvas id="certificationChart" width="400" height="400"></canvas>
    <a href="{{ route('certification.search') }}" class="btn btn-primary mt-4">Retour à la recherche</a>
</div>

<!-- Inclure Chart.js depuis un CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Préparer les données pour le graphique
        const results = @json($results); // Obtenir les résultats formatés

        const labels = results.map(result => result.certifStatus); // Obtenir les valeurs des statuts de certification
        const data = results.map(result => result.count); // Obtenir les valeurs des comptes

        // Vérifier les valeurs des labels et des données
        console.log(labels); // Ajout de cette ligne pour déboguer
        console.log(data);    // Ajout de cette ligne pour déboguer

        // Initialiser le graphique
        const ctx = document.getElementById('certificationChart').getContext('2d');

        const certificationChart = new Chart(ctx, {
            type: 'pie', // Type de graphique circulaire
            data: {
                labels: labels,
                datasets: [{
                    label: 'Nombre de Certifications',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Statistiques des Certifications'
                    }
                }
            }
        });
    });
</script>
@endsection
