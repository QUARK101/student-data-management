@extends('layouts.app')

@section('title', 'Detail Mahasiswa')
@section('page-title', 'Detail Mahasiswa')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="fas fa-id-card me-2 text-info"></i>Detail Data Mahasiswa</span>
                <div class="d-flex gap-2">
                    <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">

                @php
                    $color = match($mahasiswa->status) {
                        'Aktif'=>'success','Cuti'=>'warning',
                        'Lulus'=>'primary','Keluar'=>'danger',default=>'secondary'
                    };
                @endphp

                {{-- Profile Header --}}
                <div class="d-flex align-items-center gap-3 p-3 rounded mb-4"
                     style="background:linear-gradient(135deg,#f8fafc,#e2e8f0);">
                    <div style="width:64px;height:64px;border-radius:50%;
                                background:linear-gradient(135deg,#667eea,#764ba2);
                                display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fas fa-user fa-xl text-white"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">{{ $mahasiswa->nama }}</h5>
                        <div class="font-monospace text-muted small">{{ $mahasiswa->nim }}</div>
                        <span class="badge bg-{{ $color }} mt-1">{{ $mahasiswa->status }}</span>
                    </div>
                </div>

                {{-- Data Table --}}
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th class="bg-light" width="200">Program Studi</th>
                            <td>{{ $mahasiswa->programStudi->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Jenjang</th>
                            <td><span class="badge bg-secondary">{{ $mahasiswa->programStudi->jenjang ?? '-' }}</span></td>
                        </tr>
                        <tr>
                            <th class="bg-light">Fakultas</th>
                            <td>{{ $mahasiswa->programStudi->fakultas ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">NIM</th>
                            <td class="font-monospace">{{ $mahasiswa->nim }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Nama Lengkap</th>
                            <td>{{ $mahasiswa->nama }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Email</th>
                            <td>{{ $mahasiswa->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">No. HP</th>
                            <td>{{ $mahasiswa->no_hp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Angkatan</th>
                            <td>{{ $mahasiswa->angkatan }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Status</th>
                            <td><span class="badge bg-{{ $color }}">{{ $mahasiswa->status }}</span></td>
                        </tr>
                        <tr>
                            <th class="bg-light">Alamat</th>
                            <td>{{ $mahasiswa->alamat ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Terdaftar</th>
                            <td>{{ $mahasiswa->created_at->locale('id')->isoFormat('D MMMM Y, HH:mm') }}</td>
                        </tr>
                    </tbody>
                </table>

                <hr>

                <div class="d-flex gap-2">
                    <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i>Edit Data
                    </a>
                    <button type="button" class="btn btn-danger"
                            id="btn-hapus-show"
                            data-nama="{{ $mahasiswa->nama }}">
                        <i class="fas fa-trash me-1"></i>Hapus
                    </button>
                    <form id="form-hapus-show"
                          action="{{ route('mahasiswa.destroy', $mahasiswa) }}"
                          method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('btn-hapus-show').addEventListener('click', function () {
    const nama = this.dataset.nama;
    Swal.fire({
        title: 'Hapus Mahasiswa?',
        html: `Data <strong>${nama}</strong> akan dihapus permanen.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor:  '#6c757d',
        confirmButtonText:  '<i class="fas fa-trash me-1"></i>Ya, Hapus!',
        cancelButtonText:   'Batal',
        reverseButtons: true,
    }).then(result => {
        if (result.isConfirmed) {
            document.getElementById('form-hapus-show').submit();
        }
    });
});
</script>
@endpush