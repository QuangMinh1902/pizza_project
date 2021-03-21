<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\CommandePizza;
use App\Models\Pizza;

class PizzaioloController extends Controller
{
    public function listCommande()
    {
        $commandes = Commande::where('statut', 'envoye')
            ->orderBy('created_at', 'asc')
            ->get();
        return view('pizzaiolo.list_commande', ['commandes' => $commandes]);
    }

    public function detailCommande(Request $request, $id)
    {
        $pizzas = Commande::find($id)->pizzas;
        $user = Commande::find($id)->user->login;
        $commandePizza = CommandePizza::query()
            ->select('pizza_id', 'qte')
            ->where('commande_id', $id)
            ->get();
        $request->session()->put('prixToTal', 0);
        foreach ($commandePizza as $c) {
            $prix = Pizza::where(['id' => $c->pizza_id])->first()->prix;
            $request->session()->increment('prixToTal', $prix * $c->qte);
        }
        $prixTotal = $request->session()->get('prixToTal');
        $request->session()->forget('prixToTal');
        return view('pizzaiolo.detail_commande', ['pizzas' => $pizzas, 'user' => $user, 'prix' => $prixTotal, 'commande_id' => $id]);
    }

    public function backList()
    {
        return redirect()->route('list_commandes');
    }

    public function changeStatut(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required'
        ]);
        Commande::query()->where('id', $id)->update(['statut' => $request->statut]);
        $request->session()->flash('etat', 'Le statut est changé');
        return redirect()->route('list_commandes');
    }
}
