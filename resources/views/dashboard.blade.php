@extends('layouts.crud')

@section('main')
<div class="row">
    <div class="col-md-12">
        <h2 class="page-header">
            Dashboard
        </h2>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
{{--        <div class="alert alert-success">--}}
{{--            Selamat datang <u>{{ \Illuminate\Support\Facades\Session::get('nama') }}</u>--}}
{{--        </div>--}}
    </div>
</div>

<div class="row">
    <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="panel panel-primary text-center no-boder bg-color-green">
            <div class="panel-body">
                <i class="far fa-newspaper fa-5x"></i>
{{--                <h3>--}}
{{--                        {{$jumlahberita}}--}}
{{--                    </h3>--}}
            </div>
            <div class="panel-footer back-footer-green">Total Berita/Kegiatan</div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="panel panel-primary text-center no-boder bg-color-brown">
            <div class="panel-body">
                <i class="fas fa-journal-whills fa-5x"></i>
{{--                <h3>--}}
{{--                    {{$jumlahjurnal}}--}}
{{--                </h3>--}}
            </div>
            <div class="panel-footer back-footer-brown">Total Jurnal Pengawasan</div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="panel panel-primary text-center no-boder bg-color-red">
            <div class="panel-body">
                <i class="fas fa-book-open fa-5x"></i>
{{--                <h3>--}}
{{--                    {{$jumlahmajalah}}--}}
{{--                </h3>--}}
            </div>
            <div class="panel-footer back-footer-red">Total Majalah Litbang</div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="panel panel-primary text-center no-boder bg-color-blue">
            <div class="panel-body">
                <i class="fa fa-book fa-5x"></i>
{{--                <h3>--}}
{{--                    {{$jumlahartikel}}--}}
{{--                </h3>--}}
            </div>
            <div class="panel-footer back-footer-blue">Total Artikel Pengawasan</div>
        </div>
    </div>
</div>
@endsection



