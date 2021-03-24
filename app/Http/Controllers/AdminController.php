<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\CommandePizza;
use Illuminate\Http\Request;

use App\Models\Pizza;

class AdminController extends Controller
{
    public function create()
    {
        return view('admin.new_pizza');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|min:4|max:30|unique:pizzas',
            'description' => 'required|string|min:4|max:70|unique:pizzas',
            'prix' => 'required|numeric|between:0,999.99'
        ]);

        $pizza = new Pizza();
        $pizza->nom = $validated['nom'];
        $pizza->description = $validated['description'];
        $pizza->prix = $validated['prix'];
        $pizza->save();

        $request->session()->flash('etat', 'La nouvelle pizza a été ajoutée');
        return redirect()->route('pizzas.index');
    }

    public function index()
    {
        $pizzas = Pizza::orderBy('created_at', 'asc')->get();
        return view('admin.liste_pizzas', ['pizzas' => $pizzas]);
    }

    public function edit($id)
    {
        $pizza = Pizza::findOrFail($id);
        return view('admin.update_form', ['pizza' => $pizza]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|min:4|max:30|unique:pizzas',
            'description' => 'required|string|min:4|max:70|unique:pizzas',
            'prix' => 'required|numeric|between:0,999.99'
        ]);

        Pizza::where('id', $id)->update([
            'nom' => $validated['nom'],
            'description' => $validated['description'],
            'prix' => $validated['prix']
        ]);

        $request->session()->flash('etat', 'Modification effectuée');
        return redirect()->route('pizzas.index');
    }

    public function deletePizza(Request $request, $id)
    {
        $nom = Pizza::where(['id' => $id])->first()->nom;
        Pizza::where('id', $id)->delete();
        CommandePizza::where('pizza_id', $id)->delete();
        $request->session()->flash('etat', 'pizza ' . $nom . ' a été supprimée');
        return redirect()->back();
    }

    public function findOrder()
    {
        return view('admin.date_form');
    }

    public function displayOrder(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
        ]);

        $commandes = Commande::whereDate('created_at', $validated['date'])
            ->orWhereDate('updated_at', $validated['date'])
            ->get();
        return view('admin.affichage_commande_date', ['commandes' => $commandes]);
    }

    public function watchDetail(Request $request, $id)
    {
        $pizzas = Commande::find($id)->pizzas;
        $user = Commande::find($id)->user->prenom;
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
        return view('admin.detail_commande_date', ['pizzas' => $pizzas, 'user' => $user, 'prix' => $prixTotal, 'commande_id' => $id]);
    }
}
