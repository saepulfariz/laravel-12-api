<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @OA\Schema(
 * schema="Todo",
 * type="object",
 * title="Todo",
 * description="Todo Model representing a task or item to be completed.",
 * required={"name","status","category_id"},
 * @OA\Property(
 * property="id",
 * type="integer",
 * description="Unique identifier for the Todo item.",
 * example=1
 * ),
 * @OA\Property(
 * property="name",
 * type="string",
 * description="Name or title of the todo item."
 * ),
 * @OA\Property(
 * property="status",
 * type="string",
 * description="Current status of the todo item",
 * example="in progress, done, canceled"
 * ),
 * @OA\Property(
 * property="created_at",
 * type="string",
 * format="date-time",
 * description="Timestamp when the todo item was created."
 * ),
 * @OA\Property(
 * property="updated_at",
 * type="string",
 * format="date-time",
 * description="Timestamp when the todo item was last updated."
 * ),
 * @OA\Property(property="name_category", type="string", example="Learning"),
 * @OA\Property(
 *     property="category",
 *     ref="#/components/schemas/Category"
 *   )
 * )
 */

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
