<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture - WoodyCraft</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #333;
            font-size: 12px;
            margin: 30px;
        }
        h1 {
            text-align: center;
            color: #007BFF;
            margin-bottom: 20px;
        }
        .header {
            border-bottom: 2px solid #007BFF;
            margin-bottom: 30px;
            padding-bottom: 10px;
        }
        .section-title {
            background-color: #E8F3FF;
            color: #007BFF;
            padding: 6px 10px;
            font-weight: bold;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #007BFF;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        .total {
            text-align: right;
            font-weight: bold;
        }
        .footer {
            margin-top: 40px;
            border-top: 2px solid #007BFF;
            padding-top: 10px;
            text-align: center;
            font-size: 11px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Facture - WoodyCraft</h1>
        <p><strong>Date :</strong> {{ now()->format('d/m/Y') }}</p>
        <p><strong>Client :</strong> {{ $user->name }} ({{ $user->email }})</p>
    </div>

    <div class="section-title">Adresse de livraison</div>
    <p>
        {{ $adresse->numero }} {{ $adresse->rue }}<br>
        {{ $adresse->code_postal }} {{ $adresse->ville }}<br>
        {{ $adresse->pays }}
    </p>

    <div class="section-title">Détails de la commande</div>
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire (€)</th>
                <th>Total (€)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($panier->puzzles as $puzzle)
            <tr>
                <td>{{ $puzzle->nom }}</td>
                <td>{{ $puzzle->pivot->quantite }}</td>
                <td>{{ number_format($puzzle->prix, 2, ',', ' ') }}</td>
                <td>{{ number_format($puzzle->pivot->quantite * $puzzle->prix, 2, ',', ' ') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" class="total">Total à payer :</td>
                <td><strong>{{ number_format($total, 2, ',', ' ') }} €</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">Instructions de paiement</div>
    <p>
        Merci pour votre commande ! <br><br>
        Veuillez envoyer votre chèque à l’adresse suivante :<br>
        <strong>WoodyCraft - Service Paiement<br>
        12 Rue du Puzzle, 75000 Paris</strong>
    </p>

    <div class="footer">
        © {{ date('Y') }} WoodyCraft - www.woodycraft.fr
    </div>

</body>
</html>
