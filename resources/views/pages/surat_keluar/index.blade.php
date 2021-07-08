@extends('components.layout')

@section('page_header')
@include('components.header', [
    'link' => route('tambah_surat_keluar'),
    'text_link' => 'Tambah Surat Keluar'
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
                <h3 class="mb-0">Daftar Surat Keluar</h3>
            </div>
            <div class="table-responsive py-4">
                <table class="table table-flush" id="tables">
                    <thead class="thead-light">
                        <tr>
                            <th>Nomor</th>
                            <th>Nomor Surat</th>
                            <th>Alamat Tujuan</th>
                            <th>Tanggal</th>
                            <th>Uraian</th>
                            <th>Penunjuk</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nomor</th>
                            <th>Nomor Surat</th>
                            <th>Alamat Tujuan</th>
                            <th>Tanggal</th>
                            <th>Uraian</th>
                            <th>Penunjuk</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($surat_keluar as $item)
                        <tr>
                            <td>{{ $item->nomor }}</td>
                            <td>{{ $item->nomor_surat }}</td>
                            <td>{{ $item->alamat_tujuan }}</td>
                            <td>{{ tanggal($item->tanggal) }}</td>
                            <td>{{ $item->uraian }}</td>
                            <td>{{ $item->penunjuk }}</td>
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