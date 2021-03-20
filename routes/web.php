<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisterUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\PizzaioloController;
use App\Http\Controllers\UserController;

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

// ajouter une nouvelle pizza
Route::get('/pizzas/create', [AdminController::class, 'create'])->name('pizzas.create')
    ->middleware('auth')
    ->middleware('is_admin');
Route::post('/pizza', [AdminController::class, 'store'])->name('pizzas.store');

// la liste des pizzas
Route::get('/pizzas', [AdminController::class, 'index'])->name('pizzas.index')
    ->middleware('auth')
    ->middleware('is_admin');

// changer le descriptif ou le nom d'une pizza
Route::get('/pizzas/{id}/edit', [AdminController::class, 'edit'])->name('pizzas.edit')
    ->middleware('auth')
    ->middleware('is_admin');
Route::put('/pizzas/{id}', [AdminController::class, 'update'])->name('pizzas.update');

// Création du compte pour les utilisateurs
Route::get('/register', [RegisterUserController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterUserController::class, 'store'])->name('store');

//login
Route::get('/login', [AuthenticatedSessionController::class, 'formLogin']);
Route::post('/login', [AuthenticatedSessionController::class, 'login'])->name('login');

//logout
Route::get('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');

// Liste des pizzas (avec pagination)
Route::get('/pizzas/user', [UserController::class, 'listPizzas'])->name('pizzas.listPizzas')
    ->middleware('auth')
    ->middleware('is_user');

//Changer le mot de passe
Route::get('/pizzas/user/change-password', [UserController::class, 'changePassword'])
    ->middleware('auth')
    ->middleware('is_user')
    ->name('change_password');
Route::post('/pizzas/user/update-password', [UserController::class, 'updatePassword'])
    ->name('update_password');

// Ajout de pizza dans le panier
Route::get('/pizzas/{nom}/{id}/{prix}/add-card', [UserController::class, 'addCard'])
    ->name('add_card');
Route::get('/pizzas/go-card', [UserController::class, 'updateCard'])
    ->middleware('auth')
    ->middleware('is_user')
    ->name('redirect_card');

// suprrimer des pizzas du panier
Route::get('/card/{nom}/{id}/remove-pizzas', [UserController::class, 'deletePizzas'])
    ->middleware('auth')
    ->middleware('is_user')
    ->name('delete_from_card');

// modifier la quantité des pizzas
Route::get('/changeQty/{nom}/{prix}', [UserController::class, 'changeQty'])
    ->middleware('auth')
    ->middleware('is_user')
    ->name('cart.update');

//revenir Menu des pizzas
Route::get('/back', [UserController::class, 'backToList'])
    ->middleware('auth')
    ->middleware('is_user')
    ->name('back_list');

// function pour confirmer l'achat
Route::get('/confirm', [UserController::class, 'confirmOrder'])
    ->middleware('auth')
    ->middleware('is_user')
    ->name('confirm_order');

// La liste des commandes non-traitées
Route::get('/commandes/pizzaiolo', [PizzaioloController::class, 'listCommande'])
    ->name('list_commandes');

// Le detail du commande
Route::get('/commandes/{id}/detail', [PizzaioloController::class, 'detailCommande'])
    ->name('detail_commandes');

// Changer le statut
Route::get('/statut/{id}/change', [PizzaioloController::class, 'changeStatut'])
    ->name('statut');

// liste commandes du user avec {id}
Route::get('/user/{id}/commandes', [UserController::class, 'listOrder'])
    ->name('liste_commandes');

// le detail concret du commande
Route::get('/detail/{id}/commande', [UserController::class, 'detailOrder'])
    ->name('user_commande');

// Liste commandes non-récupérées
Route::get('/user/commandes-non-recuperees', [UserController::class, 'listNotRetrieved'])
    ->name('commandes_nonRecuperees');

// Supprimer une pizza en utilisant SoftDelete
