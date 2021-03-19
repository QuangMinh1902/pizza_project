<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\CommandePizza;
use Illuminate\Http\Request;
use App\Models\Pizza;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function listPizzas()
    {
        $pizzas = Pizza::paginate(5);
        return view('users.liste_pizzas', ['pizzas' => $pizzas]);
    }

    public function changePassword()
    {
        return view('auth.password_reset');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:6|max:20',
            'confirm_password' => 'required|same:new_password'
        ]);

        if (Hash::check($request->old_password, Auth::user()->mdp)) {
            User::where('id', Auth::user()->id)->update([
                'mdp' => Hash::make($request->new_password)
            ]);
            return redirect()->intended('pizzas/user');
        } else {
            return back()->withErrors([
                'error' => 'Old password does not matched.',
            ]);
        }
    }

    public function addCard(Request $request, $nom, $id, $prix)
    {
        $request->session()->put(
            $nom,
            [
                'pizza_id' => $id,
                'pizza_qty' => 1,
                'prix/pizza' => $prix,
                'prix_total' => $prix
            ]
        );
        if ($request->session()->has('ListNom')) {
            $request->session()->push('ListNom', $nom);
        } else {
            $request->session()->put('ListNom', [$nom]);
        }

        if ($request->session()->has('ListId')) {
            $request->session()->push('ListId', $id);
        } else {
            $request->session()->put('ListId', [$id]);
        }

        return redirect()->back();
    }

    public function updateCard(Request $request)
    {
        $request->session()->put('prixTOTAL', 0);
        $ids = array();
        if ($request->session()->has('ListNom')) {
            $array = $request->session()->get('ListNom');
            foreach ($array as $key => $value) {
                array_push($ids, $value);
                $request->session()->increment('prixTOTAL', ($request->session()->get($value)['prix_total']));
            }
        }
        $pizzas = Pizza::query()->select()->whereIn('nom', $ids)->get();
        return view('users.shopping_card', ['pizza' => $pizzas]);
    }

    public function deletePizzas(Request $request, $nom, $id)
    {
        $request->session()->forget($nom);
        $ids = array();
        $array = $request->session()->get('ListNom');
        foreach ($array as $key => $value) {
            if ($value != $nom) {
                array_push($ids, $value);
            }
        }
        $new_listId = array();
        $items = $request->session()->get('ListId');
        foreach ($items as $key => $value) {
            if ($value != $id) {
                array_push($new_listId, $value);
            }
        }
        $request->session()->forget('ListNom');
        $request->session()->put('ListNom', $ids);
        $request->session()->forget('prixTOTAL');
        $request->session()->forget('ListId');
        $request->session()->put('ListId', $new_listId);
        return redirect()->action([UserController::class, 'updateCard']);
    }

    public function changeQty(Request $request, $nom, $prix)
    {
        $request->validate([
            'quantity' => 'bail|required|integer|gte:1|lte:120',
        ]);
        $items = $request->session()->get($nom);
        foreach ($items as  $key => $value) {
            if ($key == 'pizza_qty') {
                $items[$key] = $request->quantity;
            }
            if ($key == 'prix_total') {
                $items[$key] = $prix * $request->quantity;
            }
        }
        $request->session()->forget($nom);
        $request->session()->put($nom, $items);
        $request->session()->forget('prixTOTAL');
        return redirect()->action([UserController::class, 'updateCard']);
    }

    public function backToList()
    {
        return redirect()->action([UserController::class, 'listPizzas']);
    }

    public function confirmOrder(Request $request)
    {
        $list = $request->session()->get('ListId');
        $pizza = Pizza::find($list);
        $commande = new Commande();
        $commande->user_id = Auth::id();
        $commande->statut = 'envoye';
        $commande->save();
        $commande->pizzas()->attach($pizza);
        $list = $request->session()->get('ListNom');
        foreach ($list as $cle => $valeur) {
            CommandePizza::query()
                ->where('commande_id', $commande->id)
                ->where('pizza_id', $request->session()->get($valeur)['pizza_id'])
                ->update(['qte' => $request->session()->get($valeur)['pizza_qty']]);
            $request->session()->forget($valeur);
        }
        $request->session()->forget('ListId');
        $request->session()->forget('ListNom');
        $request->session()->forget('prixTOTAL');
        return redirect()->action([UserController::class, 'listPizzas']);
    }

    public function listOrder($userId)
    {
        $commandes = Commande::query()->select()->where('user_id', $userId)->get();
        return view('users.liste_commandes', ['commandes' => $commandes]);
    }

    public function detailOrder(Request $request, $id)
    {
        $pizzas = Commande::find($id)->pizzas;
        $commande = Commande::find($id);
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
        return view(
            'users.detail_commandes',
            [
                'pizzas' => $pizzas,
                'prixTotal' => $prixTotal,
                'statut' => $commande->statut,
                'commande_id' => $id
            ]
        );
    }

    public function listNotRetrieved()
    {
        $commandes = Commande::query()->select()
            ->where('user_id', Auth::id())
            ->whereIn('statut', ['envoye', 'traitement', 'pret'])
            ->get();
        return view('users.liste_non_recupere', ['commandes' => $commandes]);
    }
}
