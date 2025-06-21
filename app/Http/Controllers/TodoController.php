<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;




class TodoController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/todos",
     * tags={"Todos"},
     * summary="Retrieve a list of all todo items",
     * description="Returns all todo items available in the database",
     * @OA\Response(
     * response=200,
     * description="Successful operation",
     * @OA\JsonContent(
     * type="array",
     * @OA\Items(ref="#/components/schemas/Todo")
     * )
     * ),
     * @OA\Response(
     * response=401,
     * description="Unauthorized - Authentication required"
     * )
     * )
     */
    public function index()
    {
        $todos = Todo::all();

        // return response()->json(['data' => $todos]);
        // return TodoResource::collection($todos);
        // return Todo::all()->toResourceCollection();
        return response()->json([
            'message' => 'List data todos',
            'data' => TodoResource::collection($todos)
        ]);
    }

    /**
     * @OA\Get(
     * path="/api/todos/{id}",
     * tags={"Todos"},
     * summary="Retrieve a single todo item by ID (Requires Bearer Token)",
     * description="Returns a specific todo item based on its unique identifier.",
     * @OA\Parameter(
     * name="id",
     * in="path",
     * description="ID of the todo item to retrieve",
     * required=true,
     * @OA\Schema(
     * type="integer"
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="Successful operation",
     * @OA\JsonContent(ref="#/components/schemas/Todo")
     * ),
     * @OA\Response(
     *  response=401,
     *  description="Unauthorized - Authentication required. Please provide a valid Bearer Token."
     *  ),
     * @OA\Response(
     * response=404,
     * description="Not Found - Todo item with the specified ID does not exist."
     * ),
     * security={{"bearerAuth": {}}}  
     * )
     */
    public function show($id)
    {
        $todo = Todo::findOrFail($id);

        // return response()->json(['data' => $todo]);
        return new TodoResource($todo);
        // return Todo::findOrFail($id)->toResource();
    }

    /**
     * @OA\Post(
     * tags={"Todos"},
     * path="/api/todos",
     * summary="Create a new todo item",
     * description="Adds a new todo item to the database.",
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * type="object",
     * required={"name", "status"},
     * @OA\Property(property="name", type="string", example="Buy groceries"),
     * @OA\Property(property="status", type="string", enum={"in progress", "done", "canceled"}, example="in progress"),
     * )
     * ),
     * @OA\Response(
     * response=201,
     * description="Created - The new todo item was successfully created.",
     * @OA\JsonContent(ref="#/components/schemas/Todo")
     * ),
     * @OA\Response(
     * response=401,
     * description="Unauthorized - Authentication required"
     * ),
     * @OA\Response(
     * response=422,
     * description="Unprocessable Entity - Validation failed for the provided data.",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="The given data was invalid."),
     * @OA\Property(property="errors", type="object",
     * @OA\Property(property="name", type="array", @OA\Items(type="string", example="The name field is required.")),
     * @OA\Property(property="status", type="array", @OA\Items(type="string", example="The selected status is invalid."))
     * )
     * )
     * )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|in:in progress,done,canceled',
        ]);

        $todo = Todo::create($request->all());
        $todo->refresh();

        return response()->json(['data' => new TodoResource($todo)], 201);
    }

    /**
     * @OA\Patch(
     * path="/api/todos/{id}",
     * tags={"Todos"},
     * summary="Update an existing todo item",
     * description="Modifies the details of an existing todo item identified by its ID.",
     * @OA\Parameter(
     * name="id",
     * in="path",
     * description="ID of the todo item to update",
     * required=true,
     * @OA\Schema(
     * type="integer"
     * )
     * ),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * type="object",
     * required={"name", "status"},
     * @OA\Property(property="name", type="string", example="Updated todo name"),
     * @OA\Property(property="status", type="string", enum={"in progress", "done", "canceled"}, example="done")
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="Successful operation - The todo item was updated.",
     * @OA\JsonContent(ref="#/components/schemas/Todo")
     * ),
     * @OA\Response(
     * response=404,
     * description="Not Found - Todo item with the specified ID does not exist."
     * ),
     * @OA\Response(
     * response=422,
     * description="Unprocessable Entity - Validation failed for the provided data.",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="The given data was invalid."),
     * @OA\Property(property="errors", type="object",
     * @OA\Property(property="name", type="array", @OA\Items(type="string", example="The name field is required.")),
     * @OA\Property(property="status", type="array", @OA\Items(type="string", example="The selected status is invalid."))
     * )
     * )
     * )
     * )
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|in:in progress,done,canceled',
        ]);

        $todo = Todo::findOrFail($id);
        $todo->name = $request->name;
        $todo->status = $request->status;
        $todo->save();

        return response()->json(['data' => new TodoResource($todo)], 200);
    }

    /**
     * @OA\Delete(
     * path="/api/todos/{id}",
     * tags={"Todos"},
     * summary="Delete a todo item",
     * description="Removes a specific todo item from the database based on its ID.",
     * @OA\Parameter(
     * name="id",
     * in="path",
     * description="ID of the todo item to delete",
     * required=true,
     * @OA\Schema(
     * type="integer"
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="Successful operation - The todo item was deleted.",
     * @OA\JsonContent(ref="#/components/schemas/Todo")
     * ),
     * @OA\Response(
     * response=404,
     * description="Not Found - Todo item with the specified ID does not exist."
     * )
     * )
     */
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return response()->json(['data' => new TodoResource($todo)], 200);
    }
}
