<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'cif',
        'name',
        'password',
        'state_id',
    ];
    //Atributos ocultos en la serialización
    //protected $hidden = ['password'];

    //Atributos visibles en la serialización
    protected $visible = ['name','cif','state_id'];
    //Un cliente tiene un state
    public function state(){
        return $this->belongsTo(State::class);
    }
}
