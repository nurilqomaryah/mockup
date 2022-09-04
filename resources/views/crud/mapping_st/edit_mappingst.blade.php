@extends('layouts.crud')

@section('main')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Mapping ST') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('mappingst.update') }}">
                            @csrf
                            <input type="hidden" name="id-mapping-st" value="{{ $dataMappingST->id }}"/>
                            <div class="form-group row">
                                <label for="id_st" class="col-md-4 col-form-label text-md-right">{{ __('Nomor dan Nama ST') }}</label>
                                <div class="col-md-6">
                                    <select name="id-st" class="form-control" id="id_st" autofocus>
                                        @foreach($listPenugasan as $listST)
                                            <option value="{{$listST->id_st}}" {{$dataMappingST->id_st == $listST->id_st ? 'selected' : ''}}>
                                                {{$listST->no_surat_tugas}} - {{$listST->nama_penugasan}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('Nama PKAU dan Anggaran') }}</label>
                                <div class="col-md-6">
                                    <select name="id-anggaran" class="form-control" id="id" autofocus>
                                        @foreach($listAnggaran as $anggaranPKAU)
                                            <option value="{{$anggaranPKAU->id}}" {{$dataMappingST->id_anggaran_pkau == $anggaranPKAU->id ? 'selected' : ''}}>
                                                {{$anggaranPKAU->nama_pkau}} - {{$anggaranPKAU->uraian}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn button-blue">
                                        <i class="fa fa-save"></i> {{ __('Update Mapping ST') }}
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
            $('#id_st').select2({
                theme: 'bootstrap4'
            })
            $('#id').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
@endsection
