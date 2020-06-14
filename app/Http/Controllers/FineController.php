<?php

namespace App\Http\Controllers;

use App\Fine;
use Illuminate\Http\Request;

class FineController extends Controller
{
    public function addFine(Request $request)
    {
        $request = $request->validate([
            'timestamp' => 'nullable|date',
            'description' => 'required|string',
            'IdPerson' => 'required|integer',
        ]);

        $fine = new Fine();
        $fine->timestamp = $request['timestamp'];
        $fine->description = $request['description'];
        $fine->IdPerson = $request['IdPerson'];
        $fine->save();

        return response()->json($fine, 201);
    }

    public function editFine(Request $request, $id)
    {
        $request = $request->validate([
            'timestamp' => 'nullable|date',
            'description' => 'required|string',
            'IdPerson' => 'required|integer',
        ]);

        $fine = new Fine();
        $fine->timestamp = $request['timestamp'];
        $fine->description = $request['description'];
        $fine->IdPerson = $request['IdPerson'];
        $fine->save();

        return response()->json($fine, 200);
    }

    public function removeFine($id)
    {
        $fine = Fine::findOrFail($id);
        $fine->delete();

        return response()->json(200);
    }
}
