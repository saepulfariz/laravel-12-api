<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    protected $fillable = [
        'name',
        'status',
        'category_id'
    ];

    function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
