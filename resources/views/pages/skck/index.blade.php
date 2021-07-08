@extends('components.layout')

@section('page_header')
@include('components.header', [
    'link' => route('tambah_skck'),
    'text_link' => 'Tambah SKCK'
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
                <h3 class="mb-0">Daftar Pengantar SKCK</h3>
            </div>
            <div class="table-responsive py-4" id="tableTableId">
                <table class="table table-flush" id="tables">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama / TTL / Alamat</th>
                            <th>Agama / Pendidikan / Pekerjaan</th>
                            <th>No. Surat Dari Desa</th>
                            <th>Status</th>
                            <th>NIK</th>
                            <th>Keperluan</th>
                            <th>Foto</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama / TTL / Alamat</th>
                            <th>Agama / Pendidikan / Pekerjaan</th>
                            <th>No. Surat Dari Desa</th>
                            <th>Status</th>
                            <th>NIK</th>
                            <th>Keperluan</th>
                            <th>Foto</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($skck as $item)
                        <tr>
                            <td>{{ $item->nomor }}</td>
                            <td>{{ tanggal($item->tanggal) }}</td>
                            <td>{!! $item->namaTtlAlamat !!}</td>
                            <td>{!! $item->agamaPendidikanPekerjaan !!}</td>
                            <td>{{ $item->nomor_surat_dari_desa }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->keperluan }}</td>
                            <td>
                                @if ($item->fileSkck)
                                    <img class="img" src="{{ $item->fileSkck->file_location }}" alt="" width="100">
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
    $("[id$=exportExcel]").click(function(e) {
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent( $('div[id$=tableTableId]').html()));
        e.preventDefault();
    });
    $('#tables').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                text: 'Excel',
                customize: function (xlsx) {
                    // console.log(xlsx.xl.worksheets['sheet1.xml'])
                },
                exportOptions: {
                    stripHtml: true,
                    stripNewLines: true
                }
            },
            {
                extend: 'pdfHtml5',
                title: 'Document Title',
                customize: function ( doc ) {
                    
                },
                exportOptions: {
                    stripHtml: true,
                    columns: ':visible',
                    search: 'applied',
                    order: 'applied'
                }
            }
        ],
        ordering: false,
        pagingType: 'simple_numbers'
    })
</script>
@endsection