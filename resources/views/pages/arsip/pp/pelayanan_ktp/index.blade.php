@extends('components.layout')

@section('page_header')
@include('components.header', [
    'link' => route('tambah_arsip_pelayanan_ktp'),
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
                            <th>Tanggal</th>
                            <th>Nomor KK</th>
                            <th>Nomor NIK KTP</th>
                            <th>Nama</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nomor KK</th>
                            <th>Nomor NIK KTP</th>
                            <th>Nama</th>
                            <th>File</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ tanggal($item->created_at) }}</td>
                            <td>{{ $item->nomor_kk }}</td>
                            <td>{{ $item->nomor_nik_ktp }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>
                                @if($item->file_location)
                                <a href="{{ $item->file_location }}" target="blank">
                                    <i class="far fa-file-pdf"></i>
                                </a>
                                @endif
                            </td>
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