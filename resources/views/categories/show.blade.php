<!DOCTYPE html>
<html>
    <head>
        <title>{{ $categorie->nom }} - Produits</title>
    </head>
    <body>
        <h1>Produits dans la categorie : {{ $categorie->nom }}</h1>

        <ul>
            @forelse ($categorie->puzzles as $puzzle)
                <li>{{ $puzzle->nom }}</li>
            @empty
                <li>Aucun produit dans cette categorie.</li>
            @endforelse
        </ul>
    </body>
</html> 

