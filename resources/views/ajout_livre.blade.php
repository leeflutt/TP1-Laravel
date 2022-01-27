@extends('index')
@section('section')
    <h2>Formulaire pour l’ajout d’un nouveau livre</h2>
    <form action="ajout" method="get">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre du livre</label>
            <input type="text" class="form-control" id="titre" name="titre" ariadescribedby="titre">
        </div>
        <div class="mb-3">
            <label for="resume" class="form-label">Resumé</label>
            <input type="text" class="form-control" id="resume" name="resume">
        </div>
        <div class="mb-3">
            <label for="prix" class="form-label">Prix du livre</label>
            <input type="text" class="form-control" id="prix" name="prix">
        </div>
        <div class="mb-3">
            <label for="categ_id" class="form-label">Catégorie</label>
            <select name="categ_id" id="categ_id">
                @foreach ($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->libelle }}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="user_id" value="{{ $iduti }}">
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
@stop
