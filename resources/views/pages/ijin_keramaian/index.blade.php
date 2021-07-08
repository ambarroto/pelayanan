@extends('components.layout')

@section('page_header')
@include('components.header', [
    'link' => route('tambah_ijin_keramaian'),
    'text_link' => 'Tambah Ijin Keramaian'
])
@endsection

@section('styles')
@include('styles.datatable')
@endsection

@section('page_content')
<div class="row">
    <div class="col">
        <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="mb-0">Daftar Ijin Keramaian</h3>
            </div>
            <div class="table-responsive py-4">
                <table class="table table-flush" id="tables">
                    <thead class="thead-light">
                        <tr>
                            <th>Nomor</th>
                            <th>Tanggal</th>
                            <th>Nama/Umur</th>
                            <th>Agama</th>
                            <th>Alamat</th>
                            <th>Pekerjaan</th>
                            <th>Hajat</th>
                            <th>Macam Hiburan</th>
                            <th>Tgl Keramaian</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nomor</th>
                            <th>Tanggal</th>
                            <th>Nama/Umur</th>
                            <th>Agama</th>
                            <th>Alamat</th>
                            <th>Pekerjaan</th>
                            <th>Hajat</th>
                            <th>Macam Hiburan</th>
                            <th>Tgl Keramaian</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->nomor }}</td>
                            <td>{{ tanggal($item->tanggal) }}</td>
                            <td>{{ "$item->nama/$item->umur" }}</td>
                            <td>{{ $item->agama }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->pekerjaan }}</td>
                            <td>{{ $item->hajat }}</td>
                            <td>{{ $item->macam_hiburan }}</td>
                            <td>{{ tanggal($item->tanggal_keramaian) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('optional_scripts')
@include('scripts.datatable')
<script>
    $('#tables').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'pdf'],
        ordering: false
    });
</script>
@endsection