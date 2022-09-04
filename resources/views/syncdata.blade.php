@extends('layouts.crud')

@section('main')
<div class="row">
    <div class="col-md-12">
{{--        <div class="alert alert-success">--}}
{{--            Selamat datang <u>{{ \Illuminate\Support\Facades\Session::get('nama') }}</u>--}}
{{--        </div>--}}
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header align-items-center justify-content-between">
                <center><h5 class="m-0 font-weight-bold text-primary">Sinkronisasi Data BISMA dan MOCK-UP</h5></center>
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
                    <a style="margin-bottom: 1em;" href="{{ route('syncdata') }}" class="btn btn-primary btn-sm pull-right">Sync Data</a>
                </div>
                <table id="syncdata" class="table table-striped table-bordered" style="width: 100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Tabel</th>
                        <th>Jml Data BISMA</td>
                        <th>Jml Data MOCK-UP</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($result as $res)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $res->TABLE_NAME }}</td>
                            <td>{{ $res->DATA_BISMA }}</td>
                            <td>{{ $res->DATA_LOCAL }}</td>
                            <td>
{{--                                @if($res->DATA_BISMA == 0 && $res->DATA_LOCAL == 0)--}}
{{--                                    Data Belum Tersedia--}}
{{--                                @else--}}
                                    @if($res->DATA_BISMA == $res->DATA_LOCAL)
                                        Data Sudah Sinkron
                                    @else
                                        Data Belum Sinkron
                                    @endif
{{--                                @endif--}}

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
        $('#syncdata').DataTable();
    } );
</script>
@endsection



