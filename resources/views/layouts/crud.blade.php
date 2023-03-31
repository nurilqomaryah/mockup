<html>
    <head>
        <meta charset="utf-8">
        <link rel="icon" type="image/x-icon" href="{{asset('images/BPKP_Logo.png')}}">
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/BPKP_Logo.png')}}">
        <meta property="og:title" content="MOCKUP">
        <meta property="og:description" content="Monitoring Kinerja dan Keuangan PKAU dan PKPT">
        <title>MOCKUP</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.13.2/date-1.3.0/fc-4.2.1/fh-3.3.1/r-2.4.0/sc-2.1.0/datatables.min.css"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/templatecrud/sb-admin-2.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/templatecrud/custom-styles.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('js/templatecrud/morris/morris-0.4.3.min.css') }}"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />        
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
        <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
        <script src="{{ asset('js/highcharts/highcharts.js') }}"></script>

    </head>
    <body id="page-top">
            <style>
            #chartdiv {
              width: 100%;
              height: 75vh;
            }

            #chartdivgantt {
              width: 100%;
              height: 75vh;
            }

              .table  {
                color: #212529;
            }
            </style>
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
    <script type="text/javascript" src="{{URL::asset('js/app.js')}}" ></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{URL::asset('js/templatecrud/sb-admin-2.min.js') }}" ></script>
    <script type="text/javascript" src="{{ URL::asset('js/async-request.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js"></script>  
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.13.2/date-1.3.0/fc-4.2.1/fh-3.3.1/r-2.4.0/sc-2.1.0/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.3/dataRender/datetime.js"></script>    
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <script src="//www.amcharts.com/lib/4/lang/id_ID.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @stack('js')
    @stack('js1')
    </body>
</html>


