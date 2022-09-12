@extends('layouts.crud')

@section('main')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center font-weight-bold">{{ __('Edit User') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.update') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $edit_user->id }}"/>
                            <div class="form-group row">
                                <label for="username" class="col-md-3 col-form-label text-md-right">{{ __('Username*') }}</label>
                                <div class="col-md-8">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $edit_user->username }} " autocomplete="username">
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Password*') }}</label>
                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_role" class="col-md-3 col-form-label text-md-right">{{ __('Role') }}</label>
                                <div class="col-md-8">
                                    <select name="id_role" class="form-control" id="id_role" autofocus>
                                        @foreach($role as $key)
                                            <option value="{{$key->id}}" {{$edit_user->role_id == $key->id ? 'selected' : ''}}>{{$key->nama_role}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kd_satker" class="col-md-3 col-form-label text-md-right">{{ __('Kode Satker') }}</label>
                                <div class="col-md-8">
                                    <input id=kd_satker" type="text" class="form-control @error('kd_satker') is-invalid @enderror" name="kd_satker" value="{{ $edit_user->kd_satker }} " readonly>
                                </div>
                            </div>
                            <div class="form-group row pt-3">
                                <div class="col-md-6 offset-md-4">
                                    <a href="{{ route('users.index')}}" class="btn button-orange"><i class="fa fa-backward"></i>  Kembali</a>
                                    &nbsp; &nbsp;
                                    <button type="submit" class="btn button-blue">
                                        <i class="fa fa-save"></i> {{ __('Update User') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
