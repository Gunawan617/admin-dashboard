<?php

namespace App\Http\Controllers;

use App\Models\BimbelProgram;
use Illuminate\Http\Request;

class BimbelProgramController extends Controller
{
    // Ambil semua data
    public function index()
    {
        return response()->json(BimbelProgram::all());
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:bimbel_programs',
            'name' => 'required',
            'category' => 'required',
        ]);

        $program = BimbelProgram::create($request->all());
        return response()->json($program, 201);
    }

    // Ambil detail data by ID
    public function show($id)
    {
        return response()->json(BimbelProgram::findOrFail($id));
    }

    // Update data by ID
    public function update(Request $request, $id)
    {
        $program = BimbelProgram::findOrFail($id);
        $program->update($request->all());
        return response()->json($program);
    }

    // Hapus data by ID
    public function destroy($id)
    {
        BimbelProgram::findOrFail($id)->delete();
        return response()->json(['message' => 'Data deleted successfully']);
    }
}
