@extends('components.layout')

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
            <div class="table-responsive py-4">
                <table class="table table-flush">
                    <tbody>
                        <tr>
                            <td>Surat Dari</td>
                            <td>{{ $surat_masuk->alamat_surat }}</td>
                            <td>Tanggal Terima</td>
                            <td>{{ tanggal_indonesia($surat_masuk->tanggal_surat) }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Surat</td>
                            <td>{{ tanggal_indonesia($surat_masuk->tanggal_surat) }}</td>
                            <td>Nomor Agenda</td>
                            <td>{{ $surat_masuk->nomor_agenda }}</td>
                        </tr>
                        <tr>
                            <td>Nomor Surat</td>
                            <td>{{ $surat_masuk->nomor_surat }}</td>
                            <td>Diteruskan Kepada</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td>{{ $surat_masuk->perihal_surat }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <label class="form-control-label" for="lampiran">Isi Disposisi</label>
                                <form class="needs-validation" novalidate method="POST" action="{{ route('update_surat_masuk', ['id' => $surat_masuk->id]) }}">
                                @method('PUT')
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <textarea style="white-space: pre-wrap" class="form-control @error('isi_disposisi') is-invalid @enderror" name="isi_disposisi" id="isi_disposisi" cols="30" rows="10">{{ trim($surat_masuk->catatan) }}</textarea>
                                        @error('isi_disposisi')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-primary" type="submit">Ubah Surat Masuk</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="mb-0">Lampiran</h3>
            </div>
            <div class="card-body">
                @foreach ($surat_masuk->fileSuratMasuk as $file)
                @if ($file->fileLocation)
                @endif
                <iframe src="{{ $file->fileLocation }}" style="width: 100%;min-height: 100vh;border: none;"></iframe>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection