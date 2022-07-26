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
                        <a style="margin-bottom: 1em;" href="{{ route('realikk.create')}}" class="btn button-orange btn-sm pull-right">Tambah Data</a>
                    </div>
                    <table id="data_realikk" class="table table-striped table-bordered" style="width: 100%">
                        <thead>
                        <tr style="text-align: center">
                            <th>No</th>
                            <th>Kode IKK</th>
                            <th>Nama IKK</th>
                            <th>Tahun</th>
                            <th>Bulan</th>
                            <th>Realisasi</th>
                            <th>Ubah</th>
                            <th>Hapus</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listRealisasiIKK as $realisasiIKK)
                            <tr>
                                <td style="text-align: center">{{ $loop->iteration }}</td>
                                <td style="text-align: center">{{ $realisasiIKK->kd_ikk }}</td>
                                <td>{{ $realisasiIKK->nama_ikk }}</td>
                                <td style="text-align: center">{{ $realisasiIKK->tahun }}</td>
                                <td style="text-align: center">{{ bulan($realisasiIKK->bulan) }}</td>
                                <td style="text-align: center">{{ $realisasiIKK->realisasi }}</td>
                                <td style="text-align: center">
                                    <a href="{{ route('realikk.edit',['idRealisasiIKK'=>$realisasiIKK->id_real_ikk]) }}" class="btn btn-primary btn-sm">Edit</a>
                                </td>
                                <td style="text-align: center">
                                    <form action="{{ route('realikk.destroy', ['idRealisasiIKK'=>$realisasiIKK->id_real_ikk] )}}" method="post">
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
            $('#data_realikk').DataTable();
        } );
    </script>
@endsection

