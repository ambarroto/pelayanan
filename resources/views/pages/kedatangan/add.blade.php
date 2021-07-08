@extends('components.layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/jquery.datetimepicker.min.css') }}">
@endsection

@section('page_header')
@include('components.header', [
    'link' => route('kedatangan'),
    'text_link' => 'Daftar Kedatangan Penduduk'
])
@endsection

@section('page_content')
<div class="row">
    <div class="col">
        <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="mb-0">Tambah Data Kedatangan Penduduk</h3>
            </div>
            <div class="card-body">
                @if(session('error'))
                <div class="alert alert-warning" role="alert">
                    {{ session('error') }}
                </div>
                @endif

                <form class="needs-validation" novalidate action="{{ route('input_kedatangan') }}" method="POST" enctype="multipart/form-data">
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
                            <label class="form-control-label" for="asal_desa">Asal Desa</label>
                            <input type="text" class="form-control @error('asal_desa') is-invalid @enderror" id="asal_desa" name="asal_desa" placeholder="Asal Desa" value="{{ old("asal_desa") }}">
                            @error('asal_desa')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="asal_kecamatan">Asal Kecamatan</label>
                            <input type="text" class="form-control @error('asal_kecamatan') is-invalid @enderror" id="asal_kecamatan" name="asal_kecamatan" placeholder="Asal Kecamatan" value="{{ old("asal_kecamatan") }}">
                            @error('asal_kecamatan')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="asal_kabupaten">Asal Kabupaten</label>
                            <input type="text" class="form-control @error('asal_kabupaten') is-invalid @enderror" id="asal_kabupaten" name="asal_kabupaten" placeholder="Asal Kabupaten" value="{{ old("asal_kabupaten") }}">
                            @error('asal_kabupaten')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="tujuan_desa">Tujuan Desa</label>
                            <input type="text" class="form-control @error('tujuan_desa') is-invalid @enderror" id="tujuan_desa" name="tujuan_desa" placeholder="tujuan_desa" value="{{ old("tujuan_desa") }}">
                            @error('tujuan_desa')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="jumlah_keluarga">Jumlah Keluarga</label>
                            <input type="number" class="form-control @error('jumlah_keluarga') is-invalid @enderror" id="jumlah_keluarga" name="jumlah_keluarga" placeholder="Jumlah Keluarga" value="{{ old("jumlah_keluarga") }}">
                            @error('jumlah_keluarga')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Tambah Kedatangan</button>
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