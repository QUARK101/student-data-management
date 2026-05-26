@extends('layouts.app')

@section('title', 'Edit Program Studi')
@section('page-title', 'Edit Program Studi')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span>
                    <i class="fas fa-edit me-2 text-warning"></i>
                    Edit: <strong>{{ $programStudi->nama }}</strong>
                </span>
                <a href="{{ route('program-studi.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('program-studi.update', $programStudi) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Nama Program Studi <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="nama"
                               class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama', $programStudi->nama) }}">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jenjang <span class="text-danger">*</span></label>
                        <select name="jenjang" class="form-select @error('jenjang') is-invalid @enderror">
                            @foreach(['S1', 'D3', 'D4'] as $j)
                                <option value="{{ $j }}"
                                    {{ old('jenjang', $programStudi->jenjang) === $j ? 'selected' : '' }}>
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
                               value="{{ old('fakultas', $programStudi->fakultas) }}">
                        @error('fakultas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save me-1"></i>Perbarui
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