<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pizza extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pizzas';

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
