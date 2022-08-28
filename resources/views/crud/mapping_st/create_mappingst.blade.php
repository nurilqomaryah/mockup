@extends('layouts.crud')

@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Mapping Surat Tugas') }}</div>
                    <div class="card-body">
                        <form method="POST" action="#">
                            @csrf
                            <div class="form-group row">
                                <label for="id_st" class="col-md-4 col-form-label text-md-right">{{ __('Nomor dan Nama ST') }}</label>
                                <div class="col-md-6">
                                    <select name="id-st" class="form-control" id="id_st" autofocus>
                                        <option value="">--- Pilih Nomor dan Nama ST ---</option>
                                        @foreach($listPenugasan as $listST)
                                            <option value="{{$listST->id_st}}">{{$listST->no_surat_tugas}} - {{$listST->nama_penugasan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('Nama PKAU dan Anggaran') }}</label>
                                <div class="col-md-6">
                                    <select name="id-anggaran" class="form-control" id="id" autofocus>
                                        <option value="">--- Pilih Nama PKAU dan Anngaran ---</option>
                                        @foreach($listAnggaran as $anggaranPKAU)
                                            <option value="{{$anggaranPKAU->id}}">{{$anggaranPKAU->nama_pkau}} - {{$anggaranPKAU->uraian}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-4">
                                    <button type="submit" class="btn button-blue">
                                        <i class="fa fa-save"></i> {{ __('Simpan') }}
                                    </button>
                                    <button type="reset" class="btn button-orange">
                                        <i class="fa fa-backward"></i> {{ __('Batal') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
