@extends('layouts.crud')
@section('main')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header align-items-center justify-content-between">
                    <center><h5 class="m-0 font-weight-bold text-primary">Anggaran PKAU</h5></center>
                </div>
                <div class="card-body" style="padding: 4rem;">
                    <div class="col-sm-12">
                        @if(session()->get('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                    </div>
                    <table id="data_anggaran" class="table table-striped table-bordered" style="width: 100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Uraian Anggaran</th>
                            <th>Nilai Anggaran</th>
                            <th>Total Mapping</th>
                            <th>Aksi</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listAnggaran as $anggaranPKAU)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$anggaranPKAU->uraian}}</td>
                                <td>{{$anggaranPKAU->rupiah}}</td>
                                <td>{{$anggaranPKAU->total_mapping}}</td>
                                <td>
                                    <a href="{{ route('anggaran.mapping',$anggaranPKAU->id)}}" class="btn btn-primary btn-sm">Mapping</a>
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
            $('#data_anggaran').DataTable();
        } );
    </script>
@endsection

