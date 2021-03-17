<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Commande;

class PizzaioloController extends Controller
{
    public function listCommande()
    {
        $commandes = Commande::where('statut', 'envoye')
            ->orderBy('created_at', 'asc')
            ->get();
        return view('pizzaiolo.list_commande', ['commandes' => $commandes]);
    }

    public function detailCommande($id)
    {
        $pizzas = Commande::find($id)->pizzas;
        $user = Commande::find($id)->user->login;
        $commande =Commande::find($id);
        return view('pizzaiolo.detail_commande',['pizzas'=> $pizzas,'user'=>$user,'prix'=>$commande->prix_total]);
    }

    public function backList(){
        return redirect()->route('list_commandes');
    }
}
