@extends('layouts.crud')

@section('main')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center font-weight-bold">{{ __('Mapping PBJ') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('mapping_pbj.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="id-pbj" class="col-md-3 col-form-label text-md-right">{{ __('Nomor dan Nama PBJ') }}</label>
                                <div class="col-md-8">
                                    <select name="id-pbj" class="form-control" id="id-pbj" autofocus>
                                        <option value="">--- Pilih Nomor dan Nama PBJ ---</option>
                                        @foreach($listPBJ as $pbj)
                                            <option value="{{$pbj->id}}">{{$pbj->nomor_ppbj}} - {{$pbj->nama_pbj}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id" class="col-md-3 col-form-label text-md-right">{{ __('Nama PKAU dan Anggaran') }}</label>
                                <div class="col-md-8">
                                    <select name="id-anggaran" class="form-control" id="id" autofocus>
                                        <option value="">--- Pilih Nama PKAU dan Anggaran ---</option>
                                        @foreach($listAnggaran as $anggaranPKAU)
                                            <option value="{{$anggaranPKAU->id}}">{{$anggaranPKAU->nama_pkau}} - {{$anggaranPKAU->uraian}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row pt-3">
                                <div class="col-md-6 offset-4">
                                    <a href="{{ route('mapping_pbj.index')}}" class="btn button-orange"><i class="fa fa-backward"></i>  Kembali</a>
                                    &nbsp; &nbsp;
                                    <button type="submit" class="btn button-blue">
                                        <i class="fa fa-save"></i> {{ __('Simpan') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#id-pbj').select2({
                theme: 'bootstrap4'
            })
            $('#id').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
@endsection
