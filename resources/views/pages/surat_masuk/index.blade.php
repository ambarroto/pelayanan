@extends('components.layout')

@section('page_header')
@include('components.header', [
    'link' => route('tambah_surat_masuk'),
    'text_link' => 'Tambah Surat Masuk'
])
@endsection

@section('styles')
@include('styles.datatable')
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
@endsection

@section('page_content')
<div class="row">
    <div class="col">
        <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="mb-0">Daftar Surat Masuk</h3>
                <button class="btn btn-primary btn-sm" id="export_pdf">Export (PDF)</button>
                <form method="POST" id="form_export" action="{{ route('export_pdf_surat_masuk') }}">
                    @csrf
                    <input type="hidden" name="id">
                </form>
            </div>
            
            <div class="table-responsive py-4">
                <table class="table table-flush" id="tables">
                    <thead class="thead-light">
                        <tr>
                            <th>
                                <input type="checkbox" class="select_all_id">
                            </th>
                            <th></th>
                            <th>Nomor</th>
                            <th>Tanggal Terima</th>
                            <th>Alamat Surat</th>
                            <th>Tanggal Surat</th>
                            <th>Nomor Surat</th>
                            <th>Perihal</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Nomor</th>
                            <th>Tanggal Terima</th>
                            <th>Alamat Surat</th>
                            <th>Tanggal Surat</th>
                            <th>Nomor Surat</th>
                            <th>Perihal</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($surat_masuk as $item)
                        <tr>
                            <td class="data_id" data-id="{{ $item->id }}">
                                <input type="hidden" value="{{$item->id}}" >
                            </td>
                            <td>
                                <a href="{{ route('edit_surat_masuk', ['id' => $item->id]) }}" type="button" class="btn btn-sm btn-primary">Ubah</a>
                            </td>
                            <td><a href="{{ route('detail_surat_masuk', ['id' => $item->id])}}">{{ $item->nomor }}</a></td>
                            <td>{{ tanggal($item->tanggal_terima) }}</td>
                            <td>{{ $item->alamat_surat }}</td>
                            <td>{{ tanggal($item->tanggal_surat) }}</td>
                            <td>{{ $item->nomor_surat}}</td>
                            <td>{{ $item->perihal_surat }}</td>
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
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
<script>
    var dt = $('#tables').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'pdf'],
        ordering: false,
        pagingType: 'simple_numbers',
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets: 0
        } ],
        select: {
            style: 'multi',
            selector: 'td:first-child'
        },
        order: [[ 1, 'asc' ]]
    })
    $('input.select_all_id').change(function () {
        if (this.checked) {
            dt.rows().select();
        } else {
            dt.rows().deselect();
        }
    })
    $('#export_pdf').on('click', function () {
        var data = []
        var dtRows = dt.rows({selected: true});
        if (dtRows[0].length > 0) {
            dtRows[0].forEach(function(value, index) {
                data.push($(dt.row(value).data()[0]).val())
            })
        }
        $('input[name="id"').val(data)
        $('form#form_export').attr('action', $(this).attr('data-href')).submit()
    })
</script>
@endsection