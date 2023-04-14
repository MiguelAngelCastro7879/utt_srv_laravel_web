<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Cast\Object_;

class Roles extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
    ];
    /**
     * The roles codes.
     *  'usuario'=>0,           Puede entrar solo por dominio
     * 
     *  'supervisor'=>1,        Puede entrar por cualquier lado
     * 
     *  'administrador'=>2,     Solo entra por VPN
     */
    public function getRoles(){
        return json_encode(array(
            'usuario'=>1,
            'supervisor'=>2,
            'administrador'=>3,
        ));
    }
}
