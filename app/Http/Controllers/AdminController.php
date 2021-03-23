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
}
