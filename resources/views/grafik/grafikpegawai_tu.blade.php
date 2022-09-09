@extends('layouts.crud')
@section('main')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header align-items-center justify-content-between">
                    <center><h5 class="m-0 font-weight-bold text-primary">Dashboard Pegawai</h5></center>
                </div>
                <div class="card-body">
                    <div id="grafik-hari-penugasan-3" style="min-height: 40vh; width: 100%;"></div>
                </div>
                <div class="card-body">
                    <div id="grafik-hari-dinas-3" style="min-height: 40vh; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            Highcharts.setOptions({
                lang:{
                    decimalPoint: ',',
                    thousandsSep: '.'
                }
            });
            Highcharts.chart('grafik-hari-penugasan-3', {
                colors: ['#454cb3'],
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Jumlah Hari Penugasan per-Pegawai'
                },
                subtitle: {
                    text: 'Bagian Tata Usaha'
                },
                xAxis: {
                    categories: [
                        @foreach($grafikST as $jumlahpenugasan)
                            '{{ $jumlahpenugasan->nama }}',
                        @endforeach
                    ]
                },
                yAxis: {
                    title: {
                        text: 'Jumlah Hari'
                    }
                },
                tooltip: {
                    headerFormat: '<table style="font-size: small">',
                    pointFormat: '<span style="color:{series.color};padding:0" style="font-size: small">{series.name}:<b>{point.y}</b></span></br>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [
                    {
                        name: 'Jumlah Hari',
                        data: [
                            @foreach($grafikST as $jumlahpenugasan)
                                {{ $jumlahpenugasan->jml_hari }},
                            @endforeach
                        ]
                    }
                ]
            });
            Highcharts.chart('grafik-hari-dinas-3', {
                colors: ['#fea00a'],
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Jumlah Hari Perjalanan Dinas per-Pegawai'
                },
                subtitle: {
                    text: 'Bagian Tata Usaha'
                },
                xAxis: {
                    categories: [
                        @foreach($grafikDL as $jumlahdinas)
                            '{{ $jumlahdinas->nama }}',
                        @endforeach
                    ]
                },
                yAxis: {
                    title: {
                        text: 'Jumlah Hari'
                    }
                },
                tooltip: {
                    headerFormat: '<table style="font-size: small">',
                    pointFormat: '<span style="color:{series.color};padding:0" style="font-size: small">{series.name}:<b>{point.y}</b></span></br>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [
                    {
                        name: 'Jumlah Hari',
                        data: [
                            @foreach($grafikDL as $jumlahdinas)
                                {{ $jumlahdinas->jml_hari }},
                            @endforeach
                        ]
                    }
                ]
            });
        })
    </script>
@endsection

