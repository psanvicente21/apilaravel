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
    protected $hidden = ['password'];
    public function state(){
        return $this->belongsTo(State::class);
    }
}
