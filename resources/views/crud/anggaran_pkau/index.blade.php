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
                        <tr style="text-align: center">
                            <th>No</th>
                            <th>Uraian Anggaran</th>
                            <th>Nilai Anggaran</th>
                            <th>Total Mapping</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listIndex as $index)
                            <tr>
                                <td style="text-align: center">{{ $loop->iteration }}</td>
                                <td>{!! $index->uraian !!}</td>
                                <td class="text-right">Rp{{ number_format($index->rupiah,2,',','.') }}</td>
                                <td class="text-right">Rp{{ number_format($index->total_mapping,2,',','.') }}</td>
                                <td style="text-align: center">
                                    <a href="{{ route('mapping_anggaran.mapping',['idReferensiIndex' => $index->kdindex]) }}" class="btn button-orange btn-sm">Mapping</a>
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

