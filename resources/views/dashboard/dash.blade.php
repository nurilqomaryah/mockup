@extends('layouts.crud')
@section('main')
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">INDIKATOR KINERJA KEGIATAN</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @for($i = 0; $i <= 11; $i++)
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-md-6">
                                                <span class="text-xs">Lorem Ipsum Doloer Siamet</span>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="text-warning">Realisasi</span>
                                                <h5 class="text-warning">100%</h5>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="text-primary">Target</span>
                                                <h5 class="text-primary">100%</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">PENYERAPAN ANGGARAN</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @for($i = 0; $i <= 3; $i++)
                            <div class="col-xl-3 col-md-6 mb-4 text-center">
                                <h6>Bidang</h6>
                                <h1 class="text-primary" style="padding-top: 0px !important;">100%</h1>
                                <span>Rp1.000.000,00/Rp10.000.000,00</span>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">PENYERAPAN ANGGARAN</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @for($i = 0; $i <= 5; $i++)
                            <div class="col-xl-6 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-md-6">
                                                <span class="text-xs">Lorem Ipsum Doloer Siamet</span>
                                            </div>
                                            <div class="col-md-2">
                                                <span class="text-primary">Jumlah ST</span>
                                                <h5 class="text-primary">100%</h5>
                                            </div>
                                            <div class="col-md-2">
                                                <span class="text-magenta">Anggaran</span>
                                                <h5 class="text-magenta">100%</h5>
                                            </div>
                                            <div class="col-md-2">
                                                <span class="text-warning">Realisasi</span>
                                                <h5 class="text-warning">100%</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
