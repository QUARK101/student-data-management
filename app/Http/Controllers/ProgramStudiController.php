<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    public function index()
    {
        $programStudi = ProgramStudi::withCount('mahasiswa')->latest()->paginate(10);
        return view('program_studi.index', compact('programStudi'));
    }

    public function create()
    {
        return view('program_studi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:255',
            'jenjang'  => 'required|in:S1,D3,D4',
            'fakultas' => 'nullable|string|max:255',
        ]);

        ProgramStudi::create($validated);

        return redirect()->route('program-studi.index')
            ->with('success', 'Program studi berhasil ditambahkan.');
    }

    public function edit(ProgramStudi $programStudi)
    {
        return view('program_studi.edit', compact('programStudi'));
    }

    public function update(Request $request, ProgramStudi $programStudi)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:255',
            'jenjang'  => 'required|in:S1,D3,D4',
            'fakultas' => 'nullable|string|max:255',
        ]);

        $programStudi->update($validated);

        return redirect()->route('program-studi.index')
            ->with('success', 'Program studi berhasil diperbarui.');
    }

    public function destroy(ProgramStudi $programStudi)
    {
        if ($programStudi->mahasiswa()->count() > 0) {
            return redirect()->route('program-studi.index')
                ->with('error', 'Program studi tidak dapat dihapus karena masih memiliki mahasiswa.');
        }

        $programStudi->delete();

        return redirect()->route('program-studi.index')
            ->with('success', 'Program studi berhasil dihapus.');
    }
}
