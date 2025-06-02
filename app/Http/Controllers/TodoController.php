<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @OA\Schema(
 *     schema="Todo",
 *     type="object",
 *     title="Todo",
 *     description="Todo Type Model",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Unique identifier for the Todo type"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Name of the actor type"
 *     ),
 *     @OA\Property(
 *         property="status",
 *         type="string",
 *         description="Status of the actor type"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="datetime",
 *         description="Time created at of the data"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="datetime",
 *         description="Time updated at of the data"
 *     )
 * )
 */


class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();

        return response()->json(['data' => $todos]);
    }

    public function show($id)
    {
        $todo = Todo::findOrFail($id);

        return response()->json(['data' => $todo]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'status' => 'required|in:in progress, done, canceled',
        ]);

        $todo = Todo::create($request->all());
        $todo->refresh();

        return response()->json(['data' => $todo], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $todo = Todo::findOrFail($id);
        $todo->name = $request->name;
        $todo->save();

        return response()->json(['data' => $todo], 200);
    }

    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return response()->json(['data' => $todo], 200);
    }
}
