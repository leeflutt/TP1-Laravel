@extends('index')
@section('section')
    <h2>Formulaire pour la modification d’un livre</h2>
    <form action="valid_modif" method="get">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre du livre</label>
            <input type="text" class="form-control" id="titre" name="titre" value="{{ $livre->titre }}">
        </div>
        <div class="mb-3">
            <label for="resume" class="form-label">ResumÃ©</label>
            <input type="text" class="form-control" id="resume" name="resume" value="{{ $livre->resume }}">
        </div>
        <div class="mb-3">
            <label for="prix" class="form-label">Prix du livre</label>
            <input type="text" class="form-control" id="prix" name="prix" value="{{ $livre->prix }}">
        </div>
        <div class="mb-3">
            <label for="categ_id" class="form-label">Catégorie</label>
            <select name="categ_id" id="categ_id">
                @foreach ($categories as $categorie)
                    @if ($categorie->id == $livre->categ_id)
                        <option value="{{ $categorie->id }}" selected>{{ $categorie->libelle }}</option>
                    @else 
                        <option value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>
                    @endif
                    @endforeach
            </select>
        </div>
        <input type="hidden" name="id" value="{{ $livre->id }}">
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
@stop
