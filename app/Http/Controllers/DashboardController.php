<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMahasiswa  = Mahasiswa::count();
        $mahasiswaAktif  = Mahasiswa::where('status', 'Aktif')->count();
        $mahasiswaCuti   = Mahasiswa::where('status', 'Cuti')->count();
        $mahasiswaLulus  = Mahasiswa::where('status', 'Lulus')->count();
        $mahasiswaKeluar = Mahasiswa::where('status', 'Keluar')->count();

        $prodiStats      = ProgramStudi::withCount('mahasiswa')->get();
        $recentMahasiswa = Mahasiswa::with('programStudi')->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalMahasiswa',
            'mahasiswaAktif',
            'mahasiswaCuti',
            'mahasiswaLulus',
            'mahasiswaKeluar',
            'prodiStats',
            'recentMahasiswa'
        ));
    }
}
