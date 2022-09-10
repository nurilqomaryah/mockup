@extends('layouts.crud')
@section('main')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center font-weight-bold">{{ __('Anggaran PKAU') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('mapping_anggaran.store') }}">
                            @csrf
                            <input type="hidden" name="kd-index" value="{{ $dataReferensiIndex->kdindex }}"/>
                            <div class="form-group row pt-3">
                                <label for="kdindex" class="col-md-2 col-form-label text-right">{{ __('Uraian') }}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control text-left" value="{{ $dataReferensiIndex->uraian }}" readonly/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nilai_anggaran" class="col-md-2 col-form-label text-right">{{ __('Nilai Anggaran') }}</label>
                                <div class="col-md-2">
                                    <input id="nilai_anggaran" type="text" class="form-control text-left" value="{{ number_format($dataPagu->rupiah,2,',','.') }}" readonly>
                                </div>
                                <label for="total_mapping" class="col-md-1 col-form-label text-right">{{ __('Total Mapping') }}</label>
                                <div class="col-md-2">
                                    <input id="total_mapping" type="text" class="form-control text-right" value="{{ number_format($nilaiPkau,2,',','.') }}" readonly>
                                </div>
                                <label for="sisa" class="col-md-1 col-form-label text-right">{{ __('Sisa') }}</label>
                                <div class="col-md-2">
                                    <input id="sisa" type="text" class="form-control text-right" value="{{ number_format($dataPagu->rupiah - $nilaiPkau,2,',','.') }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id-pkau" class="col-md-2 col-form-label text-md-right">{{ __('Nama PKAU*') }}</label>
                                <div class="col-md-4">
                                    <select name="id-pkau" id="id-pkau" class="form-control text-left">
                                        <option value="">--------------------------- Pilih PKAU ----------------------------</option>
                                        @foreach($listPkau as $pkau)
                                            <option value="{{ $pkau->id_pkau }}">{{ $pkau->nama_pkau }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="nilai_pkau" class="col-md-2 col-form-label text-md-right">{{ __('Nilai Mapping*') }}</label>
                                <div class="col-md-2">
                                    <input id="nilai_pkau" type="number" class="text-right form-control @error('nilai_pkau') is-invalid @enderror" name="nilai-pkau" value="{{ old('nilai_pkau') }}" autocomplete="nilai_pkau">
                                    @error('nilai_pkau')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row pt-3">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn button-blue">
                                        <i class="fa fa-save"></i> {{ __('Simpan') }}
                                    </button>
                                    &nbsp; &nbsp;
                                    <a href="{{ route('mapping_anggaran.index')}}" class="btn button-orange"><i class="fa fa-backward"></i>  Kembali</a>
                                </div>
                            </div>
                        </form>
                        <table id="tabel_mapping" class="table table-striped table-bordered" style="width: 100%">
                            <thead>
                            <tr style="text-align: center">
                                <th>No</th>
                                <th>Kode PKAU</th>
                                <th>Nama PKAU</th>
                                <th>Nilai Mapping</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listMapping as $mappingPKAU)
                                <tr>
                                    <td style="text-align: center">{{ $loop->iteration }}</td>
                                    <td style="text-align: center">{{$mappingPKAU->id_pkau}}</td>
                                    <td>{{$mappingPKAU->nama_pkau}}</td>
                                    <td class="text-right">{{number_format($mappingPKAU->nilai_pkau,2,',','.')}}</td>
                                    <td style="text-align: center">
                                        <form action="{{ route('mapping_anggaran.destroy', ['idAnggaranPKAU'=>$mappingPKAU->id] )}}" method="post">
                                            @csrf
                                            <input class="btn btn-danger btn-sm" type="submit" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#tabel_mapping').DataTable();
            $('#id-pkau').select2({
                theme: 'bootstrap4',
            });
        } );
    </script>

@endsection
