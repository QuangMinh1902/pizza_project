<?php

namespace App\Http\Controllers;

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
            'nom' => 'required|string|max:20|unique:pizzas',
            'description' => 'required|string|max:70|unique:pizzas',
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

    public function deletePizza(){
        
    }
}
