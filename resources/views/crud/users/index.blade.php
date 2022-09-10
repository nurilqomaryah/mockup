@extends('layouts.crud')

@section('main')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header align-items-center justify-content-between">
                    <center><h5 class="m-0 font-weight-bold text-primary">User Management</h5></center>
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
                        <a style="margin-bottom: 1em;" href="{{ route('users.create') }}" class="btn button-orange btn-sm pull-right">Tambah Data</a>
                    </div>
                        <table id="datauser" class="table table-striped table-bordered" style="width: 100%">
                            <thead>
                            <tr style="text-align: center">
                                <th>No</th>
                                <th>Username</th>
                                <th>Kode Satker</th>
                                <th>Role</th>
                                <th>Ubah</th>
                                <th>Hapus</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr style="text-align: center">
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->kd_satker}}</td>
                                    <td>{{$user->nama_role}}</td>
                                    <td>
                                        <a href="{{ route('users.edit',$user->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('users.destroy', ['id'=>$user->id])}}" method="post">
                                            @csrf
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
            $('#datauser').DataTable();
        } );
    </script>
@endsection

