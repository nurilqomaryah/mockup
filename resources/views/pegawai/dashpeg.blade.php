@extends('layouts.crud') 
@section('main')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">A. PENYERAPAN ANGGARAN</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">B. PKAU</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($listPkau as $pkau)
                            <div class="col-xl-6 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-md-9" style="margin-bottom: 1em;">
                                                <span>{{ $loop->iteration }}. {{ $pkau->uraian_pkau_pkpt }}</span>
                                            </div>
                                            <div class="col-md-3 text-center">
                                                <span class="text-magenta">Jumlah ST</span>
                                                <h5 class="text-magenta">{{ $pkau->total_st }}</h5>
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
