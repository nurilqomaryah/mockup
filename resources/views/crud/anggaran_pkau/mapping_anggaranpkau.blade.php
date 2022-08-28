@extends('layouts.crud')
@section('main')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Anggaran PKAU') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('mapping_anggaran.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="kdindex" class="col-md-4 col-form-label text-md-right">{{ __('Uraian') }}</label>
                                <div class="col-md-6">
                                    <select name="kd-index" class="form-control" id="kdindex" autofocus>
                                        @foreach($listReferensiIndex as $referensiIndex)
                                            <option value="{{$referensiIndex->id}}" {{$dataAnggaranPKAU->id == $referensiIndex->kdindex ? 'selected' : ''}}>{{$referensiIndex->uraian}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="nilai_anggaran" class="col-md-4 col-form-label text-md-right">{{ __('Nilai Anggaran') }}</label>
                                    <input id="nilai_anggaran" type="text" class="form-control @error('nilai_anggaran') is-invalid @enderror" name="nilai-anggaran" value="{{ old('nilai_anggaran') }}" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="total_mapping" class="col-md-4 col-form-label text-md-right">{{ __('Total Mapping') }}</label>
                                    <input id="total_mapping" type="text" class="form-control @error('total_mapping') is-invalid @enderror" name="total_mapping" value="{{ old('total_mapping') }}" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="sisa" class="col-md-4 col-form-label text-md-right">{{ __('Sisa') }}</label>
                                    <input id="sisa" type="text" class="form-control @error('sisa') is-invalid @enderror" name="sisa" value="{{ old('sisa') }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-7">
                                    <label for="nama_pkau" class="col-md-4 col-form-label text-md-right">{{ __('Nama PKAU*') }}</label>
                                    <input id="nama_pkau" type="text" class="form-control @error('nama_pkau') is-invalid @enderror" name="nama-pkau" value="{{ old('nama_pkau') }}" autocomplete="nama_pkau">
                                    @error('nama_pkau')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-5">
                                    <label for="nilai_pkau" class="col-md-4 col-form-label text-md-right">{{ __('Nilai Mapping*') }}</label>
                                    <input id="nilai_pkau" type="text" class="form-control @error('nilai_pkau') is-invalid @enderror" name="nilai_pkau" value="{{ old('nilai_pkau') }}" autocomplete="nilai_pkau">
                                    @error('nilai_pkau')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-4">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-save"></i> {{ __('Simpan') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-body" style="padding: 4rem;">
                            <table id="tabel_mapping" class="table table-striped table-bordered" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode PKAU</th>
                                    <th>Nama PKAU</th>
                                    <th>Nilai Mapping</th>
                                    <th>Aksi</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($listMapping as $mappingPKAU)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$mappingPKAU->id_pkau}}</td>
                                        <td>{{$mappingPKAU->nama_pkau}}</td>
                                        <td>{{$mappingPKAU->nilai_pkau}}</td>
                                        <td>
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
    </div>
    <script>
        $(document).ready(function() {
            $('#tabel_mapping').DataTable();
        } );
    </script>
@endsection
