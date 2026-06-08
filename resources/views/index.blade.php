@extends('layouts.app')

@section('title', 'Data Mahasiswa')
@section('page-title', 'Data Mahasiswa')

@section('content')
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="fas fa-user-graduate me-2 text-primary"></i>Daftar Mahasiswa</span>
        <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Tambah Mahasiswa
        </a>
    </div>
    <div class="card-body">

        {{-- Filter & Search --}}
        <form method="GET" action="{{ route('mahasiswa.index') }}" class="row g-2 mb-4">
            <div class="col-md-4">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control"
                           placeholder="Cari nama atau NIM..."
                           value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="program_studi_id" class="form-select form-select-sm">
                    <option value="">Semua Program Studi</option>
                    @foreach($programStudi as $prodi)
                        <option value="{{ $prodi->id }}"
                            {{ request('program_studi_id') == $prodi->id ? 'selected' : '' }}>
                            {{ $prodi->nama }} ({{ $prodi->jenjang }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select form-select-sm">
                    <option value="">Semua Status</option>
                    @foreach(['Aktif','Cuti','Lulus','Keluar'] as $st)
                        <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>
                            {{ $st }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-auto d-flex gap-1">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fas fa-filter me-1"></i>Filter
                </button>
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-redo"></i>
                </a>
            </div>
        </form>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="45">#</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Program Studi</th>
                        <th>Angkatan</th>
                        <th>Status</th>
                        <th class="text-center" width="130">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswa as $index => $mhs)
                    <tr>
                        <td class="text-muted small">{{ $mahasiswa->firstItem() + $index }}</td>
                        <td class="font-monospace fw-medium small">{{ $mhs->nim }}</td>
                        <td>
                            <div class="fw-medium">{{ $mhs->nama }}</div>
                            @if($mhs->email)
                                <div class="small text-muted">{{ $mhs->email }}</div>
                            @endif
                        </td>
                        <td>
                            <div class="small">{{ $mhs->programStudi->nama ?? '-' }}</div>
                            <span class="badge bg-light text-dark border" style="font-size:.65rem;">
                                {{ $mhs->programStudi->jenjang ?? '' }}
                            </span>
                        </td>
                        <td>{{ $mhs->angkatan }}</td>
                        <td>
                            @php
                                $color = match($mhs->status) {
                                    'Aktif'=>'success','Cuti'=>'warning',
                                    'Lulus'=>'primary','Keluar'=>'danger',default=>'secondary'
                                };
                            @endphp
                            <span class="badge bg-{{ $color }}">{{ $mhs->status }}</span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('mahasiswa.show', $mhs) }}"
                                   class="btn btn-outline-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('mahasiswa.edit', $mhs) }}"
                                   class="btn btn-outline-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button"
                                        class="btn btn-outline-danger btn-hapus"
                                        data-id="{{ $mhs->id }}"
                                        data-nama="{{ $mhs->nama }}"
                                        title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <form id="form-hapus-{{ $mhs->id }}"
                                  action="{{ route('mahasiswa.destroy', $mhs) }}"
                                  method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fas fa-inbox fa-3x mb-3 d-block opacity-25"></i>
                            Tidak ada data mahasiswa yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
            <div class="text-muted small">
                Menampilkan <strong>{{ $mahasiswa->firstItem() ?? 0 }}</strong>–<strong>{{ $mahasiswa->lastItem() ?? 0 }}</strong>
                dari <strong>{{ $mahasiswa->total() }}</strong> data
            </div>
            {{ $mahasiswa->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.btn-hapus').forEach(btn => {
    btn.addEventListener('click', function () {
        const id   = this.dataset.id;
        const nama = this.dataset.nama;
        Swal.fire({
            title: 'Hapus Mahasiswa?',
            html: `Data <strong>${nama}</strong> akan dihapus secara permanen dan tidak dapat dikembalikan.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor:  '#6c757d',
            confirmButtonText:  '<i class="fas fa-trash me-1"></i>Ya, Hapus!',
            cancelButtonText:   'Batal',
            reverseButtons: true,
        }).then(result => {
            if (result.isConfirmed) {
                document.getElementById('form-hapus-' + id).submit();
            }
        });
    });
});
</script>
@endpush