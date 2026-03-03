<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use Illuminate\Http\Request;

class CollaboratorController extends Controller
{
    public function index()
    {
        
        return response()->json(
            Collaborator::all(),
            200
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'      => 'required',
            'last_name'       => 'required',
            'document_type'   => 'required|in:CC,CE,PPT',
            'document_number' => 'required|unique:collaborators',
            'birth_date'      => 'required|date',
            'email'           => 'required|email',
            'phone_number'    => 'required',
            'address'         => 'required',
        ]);

        Collaborator::create($validated);

        return redirect('/collaborators');
    }

    public function edit($id)
    {
        return response()->json(
            Collaborator::findOrFail($id),
            200
        );
    }

    public function update(Request $request, $id)
    {
        $collaborator = Collaborator::findOrFail($id);

        $validated = $request->validate([
            'first_name'      => 'required',
            'last_name'       => 'required',
            'document_type'   => 'required|in:CC,CE,PPT',
            'document_number' => 'required|unique:collaborators,document_number,' . $collaborator->id,
            'birth_date'      => 'required|date',
            'email'           => 'required|email',
            'phone_number'    => 'required',
            'address'         => 'required',
        ]);

        $collaborator->update($validated);

        return redirect('/collaborators');

        
    }

    public function destroy($id)
    {
        $collaborator = Collaborator::findOrFail($id);
        $collaborator->delete(); 

        return response()->json(['message' => 'Collaborator deleted'], 200);
    }
}