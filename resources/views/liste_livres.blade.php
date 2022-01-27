@extends('index')
@section('section')
<h2>Liste de tous les livres</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Résumé</th>
            <th>Prix</th>
            <th>Catégorie</th>
        </tr>
    </thead>
    
    @foreach ($livres as $livre)
    <tr>
        <td>{{ $livre->titre }}</td>
        <td>{{ $livre->resume }}</td>
        <td>{{ $livre->prix }}</td>
        <td>{{ $livre->libelle }}</td>
        <td>
            <form method="GET" action="modifier">
                <input type="hidden" name="id" value="{{ $livre->id }}">
                <input type="submit" value="Modifier">
            </form>
        </td>
        <td>
            <form method="GET" action="supprimer">
                <input type="hidden" name="id" value="{{ $livre->id }}">
                <input type="submit" value="Supprimer">
            </form>
        </td>
        
    </tr>
    @endforeach
</table>
@stop