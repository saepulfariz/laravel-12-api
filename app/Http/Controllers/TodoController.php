<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TodoController extends Controller
{
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
}
