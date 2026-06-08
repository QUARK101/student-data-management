@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold text-dark">
            <i class="fas fa-users me-2 text-primary"></i>Data Mahasiswa
        </h1>
        <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Tambah Mahasiswa
        </a>
    </div>

    {{-- Filter & Search --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('mahasiswa.index') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari nama atau NIM..."
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="program_studi_id" class="form-select">
                            <option value="">-- Semua Prodi --</option>
                            @foreach($programStudi as $prodi)
                                <option value="{{ $prodi->id }}"
                                    {{ request('program_studi_id') == $prodi->id ? 'selected' : '' }}>
                                    {{ $prodi->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">-- Semua Status --</option>
                            @foreach(['Aktif','Cuti','Lulus','Keluar'] as $s)
                                <option value="{{ $s }}"
                                    {{ request('status') == $s ? 'selected' : '' }}>
                                    {{ $s }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-1"></i>Filter
                        </button>
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary w-100">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Program Studi</th>
                            <th>Angkatan</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswa as $mhs)
                        <tr>
                            <td>{{ $loop->iteration + ($mahasiswa->currentPage() - 1) * $mahasiswa->perPage() }}</td>
                            <td><code>{{ $mhs->nim }}</code></td>
                            <td>{{ $mhs->nama }}</td>
                            <td>
                                {{ $mhs->programStudi->nama ?? '-' }}<br>
                                <small class="text-muted">{{ $mhs->programStudi->jenjang ?? '' }}</small>
                            </td>
                            <td>{{ $mhs->angkatan }}</td>
                            <td>
                                @php
                                    $badge = [
                                        'Aktif'  => 'success',
                                        'Cuti'   => 'warning',
                                        'Lulus'  => 'info',
                                        'Keluar' => 'danger',
                                    ][$mhs->status] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $badge }}">{{ $mhs->status }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('mahasiswa.show', $mhs) }}"
                                    class="btn btn-sm btn-info text-white" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('mahasiswa.edit', $mhs) }}"
                                    class="btn btn-sm btn-warning text-white" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('mahasiswa.destroy', $mhs) }}"
                                    method="POST" class="d-inline" id="form-delete-{{ $mhs->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger"
                                        title="Hapus"
                                        onclick="confirmDelete({{ $mhs->id }}, '{{ $mhs->nama }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                Tidak ada data mahasiswa ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($mahasiswa->hasPages())
        <div class="card-footer d-flex justify-content-between align-items-center">
            <small class="text-muted">
                Menampilkan {{ $mahasiswa->firstItem() }}–{{ $mahasiswa->lastItem() }}
                dari {{ $mahasiswa->total() }} data
            </small>
            {{ $mahasiswa->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function confirmDelete(id, nama) {
    Swal.fire({
        title: 'Hapus Mahasiswa?',
        text: nama + ' akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('form-delete-' + id).submit();
        }
    });
}
</script>
@endpush
@endsection