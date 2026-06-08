@extends('layouts.app')

@section('title', 'Tambah Program Studi')
@section('page-title', 'Tambah Program Studi')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="fas fa-plus-circle me-2 text-success"></i>Form Tambah Program Studi</span>
                <a href="{{ route('program-studi.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('program-studi.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Nama Program Studi <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="nama"
                               class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama') }}"
                               placeholder="Contoh: Teknik Informatika">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Jenjang <span class="text-danger">*</span>
                        </label>
                        <select name="jenjang" class="form-select @error('jenjang') is-invalid @enderror">
                            <option value="">— Pilih Jenjang —</option>
                            @foreach(['S1', 'D3', 'D4'] as $j)
                                <option value="{{ $j }}" {{ old('jenjang') === $j ? 'selected' : '' }}>
                                    {{ $j }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenjang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Fakultas</label>
                        <input type="text" name="fakultas"
                               class="form-control @error('fakultas') is-invalid @enderror"
                               value="{{ old('fakultas') }}"
                               placeholder="Contoh: Fakultas Teknik (opsional)">
                        @error('fakultas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i>Simpan
                        </button>
                        <a href="{{ route('program-studi.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i>Batal
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection