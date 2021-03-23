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

        $request->session()->flash('etat', 'Création effectué !');
        return redirect()->route('pizzas.index');
    }

    public function index()
    {
        $pizzas = Pizza::all();
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
            'nom' => 'required|alpha|max:20',
            'description' => 'required|string|max:50',
            'prix' => 'bail|required|integer|gte:0|lte:120',
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
        $pizza = Pizza::find($id);
        $commandeId = CommandePizza::query()->select('commande_id')->where('pizza_id', $id)->get();
        $commande = Commande::find($commandeId);
        $pizza->commandes()->detach($commande);
        Pizza::where('id', $id)->delete();
        $request->session()->flash('etat', 'pizza ' . $nom . ' a été supprimée');
        return redirect()->back();
    }
}
