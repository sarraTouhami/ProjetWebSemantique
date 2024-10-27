<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.3/main.min.css" />
    <title>Calendrier des Produits</title>
</head>
<body>
    <div id="calendar"></div>

    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.10.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.10.3/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var events = [
                @foreach ($products as $product)
                    {
                        title: '{{ $product['nomAliment'] }} ({{ $product['quantiteAliment'] }})',
                        start: '{{ $product['expiryDate']->format('Y-m-d') }}',
                        description: 'Catégorie: {{ $product['categorieAliment'] }}',
                    },
                @endforeach
            ];

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['dayGrid'],
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialView: 'dayGridMonth',
                events: events,
                eventDidMount: function(info) {
                    if (info.event.extendedProps.description) {
                        info.el.innerHTML += '<br/>' + info.event.extendedProps.description;
                    }
                }
            });
            calendar.render();
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.3/main.min.css" />
    <title>Calendrier des Produits</title>
    <style>
        /* Style pour le calendrier */
        #calendar {
            max-width: 900px;
            margin: 40px auto;
        }
    </style>
</head>
<body>
    <div id="calendar"></div>

    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.10.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.10.3/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Vérifiez si des produits sont disponibles
            var events = [
                @if (!empty($products))
                    @foreach ($products as $product)
                        {
                            title: '{{ $product['nomAliment'] }} ({{ $product['quantiteAliment'] }})',
                            start: '{{ $product['expiryDate']->format('Y-m-d') }}',
                            description: 'Catégorie: {{ $product['categorieAliment'] }}',
                        },
                    @endforeach
                @else
                    {
                        title: 'Aucun produit disponible',
                        start: new Date().toISOString().split('T')[0], // Date aujourd'hui
                    }
                @endif
            ];

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['dayGrid'],
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialView: 'dayGridMonth',
                events: events,
                eventDidMount: function(info) {
                    if (info.event.extendedProps.description) {
                        info.el.innerHTML += '<br/>' + info.event.extendedProps.description;
                    }
                }
            });
            calendar.render();
        });
    </script>
</body>
</html>
