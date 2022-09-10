@extends('layouts.crud')
@section('main')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center font-weight-bold">{{ __('Realisasi Indikator Kinerja Kegiatan') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('realikk.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="id_ikk" class="col-md-3 col-form-label text-md-right">{{ __('Nama IKK*') }}</label>
                                <div class="col-md-8">
                                    <select name="id-ikk" class="form-control" id="id_ikk" autofocus>
                                        <option value="">--- Pilih IKK ---</option>
                                        @foreach($listReferensiIKK as $referensiIKK)
                                            <option value="{{$referensiIKK->id_ikk}}">{{$referensiIKK->kd_ikk}} - {{$referensiIKK->nama_ikk}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tahun" class="col-md-3 col-form-label text-md-right">{{ __('Tahun') }}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y') }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bulan" class="col-md-3 col-form-label text-md-right">{{ __('Bulan*') }}</label>
                                <div class="col-md-8">
                                    <select name="bulan" class="form-control">
                                        <option value="">--- Pilih Bulan ---</option>
                                        @foreach($listBulan as $bulan)
                                            <option value="{{ $loop->iteration }}">{{ $bulan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="target" class="col-md-3 col-form-label text-md-right">{{ __('Target') }}</label>
                                <div class="col-md-8">
                                    <input id="target" type="text" class="form-control @error('target') is-invalid @enderror" name="target" value="{{ old('target') }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="realisasi" class="col-md-3 col-form-label text-md-right">{{ __('Realisasi*') }}</label>
                                <div class="col-md-8">
                                    <input id="realisasi" type="text" class="form-control @error('realisasi') is-invalid @enderror" name="realisasi" value="{{ old('realisasi') }}" autocomplete="realisasi">
                                    @error('realisasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row pt-3">
                                <div class="col-md-6 offset-4">
                                    <a href="{{ route('realikk.index')}}" class="btn button-orange"><i class="fa fa-backward"></i>  Kembali</a>
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
@endsection
