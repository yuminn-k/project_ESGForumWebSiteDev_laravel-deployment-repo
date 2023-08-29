<?php

namespace App\Http\Controllers;

use App\Models\Committee;
use Illuminate\Http\Request;

class CommitteeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'explanation' => 'required|string',
        ]);

        $committee = Committee::create($request->all());

        return response()->json($committee, 201);
    }

    public function index()
    {
        $committees = Committee::all();

        return response()->json($committees);
    }

    public function find($id)
    {
        $committee = Committee::find($id);

        if (!$committee) {
            return response()->json('Not Found', 404);
        }

        return response()->json($committee);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'explanation' => 'required|string',
        ]);

        $committee = Committee::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'explanation' => $request->input('explanation')
            ]);

        return response()->json($committee);
    }

    public function destroy($id)
    {
        Committee::where('id', $id)->delete();
        return response()->json(['message' => 'Committee deleted successfully'], 204);
    }
}
