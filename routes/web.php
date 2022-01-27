<?php

use Illuminate\Support\Facades\Route;
use App\Models\Livre;
use App\Models\Categorie;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('accueil', function () {
    return view('accueil');
});

Route::get('liste', function () {

    //Avec ORM Eloquent (avant, on crée la classe Livre avec php artisan)
    // $livres = Livre::get();
    $livres = Livre::join('categories', 'livres.categ_id', '=', 'categories.id')->select('livres.id', 'titre', 'resume', 'prix', 'user_id', 'categories.libelle')->get();
    // dump($cat);
    // dump($livres);
    return view('liste_livres', ["livres" => $livres]);
});

Route::get('ajouter', function (Request $request) {
    $user_id = Auth::user()->id;
    $categories = Categorie::get();
    return view('ajout_livre', ["iduti" => $user_id, "categories" => $categories]);
});

Route::get('ajout', function (Request $request) {
    $livre = new Livre; // nouvel objet instance du modèle
    $livre->titre = $request->input('titre'); // définition des propriétés
    $livre->resume = $request->input('resume'); // définition des propriétés
    $livre->prix = $request->input('prix'); // définition des propriétés
    $livre->user_id = $request->input('user_id');
    $livre->categ_id = $request->input('categ_id');
    $livre->save(); // sauvegarde dans la BD Insert into

    if ($livre) {
        $message = "Votre livre a bien été ajouté !";
    }

    $livres = Livre::join('categories', 'livres.categ_id', '=', 'categories.id')->select('livres.id', 'titre', 'resume', 'prix', 'user_id', 'categories.libelle')->get();

    return view('liste_livres', ["livres" => $livres, "message" => $message]);
});

Route::get('recherche', function (Request $request) {
    $livres = Livre::where('titre', 'like', '%' . $request->input('search') . '%')->get();
    return view('resultat_recherche', ["livres" => $livres]);
});

Route::get('modifier', function (Request $request) {
    // $livre = Livre::find($request->input('id'));
    $livre = Livre::find($request->input('id'));
    $categories = Categorie::get();
    return view('modif_livre', ['livre' => $livre, 'categories' => $categories]);
});

Route::get('valid_modif', function (Request $request) {
    $livre = Livre::find($request->input('id'));
    $livre->titre = $request->input('titre');
    $livre->resume = $request->input('resume');
    $livre->prix = $request->input('prix');
    $livre->categ_id = $request->input('categ_id');
    $livre->save();

    $livres = Livre::join('categories', 'livres.categ_id', '=', 'categories.id')->select('livres.id', 'titre', 'resume', 'prix', 'user_id', 'categories.libelle')->get();
    return view('liste_livres', ["livres" => $livres]);
});

Route::get('supprimer', function (Request $request) {
    print_r($request->input('id'));
    $livre = Livre::find($request->input('id'));
    $livre->delete();

    $livres = Livre::join('categories', 'livres.categ_id', '=', 'categories.id')->select('livres.id', 'titre', 'resume', 'prix', 'user_id', 'categories.libelle')->get();
    return view('liste_livres', ["livres" => $livres]);
});

// Route::get('liste', function () {
//     $livres = DB::select("select titre, prix from ltp1livres where titre like 'Tom%'", []);
//     dump($livres);
//     return view('liste_livres');
// });

//Liste de tous les livres avec QUERY BUILDER
// Route::get('liste', function () {
//     $livres = DB::table('livres')->get();
//     dump($livres);
//     return view('liste_livres');
// });

// Titre du livre d’id 1 avec QUERY BUILDER
// Route::get('liste', function () {
//     $livres = DB::table('livres')->where('id', '=', '1')->get();
//     dump($livres);
//     return view('liste_livres');
// });

// Titre, prix des livres ayant « Tom » dans le titre avec QUERY BUILDER
// Route::get('liste', function () {
//     $livres = DB::table('livres')->select('titre', 'prix')->where('titre', 'LIKE', 'Tom%')->get();
//     dump($livres);
//     return view('liste_livres');
// });

Route::get('meslivres', function () {
    $livres = Livre::where('user_id', Auth::user()->id)->get();
    return view('meslivres', ["livres" => $livres]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
