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
                            <td>{{ \Carbon\Carbon::parse($surat_masuk->tanggal_surat)->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Surat</td>
                            <td>{{ \Carbon\Carbon::parse($surat_masuk->tanggal_surat)->format('d F Y') }}</td>
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
                            <td>{{ $surat_masuk->perihal }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection