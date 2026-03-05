<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'collaborator_id' => 'required|exists:collaborators,id',
            'contract_type'   => 'required|in:Fijo,Indefinido,Prestación de Servicios',
            'start_date'      => 'required|date',
            'end_date'        => 'nullable|date|after_or_equal:start_date',
            'position'        => 'required|string',
            'salary'          => 'required|numeric|min:0',
            'status'          => 'required|in:Activo,Terminado,Finalizado',
        ]);

        Contract::create($validated);

        return redirect('/contracts');
    }

    public function update(Request $request, $id)
    {
        $contract = Contract::findOrFail($id);

        $validated = $request->validate([
            'collaborator_id' => 'required|exists:collaborators,id',
            'contract_type'   => 'required|in:Fijo,Indefinido,Prestación de Servicios',
            'start_date'      => 'required|date',
            'end_date'        => 'nullable|date|after_or_equal:start_date',
            'position'        => 'required|string',
            'salary'          => 'required|numeric|min:0',
            'status'          => 'required|in:Activo,Terminado,Finalizado',
        ]);

        $contract->update($request->all());

        return response()->json([
            'message' => 'Contrato actualizado exitosamente',
            
        ], 200);
    }
}