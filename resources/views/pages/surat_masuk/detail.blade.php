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
                            <td>Isi disposisi</td>
                            <td colspan="3" style="white-space: pre-wrap;">
                                <p>{{ $surat_masuk->catatan }}</p>
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
                <img src="{{ $file->fileLocation }}" width="100%" alt="">
                {{-- <iframe src="{{ $file->fileLocation }}" style="width: 100%;min-height: 100vh;border: none;"></iframe> --}}
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection