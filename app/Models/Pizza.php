<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;

    protected $table = 'pizzas';

    protected $fillable = ['nom', 'description', 'created_at', 'updated_at', 'deleted_at'];

    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commandes()
    {
        return $this->belongsToMany(Commande::class);
    }
}
