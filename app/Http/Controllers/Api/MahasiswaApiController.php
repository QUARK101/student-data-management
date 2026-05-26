<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MahasiswaResource;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaApiController extends Controller
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

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('program_studi_id')) {
            $query->where('program_studi_id', $request->program_studi_id);
        }

        $mahasiswa = $query->latest()->paginate(15);

        return MahasiswaResource::collection($mahasiswa)->additional([
            'status'  => 'success',
            'message' => 'Data mahasiswa berhasil diambil.',
        ]);
    }

    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('programStudi');

        return (new MahasiswaResource($mahasiswa))->additional([
            'status'  => 'success',
            'message' => 'Detail mahasiswa berhasil diambil.',
        ]);
    }
}
