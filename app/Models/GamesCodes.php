<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GamesCodes extends Model
{
    use HasFactory;
    public function getStatuses(){
        return json_encode(array(
            'inactivo'=>0,
            'actualizacion'=>1,
            'eliminacion'=>2,
            'usado'=>3,
        ));
    }
    
    protected $fillable = [
        'codigo',
        'status',
        'user_id',
        'url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
