@extends('layouts.crud')
@section('main')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header align-items-center justify-content-between">
                    <center><h5 class="m-0 font-weight-bold text-primary">Dashboard Keuangan</h5></center>
                </div>
                <div class="card-body">
                    <div id="grafik-keuangan-2" style="min-height: 70vh; width: 100%;"></div>
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
            Highcharts.chart('grafik-keuangan-2', {
                colors: [
                    '#454cb3',
                    '#fea00a',
                    '#d3d3d3'
                ],
                chart: {
                    type: 'bar'
                },
                title: {
                    text: 'Penyerapan Anggaran'
                },
                subtitle: {
                    text: 'Bidang Tata Usaha'
                },
                xAxis: {
                    categories: [
                        @foreach($listUraian as $data)
                            "{{ $data->uraian }}",
                        @endforeach
                    ]
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Dalam Persentase %'
                    },
                    reversedStacks: false
                },
                legend: {
                    reversed: false
                },
                plotOptions: {
                    series: {
                        stacking: 'percent'
                    }
                },
                series: {!! $seriesData !!}
            });
        })
    </script>
@endsection

