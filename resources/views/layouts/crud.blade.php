<html>
    <head>
        <title>MOCKUP</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/templatecrud/sb-admin-2.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/templatecrud/custom-styles.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('js/templatecrud/dataTables/dataTables.bootstrap.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('js/templatecrud/morris/morris-0.4.3.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
        <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap4.min.css"/>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
        <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
        <script src="{{ asset('js/highcharts/highcharts.js') }}"></script>

    </head>
    <body id="page-top">
    <div id="wrapper">
        @include('layouts.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('layouts.top-menu')
                <div class="container-fluid">
                    @yield('main')
                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © BPKP | PUSLITBANGWAS - NQ</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    </body>
</html>
<script type="text/javascript" src="{{URL::asset('js/app.js')}}" ></script>
<script type="text/javascript" src="{{URL::asset('js/jquery.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/templatecrud/sb-admin-2.min.js') }}" ></script>
<script type="text/javascript" src="{{ URL::asset('js/async-request.js') }}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

