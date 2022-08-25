@extends('layouts.crud')
@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Realisasi Indikator Kinerja Kegiatan') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('realikk.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="id_ikk" class="col-md-4 col-form-label text-md-right">{{ __('Nama IKK*') }}</label>
                                <div class="col-md-6">
                                    <select name="id_ikk" class="form-control" id="id_ikk" autofocus>
                                        <option value="">--- Pilih IKK ---</option>
                                        @foreach($id_ikk as $key)
                                            <option value="{{$key->id_ikk}}">{{$key->kd_ikk}} - {{$key->nama_ikk}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tahun" class="col-md-4 col-form-label text-md-right">{{ __('Tahun') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y') }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bulan" class="col-md-4 col-form-label text-md-right">{{ __('Bulan*') }}</label>
                                <div class="col-md-6">
                                    <select name="bulan" class="form-control">
                                        <option value="">--- Pilih Bulan ---</option>
                                        @foreach($listBulan as $bulan)
                                            <option value="{{ $loop->iteration }}">{{ $bulan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="target" class="col-md-4 col-form-label text-md-right">{{ __('Target') }}</label>
                                <div class="col-md-6">
                                    <input id="target" type="text" class="form-control @error('target') is-invalid @enderror" name="target" value="{{ old('target') }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="realisasi" class="col-md-4 col-form-label text-md-right">{{ __('Realisasi*') }}</label>
                                <div class="col-md-6">
                                    <input id="realisasi" type="text" class="form-control @error('realisasi') is-invalid @enderror" name="realisasi" value="{{ old('realisasi') }}" autocomplete="realisasi">
                                    @error('realisasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
