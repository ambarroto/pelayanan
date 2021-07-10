@extends('components.layout-export-pdf')

@section('page_content')
<div class="row my-5">
    @foreach($data as $index => $surat_masuk)
    <div class="col">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td colspan="4" class="text-center heading">
                        <img height="110" src="file/lambang-tulungagung.png" alt="Logo Kabupaten Tulungagung" srcset="">
                        <h3>PEMERINTAH KABUPATEN TULUNGAGUNG</h3>
                        <h2>KECAMATAN BOYOLANGU</h2>
                        <b><p>Jln. Raya Boyolangu No. 01 Telepon (0355) 322614</p></b>
                        <b><p>BOYOLANGU Kode Pos 66271</p></b>
                    </td>
                </tr>
                <tr>
                    <td><b>Surat Dari</b></td>
                    <td>{{ $surat_masuk->alamat_surat }}</td>
                    <td><b>Tanggal Terima</b></td>
                    <td>{{ tanggal_indonesia($surat_masuk->tanggal_terima) }}</td>
                </tr>
                <tr>
                    <td><b>Tanggal Surat</b></td>
                    <td>{{ tanggal_indonesia($surat_masuk->tanggal_surat) }}</td>
                    <td><b>Nomor Agenda</b></td>
                    <td>{{ $surat_masuk->nomor_agenda }}</td>
                </tr>
                <tr>
                    <td><b>Nomor Surat</b></td>
                    <td>{{ $surat_masuk->nomor_surat }}</td>
                    <td><b>Diteruskan Kepada</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td><b>Perihal</b></td>
                    <td colspan="3">{{ $surat_masuk->perihal_surat }}</td>
                </tr>
                <tr>
                    <td><b>Isi disposisi</b></td>
                    <td colspan="3">
                        <p>{!! nl2br(e($surat_masuk->catatan)) !!}</p>
                    </td>
                </tr>
            </tbody>
        </table>
        @if (count($surat_masuk->fileSuratMasuk) > 0)
            @foreach ($surat_masuk->fileSuratMasuk as $file)

                @if ($file->fileLocation)
                <img src="{{ $file->filePath }}" width="100%" srcset="">
                @endif

            @endforeach

        @endif
    </div>
    @if($index < (count($data) - 1))
    <div class="page-break"></div>
    @endif
    @endforeach
</div>
@endsection