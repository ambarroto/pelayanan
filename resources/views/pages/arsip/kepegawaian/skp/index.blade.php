@extends('components.layout')

@section('page_header')
@include('components.header', [
    'link' => route('tambah_arsip_skp'),
    'text_link' => "Tambah $title"
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
                <h3 class="mb-0">Data {{ $title }}</h3>
            </div>
            <div class="table-responsive py-4">
                <table class="table table-flush" id="tables">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama Pegawai</th>
                            <th>Tahun</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Pegawai</th>
                            <th>Tahun</th>
                            <th>Nilai</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($skp as $item)
                        <tr>
                            <td>{!! $item->pegawai->nama !!}</td>
                            <td>{{ $item->tahun }}</td>
                            <td>{{ $item->nilai }}</td>
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