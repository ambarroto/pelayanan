@extends('components.layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/jquery.datetimepicker.min.css') }}">
@endsection

@section('page_header')
@include('components.header', [
    'link' => route('surat_masuk'),
    'text_link' => 'Daftar Surat Masuk'
])
@endsection

@section('page_content')
<div class="row">
    <div class="col">
        <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="mb-0">Tambah Pengantar SKCK</h3>
            </div>
            <div class="card-body">
                @if(session('error'))
                <div class="alert alert-warning" role="alert">
                    {{ session('error') }}
                </div>
                @endif

                <form class="needs-validation" novalidate action="{{ route('input_skck') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="nama">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama" value="{{ old("nama") }}">
                            @error('nama')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" value="{{ old("tempat_lahir") }}">
                            @error('tempat_lahir')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="text" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" value="{{ old("tanggal_lahir") }}">
                            @error('tanggal_lahir')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="alamat">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Alamat" value="{{ old("alamat") }}">
                            @error('alamat')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="agama">Agama</label>
                            <input type="text" class="form-control @error('agama') is-invalid @enderror" id="agama" name="agama" placeholder="Agama" value="{{ old("agama") }}">
                            @error('agama')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="pendidikan">Pendidikan</label>
                            <input type="text" class="form-control @error('pendidikan') is-invalid @enderror" id="pendidikan" name="pendidikan" placeholder="Pendidikan" value="{{ old("pendidikan") }}">
                            @error('pendidikan')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="pekerjaan">Pekerjaan</label>
                            <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan" value="{{ old("pekerjaan") }}">
                            @error('pekerjaan')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="nomor_surat_dari_desa">Nomor Surat Dari Desa</label>
                            <input type="text" class="form-control @error('nomor_surat_dari_desa') is-invalid @enderror" id="nomor_surat_dari_desa" name="nomor_surat_dari_desa" placeholder="Nomor Surat Dari Desa" value="{{ old("nomor_surat_dari_desa") }}">
                            @error('nomor_surat_dari_desa')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="status">Status Perkawinan</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="k">Kawin</option>
                                <option value="bk">Belum Kawin</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="nik">NIK</label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" placeholder="NIK" value="{{ old("nik") }}">
                            @error('nik')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-8 mb-3">
                            <label class="form-control-label" for="keperluan">Keperluan</label>
                            <input type="text" class="form-control @error('keperluan') is-invalid @enderror" id="keperluan" name="keperluan" placeholder="Keperluan" value="{{ old('keperluan') }}">
                            @error('keperluan')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="foto">Foto</label>
                            <input type="file" @error('foto') is-invalid @enderror" id="foto" name="foto" multiple placeholder="foto" value="{{ old("foto") }}">
                            @error('foto')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Tambah Pengantar SKCK</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('optional_scripts')
<script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.datetimepicker.full.min.js') }}"></script>
<script src="{{ asset('assets/vendor/moment/min/moment.min.js') }}"></script>
@endsection

@section('custom_script')
<script>
    $('#status').select2({
        placeholder: 'Status Perkawinan',
        allowClear: true
    })
    $('#tanggal_lahir').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
        value: moment().format('Y-MM-DD')
    });
</script>
@endsection