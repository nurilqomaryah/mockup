@extends('layouts.crud')

@section('main')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header align-items-center justify-content-between">
                    <center><h5 class="m-0 font-weight-bold text-primary">Realisasi Indikator Kinerja Kegiatan</h5></center>
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
                        <a style="margin-bottom: 1em;" href="{{ route('realikk.create')}}" class="btn btn-primary btn-sm pull-right">Tambah Data</a>
                    </div>
                    <table id="data_realikk" class="table table-striped table-bordered" style="width: 100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode IKK</th>
                            <th>Nama IKK</th>
                            <th>Bulan</th>
                            <th>Realisasi</th>
                            <th>Aksi</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($realikk as $real_ikk)
                            <tr>
                                <td>{{$real_ikk->id_ikk}}</td>
                                <td>{{$real_ikk->kd_ikk}}</td>
                                <td>{{$real_ikk->nama_ikk}}</td>
                                <td>{{$real_ikk->bulan}}</td>
                                <td>{{$real_ikk->realisasi}}</td>
                                <td>
                                    <a href="{{ route('realikk.edit',$real_ikk->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('$realikk.destroy', $real_ikk>id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input class="btn btn-danger btn-sm" type="submit" value="Delete"></input>
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
            $('#data_realikk').DataTable();
        } );
    </script>
@endsection

