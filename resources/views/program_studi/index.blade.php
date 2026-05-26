@extends('layouts.app')

@section('title', 'Program Studi')
@section('page-title', 'Program Studi')

@section('content')
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="fas fa-book-open me-2 text-success"></i>Daftar Program Studi</span>
        <a href="{{ route('program-studi.create') }}" class="btn btn-success btn-sm">
            <i class="fas fa-plus me-1"></i>Tambah Program Studi
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="45">#</th>
                        <th>Nama Program Studi</th>
                        <th>Jenjang</th>
                        <th>Fakultas</th>
                        <th class="text-center">Jumlah Mahasiswa</th>
                        <th class="text-center" width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programStudi as $index => $prodi)
                    <tr>
                        <td class="text-muted small">{{ $programStudi->firstItem() + $index }}</td>
                        <td class="fw-medium">{{ $prodi->nama }}</td>
                        <td><span class="badge bg-secondary">{{ $prodi->jenjang }}</span></td>
                        <td class="text-muted small">{{ $prodi->fakultas ?? '-' }}</td>
                        <td class="text-center">
                            <span class="badge bg-primary rounded-pill">{{ $prodi->mahasiswa_count }}</span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('program-studi.edit', $prodi) }}"
                                   class="btn btn-outline-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button"
                                        class="btn btn-outline-danger btn-hapus-prodi"
                                        data-id="{{ $prodi->id }}"
                                        data-nama="{{ $prodi->nama }}"
                                        data-count="{{ $prodi->mahasiswa_count }}"
                                        title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <form id="form-hapus-prodi-{{ $prodi->id }}"
                                  action="{{ route('program-studi.destroy', $prodi) }}"
                                  method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fas fa-inbox fa-3x mb-3 d-block opacity-25"></i>
                            Belum ada program studi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
            <div class="text-muted small">
                Menampilkan <strong>{{ $programStudi->firstItem() ?? 0 }}</strong>–<strong>{{ $programStudi->lastItem() ?? 0 }}</strong>
                dari <strong>{{ $programStudi->total() }}</strong> data
            </div>
            {{ $programStudi->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.btn-hapus-prodi').forEach(btn => {
    btn.addEventListener('click', function () {
        const id    = this.dataset.id;
        const nama  = this.dataset.nama;
        const count = parseInt(this.dataset.count);

        if (count > 0) {
            Swal.fire({
                title: 'Tidak Dapat Dihapus!',
                html: `Program studi <strong>${nama}</strong> masih memiliki <strong>${count}</strong> mahasiswa.<br>Pindahkan atau hapus mahasiswa terlebih dahulu.`,
                icon: 'error',
                confirmButtonText: 'Mengerti',
            });
            return;
        }

        Swal.fire({
            title: 'Hapus Program Studi?',
            html: `Program studi <strong>${nama}</strong> akan dihapus permanen.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor:  '#6c757d',
            confirmButtonText:  '<i class="fas fa-trash me-1"></i>Ya, Hapus!',
            cancelButtonText:   'Batal',
            reverseButtons: true,
        }).then(result => {
            if (result.isConfirmed) {
                document.getElementById('form-hapus-prodi-' + id).submit();
            }
        });
    });
});
</script>
@endpush