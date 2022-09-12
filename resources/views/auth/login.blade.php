@extends('layouts.log-in')

@section('content')
    <div class="container" style="background-image: {{url('images/PC.jpg')}} !important;">
{{--        <div class="row justify-content-end" style="margin-top: 3em;">--}}
{{--                <img class="img-responsive" src="{{url('/images/BPKP_Logo.png')}}" width="15%">--}}
{{--        </div>--}}
    <div class="row">
        <div class="col-md-8 offset-4" style="margin-top: 12em; margin-right: 7em;">
            <h2 style="text-align: center;">APLIKASI MONITORING CAPAIAN </h2>
            <h2 style="text-align: center;">KINERJA DAN KEUANGAN PUSLITBANGWAS </h2>
            <h2 style="text-align: center;">(MOCKUP) </h2>
            <div class="card" style="margin-top: 3em;">
                <div class="card-header text-center">{{ __('Silakan melakukan Login terlebih dahulu') }}</div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-primary">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('login.submit')}}">
                        @csrf
                        <div class="form-group row">
                            <label for="username" class="col-md-3 col-form-label text-md-right fas fa-fw fa-tachometer-alt"></label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i> </span>
                                    </div>
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Username" autofocus>
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('') }}</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i> </span>
                                    </div>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-center">
                                &nbsp; &nbsp;
                                <button type="submit" class="btn button-blue col-md-3"><i class="fa fa-lock"></i>
                                    {{ __('Login') }}
                                </button> &nbsp; &nbsp;
{{--                                <a href="{{ route('register') }}">--}}
{{--                                    <button type="button" class="btn button-orange col-md-4"><i class="fa fa-user"></i>--}}
{{--                                        {{ __('Register') }}--}}
{{--                                    </button>--}}
{{--                                </a>--}}
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
