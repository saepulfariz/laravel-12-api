<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   schema="Category",
 *   type="object",
 *   title="Category",
 *   description="Category Model representing a category task or item.",
 *   required={"id", "name"},
 *   @OA\Property(property="id", type="integer", example=1),
 *   @OA\Property(property="name", type="string", example="Learning"),
 *   @OA\Property(property="created_at", type="string", format="date-time", nullable=true),
 *   @OA\Property(property="updated_at", type="string", format="date-time", nullable=true),
 * )
 */

class Category extends Model
{
    protected $fillable = [
        'name'
    ];
}
