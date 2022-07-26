@extends('layouts.crud')

@section('main')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center font-weight-bold">{{ __('Edit Real IKK') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('realikk.update') }}">
                            @csrf
                            <input type="hidden" name="id-realisasi-ikk" value="{{ $dataRealisasiIKK->id_real_ikk }}"/>
                            <div class="form-group row">
                                <label for="id_ikk" class="col-md-3 col-form-label text-md-right">{{ __('Nama IKK*') }}</label>
                                <div class="col-md-8">
                                    <select name="id-ikk" class="form-control" id="id_ikk" autofocus>
                                        @foreach($listReferensiIKK as $referensiIKK)
                                            <option value="{{$referensiIKK->id_ikk}}" {{$dataRealisasiIKK->id_ikk == $referensiIKK->id_ikk ? 'selected' : ''}}>
                                                {{$referensiIKK->id_ikk}} - {{$referensiIKK->nama_ikk}}
                                            </option>
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
                                <label for="bulan" class="col-md-3 col-form-label text-md-right">{{ __('Bulan') }}</label>
                                <div class="col-md-8">
                                    <select name="bulan" class="form-control">
                                        <option value="">--- Pilih Bulan ---</option>
                                        @foreach($listBulan as $bulan)
                                            <option value="{{ $loop->iteration }}" @if($dataRealisasiIKK->bulan == $loop->iteration) selected @endif>
                                                {{ $bulan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="target" class="col-md-3 col-form-label text-md-right">{{ __('Target') }}</label>
                                <div class="col-md-8">
                                    <input id="target" type="text" class="form-control @error('target') is-invalid @enderror" name="target" value="{{ $dataReferensiIKK->target }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="realisasi" class="col-md-3 col-form-label text-md-right">{{ __('Realisasi*') }}</label>
                                <div class="col-md-8">
                                    <input id="realisasi" type="text" class="form-control @error('realisasi') is-invalid @enderror" name="realisasi" value="{{ $dataRealisasiIKK->realisasi }} " autocomplete="realisasi">
                                    @error('realisasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row pt-3">
                                <div class="col-md-6 offset-md-4">
                                    <a href="{{ route('realikk.index')}}" class="btn button-orange"><i class="fa fa-backward"></i>  Kembali</a>
                                    &nbsp; &nbsp;
                                    <button type="submit" class="btn button-blue">
                                        <i class="fa fa-save"></i> {{ __('Update Realisasi IKK') }}
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
