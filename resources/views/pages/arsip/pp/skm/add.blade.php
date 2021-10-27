@extends('components.layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/jquery.datetimepicker.min.css') }}">
@endsection

@section('page_header')
@include('components.header', [
    'link' => route('arsip_skm'),
    'text_link' => "Daftar $title"
])
@endsection

@section('page_content')
<div class="row">
    <div class="col">
        <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="mb-0">Tambah Data {{ $title }}</h3>
            </div>
            <div class="card-body">
                @if(session('error'))
                <div class="alert alert-warning" role="alert">
                    {{ session('error') }}
                </div>
                @endif

                <form class="needs-validation" novalidate action="{{ route('simpan_arsip_skm') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="layanan">Jenis Layanan</label>
                            <input type="text" class="form-control @error('layanan') is-invalid @enderror" id="layanan" name="layanan" placeholder="Jenis Layanan" value="{{ old("layanan") }}">
                            @error('layanan')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="tahun">Tahun</label>
                            <input type="text" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" placeholder="Tahun" value="{{ old("tahun") }}">
                            @error('tahun')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="bulan">Bulan</label>
                            <select name="bulan" id="bulan" class="form-control @error('bulan') is-invalid @enderror">
                                <option></option>
                                @foreach($bulan as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            @error('bulan')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="jumlah_koresponden">Jumlah Koresponden</label>
                            <input type="text" class="form-control @error('jumlah_koresponden') is-invalid @enderror" id="jumlah_koresponden" name="jumlah_koresponden" placeholder="Jumlah Koresponden" value="{{ old("jumlah_koresponden") }}">
                            @error('jumlah_koresponden')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="hasil">Hasil</label>
                            <input type="text" class="form-control @error('hasil') is-invalid @enderror" id="hasil" name="hasil" placeholder="Hasil" value="{{ old("hasil") }}">
                            @error('hasil')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="file">File</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" value="{{ old("file") }}">
                            @error('file')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Tambah {{ $title }}</button>
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
    $('#bulan').select2({
        placeholder: 'Bulan',
        allowClear: true
    })
    $('#tanggal_sk').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
        value: moment().format('YYYY-MM-DD')
    });
</script>
@endsection