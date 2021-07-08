@extends('components.layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/jquery.datetimepicker.min.css') }}">
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

                <form class="needs-validation" novalidate action="{{ route('input_ijin_keramaian') }}" method="POST" enctype="multipart/form-data">
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
                            <label class="form-control-label" for="umur">Umur (Tahun)</label>
                            <input type="number" class="form-control @error('umur') is-invalid @enderror" id="umur" name="umur" placeholder="Umur" value="{{ old("umur") }}">
                            @error('umur')
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
                            <label class="form-control-label" for="pekerjaan">Pekerjaan</label>
                            <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan" value="{{ old("pekerjaan") }}">
                            @error('pekerjaan')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="hajat">Hajat</label>
                            <input type="text" class="form-control @error('hajat') is-invalid @enderror" data-tanggal="{{ date('Y-m-d') }}" id="hajat" name="hajat" placeholder="Hajat" value="{{ old("hajat") }}">
                            @error('hajat')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="jumlah_undangan">Jumlah Undangan</label>
                            <input type="number" class="form-control @error('jumlah_undangan') is-invalid @enderror" id="jumlah_undangan" name="jumlah_undangan" placeholder="Jumlah Undangan" value="{{ old("jumlah_undangan") }}">
                            @error('jumlah_undangan')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="macam_hiburan">Macam Hiburan</label>
                            <input type="text" class="form-control @error('macam_hiburan') is-invalid @enderror" id="macam_hiburan" name="macam_hiburan" placeholder="Macam Hiburan" value="{{ old("macam_hiburan") }}">
                            @error('macam_hiburan')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label" for="tanggal_keramaian">Tanggal Keramaian</label>
                            <input type="text" class="form-control @error('tanggal_keramaian') is-invalid @enderror" id="tanggal_keramaian" name="tanggal_keramaian" placeholder="Tanggal Keramaian" value="{{ old("tanggal_keramaian") }}">
                            @error('tanggal_keramaian')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Tambah Ijin Keramaian</button>
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
    $('#tanggal_keramaian').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
        value: moment().format('Y-MM-DD')
    });
</script>
@endsection