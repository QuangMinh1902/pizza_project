<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $table = 'users';

    public $timestamps = false;

    protected $hidden = ['mdp'];

    protected $fillable = ['login', 'mdp', 'type'];

    protected $attribute = ['type' => 'user'];

    public function getAuthPassword()
    {
        return $this->mdp;
    }

    public function isAdmin()
    {
        return $this->type == 'admin';
    }

    public function isUser()
    {
        return $this->type == 'user';
    }

    public function isCook()
    {
        return $this->type == 'cook';
    }

    public function commandes(){
        return $this->hasMany(Commande::class);
    }

    public function pizzas(){
        return $this->hasMany(Pizza::class);
    }
}
