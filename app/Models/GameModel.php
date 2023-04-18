<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\CategoryModel;

class GameModel extends Model
{
    // use HasFactory;

    protected $table = 'videogames';

    protected $fillable = [
        'name',
        'category_id',
        'status',
        'price',
        'image'
    ];

    public function category()
    {
        return $this->belongsTo(CategoryModel::class);
    }
}
