@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')
@section('page-title', 'Tambah Mahasiswa')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="fas fa-user-plus me-2 text-primary"></i>Form Tambah Mahasiswa</span>
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
            </div>
            <div class="card-body">

                <form action="{{ route('mahasiswa.store') }}" method="POST">
                    @csrf

                    <div class="row g-3">

                        {{-- Program Studi --}}
                        <div class="col-12">
                            <label class="form-label fw-semibold">
                                Program Studi <span class="text-danger">*</span>
                            </label>
                            <select name="program_studi_id"
                                    class="form-select @error('program_studi_id') is-invalid @enderror">
                                <option value="">— Pilih Program Studi —</option>
                                @foreach($programStudi as $prodi)
                                    <option value="{{ $prodi->id }}"
                                        {{ old('program_studi_id') == $prodi->id ? 'selected' : '' }}>
                                        {{ $prodi->nama }} ({{ $prodi->jenjang }})
                                    </option>
                                @endforeach
                            </select>
                            @error('program_studi_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- NIM --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                NIM <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nim"
                                   class="form-control font-monospace @error('nim') is-invalid @enderror"
                                   value="{{ old('nim') }}"
                                   placeholder="Contoh: 2305101077">
                            @error('nim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Angkatan --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Angkatan <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="angkatan"
                                   class="form-control @error('angkatan') is-invalid @enderror"
                                   value="{{ old('angkatan', date('Y')) }}"
                                   min="2000" max="{{ date('Y') }}">
                            @error('angkatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Nama --}}
                        <div class="col-12">
                            <label class="form-label fw-semibold">
                                Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nama"
                                   class="form-control @error('nama') is-invalid @enderror"
                                   value="{{ old('nama') }}"
                                   placeholder="Masukkan nama lengkap">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}"
                                   placeholder="email@student.ac.id">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- No HP --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. HP</label>
                            <input type="text" name="no_hp"
                                   class="form-control @error('no_hp') is-invalid @enderror"
                                   value="{{ old('no_hp') }}"
                                   placeholder="08xxxxxxxxxxxx">
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="col-12">
                            <label class="form-label fw-semibold">
                                Status <span class="text-danger">*</span>
                            </label>
                            <div class="d-flex gap-3 flex-wrap">
                                @foreach(['Aktif' => 'success', 'Cuti' => 'warning', 'Lulus' => 'primary', 'Keluar' => 'danger'] as $st => $color)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"
                                           name="status" id="status_{{ $st }}" value="{{ $st }}"
                                           {{ old('status', 'Aktif') === $st ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_{{ $st }}">
                                        <span class="badge bg-{{ $color }}">{{ $st }}</span>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            @error('status')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Alamat --}}
                        <div class="col-12">
                            <label class="form-label fw-semibold">Alamat</label>
                            <textarea name="alamat" rows="3"
                                      class="form-control @error('alamat') is-invalid @enderror"
                                      placeholder="Masukkan alamat lengkap (opsional)">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Simpan Data
                        </button>
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i>Batal
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection