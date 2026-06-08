@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- ── STAT CARDS ── --}}
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stat-card" style="background:linear-gradient(135deg,#667eea,#764ba2);">
            <div class="bg-icon"><i class="fas fa-users"></i></div>
            <div style="font-size:.8rem;opacity:.8;">Total Mahasiswa</div>
            <div class="h2 fw-bold mb-0">{{ $totalMahasiswa }}</div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card" style="background:linear-gradient(135deg,#11998e,#38ef7d);">
            <div class="bg-icon"><i class="fas fa-user-check"></i></div>
            <div style="font-size:.8rem;opacity:.8;">Mahasiswa Aktif</div>
            <div class="h2 fw-bold mb-0">{{ $mahasiswaAktif }}</div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card" style="background:linear-gradient(135deg,#f7971e,#ffd200);">
            <div class="bg-icon"><i class="fas fa-user-clock"></i></div>
            <div style="font-size:.8rem;opacity:.8;">Sedang Cuti</div>
            <div class="h2 fw-bold mb-0">{{ $mahasiswaCuti }}</div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card" style="background:linear-gradient(135deg,#2980b9,#6dd5fa);">
            <div class="bg-icon"><i class="fas fa-user-graduate"></i></div>
            <div style="font-size:.8rem;opacity:.8;">Sudah Lulus</div>
            <div class="h2 fw-bold mb-0">{{ $mahasiswaLulus }}</div>
        </div>
    </div>
</div>

{{-- ── STATUS SUMMARY ── --}}
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-chart-bar me-2 text-primary"></i>Ringkasan Status Mahasiswa
    </div>
    <div class="card-body">
        <div class="row g-3 text-center">
            @php
                $statuses = [
                    ['label' => 'Aktif',  'count' => $mahasiswaAktif,  'color' => 'success', 'bg' => '#d1fae5'],
                    ['label' => 'Cuti',   'count' => $mahasiswaCuti,   'color' => 'warning', 'bg' => '#fef3c7'],
                    ['label' => 'Lulus',  'count' => $mahasiswaLulus,  'color' => 'primary', 'bg' => '#dbeafe'],
                    ['label' => 'Keluar', 'count' => $mahasiswaKeluar, 'color' => 'danger',  'bg' => '#fee2e2'],
                ];
            @endphp
            @foreach($statuses as $s)
            <div class="col-md-3">
                <div class="p-3 rounded" style="background:{{ $s['bg'] }};">
                    <div class="h3 fw-bold text-{{ $s['color'] }} mb-1">{{ $s['count'] }}</div>
                    <div class="small text-{{ $s['color'] }}">{{ $s['label'] }}</div>
                    @if($totalMahasiswa > 0)
                    <div class="progress mt-2" style="height:4px;background:rgba(0,0,0,.1);">
                        <div class="progress-bar bg-{{ $s['color'] }}"
                             style="width:{{ round(($s['count']/$totalMahasiswa)*100) }}%">
                        </div>
                    </div>
                    <div class="small text-{{ $s['color'] }} mt-1">
                        {{ round(($s['count']/$totalMahasiswa)*100) }}%
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ── TABEL ── --}}
<div class="row g-3">
    {{-- Per Prodi --}}
    <div class="col-lg-5">
        <div class="card h-100">
            <div class="card-header">
                <i class="fas fa-chart-pie me-2 text-success"></i>Mahasiswa per Program Studi
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Program Studi</th>
                            <th>Jenjang</th>
                            <th class="text-center">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($prodiStats as $prodi)
                        <tr>
                            <td class="fw-medium">{{ $prodi->nama }}</td>
                            <td><span class="badge bg-secondary">{{ $prodi->jenjang }}</span></td>
                            <td class="text-center">
                                <span class="badge bg-primary rounded-pill">{{ $prodi->mahasiswa_count }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">Belum ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Mahasiswa Terbaru --}}
    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="fas fa-clock me-2 text-warning"></i>Mahasiswa Terbaru</span>
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-sm btn-outline-primary">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Prodi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentMahasiswa as $mhs)
                        <tr>
                            <td class="font-monospace small">{{ $mhs->nim }}</td>
                            <td>{{ $mhs->nama }}</td>
                            <td class="small text-muted">{{ $mhs->programStudi->nama ?? '-' }}</td>
                            <td>
                                @php
                                    $color = match($mhs->status) {
                                        'Aktif'=>'success','Cuti'=>'warning',
                                        'Lulus'=>'primary','Keluar'=>'danger',default=>'secondary'
                                    };
                                @endphp
                                <span class="badge bg-{{ $color }}">{{ $mhs->status }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Belum ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection