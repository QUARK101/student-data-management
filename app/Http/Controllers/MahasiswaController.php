<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::with('programStudi');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%");
            });
        }

        if ($request->filled('program_studi_id')) {
            $query->where('program_studi_id', $request->program_studi_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $mahasiswa    = $query->latest()->paginate(10)->withQueryString();
        $programStudi = ProgramStudi::all();

        return view('mahasiswa.index', compact('mahasiswa', 'programStudi'));
    }

    public function create()
    {
        $programStudi = ProgramStudi::all();
        return view('mahasiswa.create', compact('programStudi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_studi_id' => 'required|exists:program_studi,id',
            'nama'             => 'required|string|max:255',
            'nim'              => 'required|string|max:20|unique:mahasiswa,nim',
            'email'            => 'nullable|email|max:255|unique:mahasiswa,email',
            'no_hp'            => 'nullable|string|max:20',
            'angkatan'         => 'required|integer|min:2000|max:' . date('Y'),
            'status'           => 'required|in:Aktif,Cuti,Lulus,Keluar',
            'alamat'           => 'nullable|string',
        ]);

        Mahasiswa::create($validated);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('programStudi');
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $programStudi = ProgramStudi::all();
        return view('mahasiswa.edit', compact('mahasiswa', 'programStudi'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'program_studi_id' => 'required|exists:program_studi,id',
            'nama'             => 'required|string|max:255',
            'nim'              => 'required|string|max:20|unique:mahasiswa,nim,' . $mahasiswa->id,
            'email'            => 'nullable|email|max:255|unique:mahasiswa,email,' . $mahasiswa->id,
            'no_hp'            => 'nullable|string|max:20',
            'angkatan'         => 'required|integer|min:2000|max:' . date('Y'),
            'status'           => 'required|in:Aktif,Cuti,Lulus,Keluar',
            'alamat'           => 'nullable|string',
        ]);

        $mahasiswa->update($validated);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
