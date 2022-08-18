@extends('layouts.crud')
@section('main')
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary" style="text-align: center;">INDIKATOR KINERJA KEGIATAN</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($listIKK as $ikk)
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-md-6">
                                                <span class="text-xs">{{ $ikk->kd_ikk }} {{ $ikk->nama_ikk }}</span>
                                            </div>
                                            <div class="col-md-3 text-center">
                                                <span class="text-warning">Target</span>
                                                <h5 class="text-warning" style="padding-top: 0.5em;">{{ $ikk->target }}</h5>
                                                <small class="text-warning">{{ $ikk->satuan }}</small>
                                            </div>
                                            <div class="col-md-3 text-center">
                                                <span class="text-primary">Realisasi</span><br/>
                                                <h5 class="text-primary" style="padding-top: 0.5em;">{{ ($ikk->realisasi ?? 0) }}</h5>
                                                <small class="text-primary">{{ $ikk->satuan }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
                        @foreach($penyerapanAnggaran as $pa)
                            <div class="col-xl-3 col-md-6 mb-4 text-center">
                                <h6>{{ $pa->nama_unit }}</h6>
                                <h1 class="text-primary" style="padding-top: 0px !important;">{{ number_format($pa->persentase,2,',','.') }} %</h1>
                                <span>{{ number_format($pa->realisasi,2,',','.') }}/{{ number_format($pa->anggaran,2,',','.') }}</span>
                            </div>
                        @endforeach
                        <div class="col-xl-3 col-md-6 mb-4 text-center">
                            <h6>Total</h6>
                            <h1 class="text-primary" style="padding-top: 0px !important;">{{ number_format($penyerapanAnggaran->sum('persentase'),2,',','.') }} %</h1>
                            <span>{{ number_format($penyerapanAnggaran->sum('realisasi'),2,',','.') }}/{{ number_format($penyerapanAnggaran->sum('anggaran'),2,',','.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">PKAU</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($listPKAU as $pkau)
                            <div class="col-xl-6 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-md-6">
                                                <span class="text-xs">{{ $loop->iteration }}. {{ $pkau->nama_pkau }}</span>
                                            </div>
                                            <div class="col-md-2">
                                                <span class="text-">Jumlah ST</span>
                                                <h5 class="text-magenta">100</h5>
                                            </div>
                                            <div class="col-md-2">
                                                <span class="text-warning">Anggaran</span>
                                                <h5 class="text-warning">485.980.000</h5>
                                            </div>
                                            <div class="col-md-2">
                                                <span class="text-primary">Realisasi</span>
                                                <h5 class="text-primary">201.000.000</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
