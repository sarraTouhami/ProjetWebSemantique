<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Certificat de Produit</title>
    <style>
        h1 {
            text-transform: uppercase;
            font-size: 48pt;
            margin-bottom: 0;
        }
        h2 {
            font-size: 24pt;
            margin-top: 0;
            padding-bottom: 1mm;
            display: inline-block;
            border-bottom: 1mm solid #991B1B;
        }
        h2::after {
            content: "";
            display: block;
            padding-bottom: 4mm;
            border-bottom: 1mm solid #991B1B;
        }
        h3 {
            font-size: 20pt;
            margin-bottom: 0;
            margin-top: 10mm;
        }
        p {
            font-size: 16pt;
        }
        .inner-content {
            border: 1mm solid #991B1B;
            margin: 4mm;
            padding: 10mm;
            height: auto;
            text-align: center;
        }
        .content {
            position: relative;
            left: 10mm;
            top: 10mm;
            border: 1mm solid #991B1B;
            background: white;
        }
        @page {
            size: A4 landscape;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="inner-content">
            <h1>Certificat</h1>
            <h2>de Produit</h2>
            <h3>Ce certificat est attribué à</h3>
            <p>{{ $certificat->nomAliment }}</p>
            <h3>Informations du produit</h3>
            <p><strong>Quantité :</strong> {{ $certificat->quantiteAliment }}</p>
            <p><strong>Catégorie :</strong> {{ $certificat->categorieAliment }}</p>
            <p><strong>Date de péremption :</strong> {{ $certificat->datePeremption }}</p>
        </div>
    </div>
</body>
</html>
