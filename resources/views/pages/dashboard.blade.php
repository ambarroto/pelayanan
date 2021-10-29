@extends('components.layout')

@section('page_header')
@include('components.header', [])
@endsection

@section('page_content')
<div class="row">
    <div class="col">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Total Surat Masuk</h5>
                        <span class="h2 font-weight-bold mb-0">{{ $jumlah_surat_masuk }}</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape text-white rounded-circle shadow">
                            <i class="ni ni-email-83 text-green"></i>
                        </div>
                    </div>
                </div>
        
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Total Surat Keluar</h5>
                        <span class="h2 font-weight-bold mb-0">{{ $jumlah_surat_keluar }}</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape text-white rounded-circle shadow">
                            <i class="ni ni-delivery-fast text-orange"></i>
                        </div>
                    </div>
                </div>
        
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Pegawai</h5>
                        <span class="h2 font-weight-bold mb-0">{{ $total_pegawai }}</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape text-green rounded-circle shadow">
                            <i class="ni ni-badge text-teal"></i>
                        </div>
                    </div>
                </div>
        
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Arsip Pelayanan Publik</h5>
                        <span class="h2 font-weight-bold mb-0">{{ $jumlah_arsip_pp }}</span>
                    </div>
                    <div class="col-auto">
                    <div class="icon icon-shape text-white rounded-circle shadow">
                        <i class="ni ni-single-02 text-orange"></i>
                    </div>
                    </div>
                </div>
        
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Arsip Pemberdayaan Masyarakat</h5>
                        <span class="h2 font-weight-bold mb-0">{{ $jumlah_arsip_pm }}</span>
                    </div>
                    <div class="col-auto">
                    <div class="icon icon-shape text-white rounded-circle shadow">
                        <i class="ni ni-spaceship text-primary"></i>
                    </div>
                    </div>
                </div>
        
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Arsip Kepegawaian</h5>
                        <span class="h2 font-weight-bold mb-0">{{ $jumlah_arsip_kepegawaian }}</span>
                    </div>
                    <div class="col-auto">
                    <div class="icon icon-shape text-white rounded-circle shadow">
                        <i class="ni ni-archive-2 text-gray"></i>
                    </div>
                    </div>
                </div>
        
            </div>
        </div>
    </div>

</div>
@endsection