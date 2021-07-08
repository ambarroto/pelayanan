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
                <h3 class="mb-0">Tambah Barang Baru</h3>
            </div>
            <div class="card-body">
                @if(session('error'))
                <div class="alert alert-warning" role="alert">
                    {{ session('error') }}
                </div>
                @endif
                @if ($errors->has('lampiran.*'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->get('lampiran.*') as $error)
                            <li>{{ $error[0] }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form class="needs-validation" novalidate action="{{ route('input_surat_keluar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="nomor">Nomor Surat</label>
                            <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" id="nomor_surat" name="nomor_surat" placeholder="Nomor Surat" value="{{ old("nomor_surat") }}">
                            @error('nomor_surat')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="alamat_tujuan">Alamat Tujuan</label>
                            <input type="text" class="form-control @error('alamat_tujuan') is-invalid @enderror" id="alamat_tujuan" name="alamat_tujuan" placeholder="Alamat Tujuan" value="{{ old("alamat_tujuan") }}">
                            @error('alamat_tujuan')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="tanggal_surat">Tanggal Surat</label>
                            <input type="text" class="form-control @error('tanggal_surat') is-invalid @enderror" data-tanggal="{{ date('Y-m-d') }}" id="tanggal_surat" name="tanggal_surat" placeholder="Tanggal Surat" value="{{ old("tanggal_surat") }}">
                            @error('tanggal_surat')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label class="form-control-label" for="perihal">Perihal Surat</label>
                            <input type="text" class="form-control @error('perihal') is-invalid @enderror" id="perihal" name="perihal" placeholder="Perihal Surat" value="{{ old('perihal') }}">
                            @error('perihal')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="lampiran">Lampiran</label>
                            <input type="file" @error('lampiran') is-invalid @enderror" id="lampiran" name="lampiran[]" multiple placeholder="Lampiran" value="{{ old("lampiran") }}">
                            @error('lampiran')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="penunjuk">Penunjuk</label>
                            <input type="text" class="form-control @error('penunjuk') is-invalid @enderror" id="penunjuk" name="penunjuk" placeholder="Penunjuk" value="{{ old('penunjuk') }}">
                            @error('penunjuk')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Tambah Surat Masuk</button>
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
    $('#satuan').select2({
        placeholder: 'Pilih Satuan',
        allowClear: true
    })
    $('#status').select2({
        placeholder: 'Pilih Status',
        allowClear: true
    });
    $('#id_user').select2({
        placeholder: 'Pilih Admin',
        allowClear: true
    });
    $('#tanggal_surat').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
        value: moment().format('Y-MM-DD')
    });
</script>
@endsection