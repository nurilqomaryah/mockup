@extends('layouts.crud')
@section('main')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header align-items-center justify-content-between">
                    <center><h5 class="m-0 font-weight-bold text-primary">Mapping ST</h5></center>
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
                        <a style="margin-bottom: 1em;" href="{{ route('mappingst.create')}}" class="btn button-orange btn-sm pull-right">Tambah Data</a>
                    </div>
                    <table id="data_mappingst" class="table table-striped table-bordered" style="width: 100%">
                        <thead>
                        <tr style="text-align: center">
                            <th>No</th>
                            <th>No ST</th>
                            <th>Nama ST</th>
                            <th>Nama PKAU</th>
                            <th>Uraian Anggaran</th>
                            <th>Ubah</th>
                            <th>Hapus</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listMappingST as $mappingST)
                            <tr>
                                <td style="text-align: center">{{ $loop->iteration }}</td>
                                <td>{{ $mappingST->no_surat_tugas }}</td>
                                <td>{{ $mappingST->nama_penugasan }}</td>
                                <td>{{ $mappingST->nama_pkau }}</td>
                                <td>{{ $mappingST->uraian }}</td>
                                <td style="text-align: center">
                                    <a href="{{ route('mappingst.edit',['idMappingST'=>$mappingST->id] )}}" class="btn btn-primary btn-sm">Edit</a>
                                </td>
                                <td style="text-align: center">
                                    <form action="{{ route('mappingst.destroy', ['idMappingST'=>$mappingST->id] )}}" method="post">
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
            $('#data_mappingst').DataTable();
        } );
    </script>
@endsection

