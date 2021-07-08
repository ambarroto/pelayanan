@extends('components.layout')

@section('page_header')
@include('components.header', [
    'link' => route('tambah_kedatangan'),
    'text_link' => 'Tambah Kedatangan'
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
                <h3 class="mb-0">Data Kedatangan Penduduk</h3>
            </div>
            <div class="table-responsive py-4">
                <table class="table table-flush" id="tables">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Terima</th>
                            <th>Nama / TTL</th>
                            <th>Asal</th>
                            <th>Tujuan</th>
                            <th>Jumlah Keluarga</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Terima</th>
                            <th>Nama / TTL</th>
                            <th>Asal</th>
                            <th>Tujuan</th>
                            <th>Jumlah Keluarga</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->nomor }}</td>
                            <td>{{ tanggal($item->tanggal) }}</td>
                            <td>{!! $item->namaTtl !!}</td>
                            <td>{!! $item->asal !!}</td>
                            <td>{!! $item->tujuan !!}</td>
                            <td>{{ $item->jumlah_keluarga }}</td>
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
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Excel',
                exportOptions: {
                }
            },
            {
                extend: 'pdfHtml5',
                title: 'Document Title',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    stripHtml: false
                }
            }
        ],
        ordering: false,
        pagingType: 'simple_numbers'
    })
</script>
@endsection