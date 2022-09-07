@extends('layouts.crud')
@section('main')
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">A. INDIKATOR KINERJA KEGIATAN</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($listIKK as $ikk)
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-md-6">
                                                <span>{{ $ikk->kd_ikk }} {{ $ikk->nama_ikk }}</span>
                                            </div>
                                            <div class="col-md-3 text-center">
                                                <span class="text-orange">Target</span>
                                                <h5 class="text-orange" style="padding-top: 0.5em;">{{ $ikk->target }}</h5>
                                                <small class="text-orange">{{ $ikk->satuan }}</small>
                                            </div>
                                            <div class="col-md-3 text-center">
                                                <span class="text-blue">Realisasi</span><br/>
                                                <h5 class="text-blue" style="padding-top: 0.5em;">{{ ($ikk->realisasi ?? 0) }}</h5>
                                                <small class="text-blue">{{ $ikk->satuan }}</small>
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
                    <h6 class="m-0 font-weight-bold text-primary">B. PENYERAPAN ANGGARAN</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($penyerapanAnggaran as $pa)
                            <div class="col-xl-3 col-md-6 mb-4 text-center">
                                <h6>{{ $pa->nama_unit }}</h6>
                                <h1 class="text-blue" style="padding-top: 0px !important;">{{ number_format($pa->persentase,2,',','.') }} %</h1>
                                <span>{{ number_format($pa->realisasi,2,',','.') }}/{{ number_format($pa->anggaran,2,',','.') }}</span>
                            </div>
                        @endforeach
                        <div class="col-xl-3 col-md-6 mb-4 text-center">
                            <h6>Total</h6>
                            <h1 class="text-blue" style="padding-top: 0px !important;">{{ number_format(($penyerapanAnggaran->sum('realisasi')/$penyerapanAnggaran->sum('anggaran'))*100,2,',','.') }} %</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">C. PKAU</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($listPKAU as $pkau)
                            <div class="col-xl-6 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-md-12" style="margin-bottom: 1em;">
                                                <span>{{ $loop->iteration }}. {{ $pkau->nama_pkau }}</span>
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <span class="text-magenta">Jumlah ST</span>
                                                <h5 class="text-magenta">{{ $pkau->jumlah_st }}</h5>
                                            </div>
                                            <div class="col-md-5 text-center">
                                                <span class="text-orange">Anggaran</span>
                                                <h5 class="text-orange">{{ number_format($pkau->anggaran,2,',','.') }}</h5>
                                            </div>
                                            <div class="col-md-5 text-center">
                                                <span class="text-blue">Realisasi</span>
                                                <h5 class="text-blue">201.000.000</h5>
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
