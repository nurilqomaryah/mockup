@extends('layouts.crud')
@section('main')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header align-items-center justify-content-between">
                    <center><h5 class="m-0 font-weight-bold text-primary">Mapping PBJ</h5></center>
                </div>
                <div class="card-body" style="padding: 4rem;">
                    <div class="col-sm-12">
                        @if(session()->get('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="d-flex flex-row-reverse">
                        <a style="margin-bottom: 1em;" href="{{ route('mapping_pbj.create')}}" class="btn btn-primary btn-sm pull-right">Tambah Data</a>
                    </div>
                    <table id="data_mappingpbj" class="table table-striped table-bordered" style="width: 100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>No PBJ</th>
                            <th>Nama PBJ</th>
                            <th>Nama PKAU</th>
                            <th>Uraian Anggaran</th>
                            <th>Aksi</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listMappingPBJ as $mappingPBJ)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mappingPBJ->nomor_ppbj }}</td>
                                <td>{{ $mappingPBJ->nama_pbj }}</td>
                                <td>{{ $mappingPBJ->nama_pkau }}</td>
                                <td>{{ $mappingPBJ->uraian }}</td>
                                <td>
                                    <a href="{{ route('mapping_pbj.edit',['idMappingPBJ'=>$mappingPBJ->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('mapping_pbj.destroy', ['idMappingPBJ'=>$mappingPBJ->id] )}}" method="post">
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
    <script>
        $(document).ready(function() {
            $('#data_mappingpbj').DataTable();
        } );
    </script>
@endsection

