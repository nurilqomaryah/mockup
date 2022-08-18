@extends('layouts.log-in')
@section('content')
    <div class="container" style="background-image: {{url('images/PC.jpg')}} !important;">
        {{--        <div class="row justify-content-end" style="margin-top: 3em;">--}}
        {{--                <img class="img-responsive" src="{{url('/images/BPKP_Logo.png')}}" width="15%">--}}
        {{--        </div>--}}
        <div class="row justify-content-end">
            <div class="col-md-7 offset-5" style="margin-top: 12em; margin-right: 7em;">
                <h2 style="text-align: center;">APLIKASI MONITORING CAPAIAN </h2>
                <h2 style="text-align: center;">KINERJA DAN KEUANGAN PUSLITBANGWAS </h2>
                <h2 style="text-align: center;">(MOCKUP) </h2>
                <div class="card" style="margin-top: 3em;">
                    <div class="card-header text-center">{{ __('Silakan melakukan Register') }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('register.submit')}}">
                            @csrf
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Ulangi Password</label>
                                <input type="password" name="re-password" class="form-control"/>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <a href="{{ route('login') }}">
                                        <button type="button" class="btn button-blue"><i class="fa fa-backward"></i> Kembali ke Login</button>
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn button-orange"><i class="fa fa-save"></i> Daftarkan Saya</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
