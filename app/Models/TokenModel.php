<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class TokenModel extends Model
{
    use HasFactory;

    protected $table = 'tokens';

    protected $fillable = [
        'user_id',
        'edit_token',
        'status'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
