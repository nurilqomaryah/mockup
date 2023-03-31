@extends('layouts.crud') 
@section('main')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">A. ANGGARAN PERJALANAN DINAS PER BIDANG</h6>
            </div>
            <div class="card-body">
                <div class="row h-100 justify-content-center align-items-center">
                    <label for="eselon3" class="col-sm-2 control-label">Nama Bidang/Bagian: </label>
                    <div class="col-sm-5">
                        <select class="form-control" name="eselon3" id="eselon3">
                            @foreach($listBidang as $per)
                            <option value="{{$per->id}}" >{{$per->nama_unit}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row h-100 justify-content-center align-items-center">
                    </br>
                </div>
                <div id="chartdiv"></div>
                
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal" tabindex="-1" id="modalTable" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <!-- Modal body -->
      <div class="modal-body">
        <div class="card card-table">
            <div class="pd-20">
                <div class="table-responsive-lg">
                    <div class="table-wrapper">
                        <table id="mytable" class="table">
                        <thead>
                            <tr>
                              <th style="text-align: center;" width="5%" data-field="no">No.</th>
                              <th style="text-align: center;" width="10%" data-field="nost">No. ST</th>
                              <th style="text-align: center;" width="10%" data-field="tglst">Tanggal ST</th>
                              <th style="text-align: center;" data-field="urst">Uraian ST</th>
                              <th style="text-align: center;" data-field="biaya">Biaya Perjadin</th>
                              <th style="text-align: center;" width="20%" data-field="status">Status Cost Sheet</th>
                            </tr>
                        </thead>
                        </table>
                    </div>
                </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
$(document).ready(function() {

$("#eselon3").select2({theme: 'bootstrap-5'});

var eselonID = $('#eselon3').val();

let indicator;
let indicatorInterval;

function showIndicator() {
  
  if (!indicator) {
    indicator = chart.tooltipContainer.createChild(am4core.Container);
    indicator.background.fill = am4core.color("#fff");
    indicator.background.fillOpacity = 0.8;
    indicator.width = am4core.percent(100);
    indicator.height = am4core.percent(100);

    indicatorLabel = indicator.createChild(am4core.Label);
    indicatorLabel.text = "Mengumpulkan data...";
    indicatorLabel.align = "center";
    indicatorLabel.valign = "middle";
    indicatorLabel.fontSize = 20;
    indicatorLabel.dy = 50;
    
    hourglass = indicator.createChild(am4core.Image);
    hourglass.href = "https://s3-us-west-2.amazonaws.com/s.cdpn.io/t-160/hourglass.svg";
    hourglass.align = "center";
    hourglass.valign = "middle";
    hourglass.horizontalCenter = "middle";
    hourglass.verticalCenter = "middle";
    hourglass.scale = 0.7;
  }
  
  indicator.hide();
  indicator.show();
  
  clearInterval(indicatorInterval);
  indicatorInterval = setInterval(function() {
    hourglass.animate([{
      from: 0,
      to: 360,
      property: "rotation"
    }], 1000);
  }, 1000);
}

function hideIndicator() {
  indicator.hide();
  clearInterval(indicatorInterval);
}

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.scrollbarX = new am4core.Scrollbar();
showIndicator();

// Set up data source
$.ajax({
    type: 'get',       
    url: 'perjadinbid/'+eselonID,
    dataType: 'json',
    success: function(data) {
        hideIndicator();
        chart.data = data;
    }
});

$('#eselon3').on('change', function() {
    var eselonID = $('#eselon3').val();
    showIndicator();

    $.ajax({
        type: 'get',       
        url: 'perjadinbid/'+eselonID,
        dataType: 'json',
        success: function(data) {
            hideIndicator();
            chart.data = data;
        }
    });
});

chart.events.on("datavalidated", function(ev) {
  chart.series.each(function(series) {
    series.appear();
  });
});

chart.colors.list = [
    am4core.color("#6488C1"),
    am4core.color("#020082"),
    am4core.color("#1873D3"),
    am4core.color("#BCD4E6")
];
chart.padding(30, 30, 10, 30);
chart.legend = new am4charts.Legend();

var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "kdindex";
categoryAxis.dataFields.kdkmpnenY = "kdkmpnen";
categoryAxis.dataFields.kdskmpnenY = "kdskmpnen";
categoryAxis.dataFields.kdakunY = "kdakun";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.labels.template.adapter.add("text", function(text) {
  return "{kdkmpnenY}.{kdskmpnenY}.{kdakunY}";
});

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.min = 0;
valueAxis.max = 100;
valueAxis.strictMinMax = true;
valueAxis.calculateTotals = true;
valueAxis.renderer.minWidth = 50;

var series1 = chart.series.push(new am4charts.ColumnSeries());
series1.columns.template.width = am4core.percent(80);
series1.columns.template.tooltipText =
  "Komp: {urkmpnenY}\nSubkomp: {urskmpnenY}\nAkun: {nmakunY}\n\n{name}: Rp {valueY.formatNumber('#,###')} ({valueY.totalPercent.formatNumber('#.00')}%)";
series1.name = "Draft";
series1.dataFields.categoryX = "kdindex";
series1.dataFields.valueY = "draft";
series1.dataFields.urkmpnenY = "urkmpnen";
series1.dataFields.urskmpnenY = "urskmpnen";
series1.dataFields.nmakunY = "nmakun";
series1.dataFields.valueYShow = "totalPercent";
series1.dataItems.template.locations.categoryX = 0.5;
series1.stacked = true;
series1.tooltip.pointerOrientation = "vertical";
series1.columns.template.events.on("hit", function(event) {
    $('#modalTable').modal('toggle');

    var id = event.target.dataItem.dataContext.kdindex;    

    $.ajax({
        url: 'statuscsd/'+id,
        type: 'get',
        dataType: 'json',
        success:function(data) {
          
            var t = $('#mytable').DataTable({
                "columnDefs": [ {
                  "searchable": false,
                  "orderable": false,
                  "targets": [0],
                }],
                "columnDefs": [ {
                  "render": $.fn.dataTable.render.number('.', ',', 0, ''),
                  "targets": [4],
                }],
                language: {
                        searchPlaceholder: 'Cari...',
                        sSearch: '',
                        lengthMenu: '_MENU_ baris/halaman',
                        info: 'Baris ke _START_ sampai _END_ dari total _TOTAL_ baris',
                                infoEmpty: 'Tidak ada data',
                  },
                "bDestroy": true,
                bJQueryUI: true,
                aaData: data,
                aoColumns: [
                  { mData: 'no' ,"fnRender": function( oObj ) { return oObj.aData[3].no }},
                  { mData: 'nost' ,"fnRender": function( oObj ) { return oObj.aData[3].nost }},
                  { mData: 'tglst',"fnRender": function( oObj ) { return oObj.aData[3].tglst }},
                  { mData: 'urst',"fnRender": function( oObj ) { return oObj.aData[3].urst }},
                  { mData: 'biaya',"fnRender": function( oObj ) { return oObj.aData[3].biaya }},
                  { mData: 'status',"fnRender": function( oObj ) { return oObj.aData[3].status }}
                ],
            });

            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                  cell.innerHTML = i+1;
                });
            }).draw();
        }     
    });
});

var series2 = chart.series.push(new am4charts.ColumnSeries());
series2.columns.template.width = am4core.percent(80);
series2.columns.template.tooltipText =
  "Komp: {urkmpnenY}\nSubkomp: {urskmpnenY}\nAkun: {nmakunY}\n\n{name}: Rp {valueY.formatNumber('#,###')} ({valueY.totalPercent.formatNumber('#.00')}%)";
series2.name = "Outstanding";
series2.dataFields.categoryX = "kdindex";
series2.dataFields.valueY = "outstand";
series2.dataFields.urkmpnenY = "urkmpnen";
series2.dataFields.urskmpnenY = "urskmpnen";
series2.dataFields.nmakunY = "nmakun";
series2.dataFields.valueYShow = "totalPercent";
series2.dataItems.template.locations.categoryX = 0.5;
series2.stacked = true;
series2.tooltip.pointerOrientation = "vertical";
series2.columns.template.events.on("hit", function(event) {
    $('#modalTable').modal('toggle');

    var id = event.target.dataItem.dataContext.kdindex;    

    $.ajax({
        url: 'statuscso/'+id,
        type: 'get',
        dataType: 'json',
        success:function(data) {
          
            var t = $('#mytable').DataTable({
                "columnDefs": [ {
                  "searchable": false,
                  "orderable": false,
                  "targets": [0],
                }],
                "columnDefs": [ {
                  "render": $.fn.dataTable.render.number('.', ',', 0, ''),
                  "targets": [4],
                }],
                language: {
                        searchPlaceholder: 'Cari...',
                        sSearch: '',
                        lengthMenu: '_MENU_ baris/halaman',
                        info: 'Baris ke _START_ sampai _END_ dari total _TOTAL_ baris',
                                infoEmpty: 'Tidak ada data',
                  },
                "bDestroy": true,
                bJQueryUI: true,
                aaData: data,
                aoColumns: [
                  { mData: 'no' ,"fnRender": function( oObj ) { return oObj.aData[3].no }},
                  { mData: 'nost' ,"fnRender": function( oObj ) { return oObj.aData[3].nost }},
                  { mData: 'tglst',"fnRender": function( oObj ) { return oObj.aData[3].tglst }},
                  { mData: 'urst',"fnRender": function( oObj ) { return oObj.aData[3].urst }},
                  { mData: 'biaya',"fnRender": function( oObj ) { return oObj.aData[3].biaya }},
                  { mData: 'status',"fnRender": function( oObj ) { return oObj.aData[3].status }}
                ],
            });

            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                  cell.innerHTML = i+1;
                });
            }).draw();
        }     
    });
});

var series3 = chart.series.push(new am4charts.ColumnSeries());
series3.columns.template.width = am4core.percent(80);
series3.columns.template.tooltipText =
  "Komp: {urkmpnenY}\nSubkomp: {urskmpnenY}\nAkun: {nmakunY}\n\n{name}: Rp {valueY.formatNumber('#,###')} ({valueY.totalPercent.formatNumber('#.00')}%)";
series3.name = "Realisasi";
series3.dataFields.categoryX = "kdindex";
series3.dataFields.valueY = "realisasi";
series3.dataFields.urkmpnenY = "urkmpnen";
series3.dataFields.urskmpnenY = "urskmpnen";
series3.dataFields.nmakunY = "nmakun";
series3.dataFields.valueYShow = "totalPercent";
series3.dataItems.template.locations.categoryX = 0.5;
series3.stacked = true;
series3.tooltip.pointerOrientation = "vertical";
series3.columns.template.events.on("hit", function(event) {
    $('#modalTable').modal('toggle');

    var id = event.target.dataItem.dataContext.kdindex;    

    $.ajax({
        url: 'statuscsr/'+id,
        type: 'get',
        dataType: 'json',
        success:function(data) {
          
            var t = $('#mytable').DataTable({
                "columnDefs": [ {
                  "searchable": false,
                  "orderable": false,
                  "targets": [0],
                }],
                "columnDefs": [ {
                  "render": $.fn.dataTable.render.number('.', ',', 0, ''),
                  "targets": [4],
                }],
                language: {
                        searchPlaceholder: 'Cari...',
                        sSearch: '',
                        lengthMenu: '_MENU_ baris/halaman',
                        info: 'Baris ke _START_ sampai _END_ dari total _TOTAL_ baris',
                                infoEmpty: 'Tidak ada data',
                  },
                "bDestroy": true,
                bJQueryUI: true,
                aaData: data,
                aoColumns: [
                  { mData: 'no' ,"fnRender": function( oObj ) { return oObj.aData[3].no }},
                  { mData: 'nost' ,"fnRender": function( oObj ) { return oObj.aData[3].nost }},
                  { mData: 'tglst',"fnRender": function( oObj ) { return oObj.aData[3].tglst }},
                  { mData: 'urst',"fnRender": function( oObj ) { return oObj.aData[3].urst }},
                  { mData: 'biaya',"fnRender": function( oObj ) { return oObj.aData[3].biaya }},
                  { mData: 'status',"fnRender": function( oObj ) { return oObj.aData[3].status }}
                ],
            });

            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                  cell.innerHTML = i+1;
                });
            }).draw();
        }     
    });
});

var series4 = chart.series.push(new am4charts.ColumnSeries());
series4.columns.template.width = am4core.percent(80);
series4.columns.template.tooltipText =
  "Komp: {urkmpnenY}\nSubkomp: {urskmpnenY}\nAkun: {nmakunY}\n\n{name}: Rp {valueY.formatNumber('#,###')} ({valueY.totalPercent.formatNumber('#.00')}%)";
series4.name = "Sisa";
series4.dataFields.categoryX = "kdindex";
series4.dataFields.valueY = "sisa";
series4.dataFields.urkmpnenY = "urkmpnen";
series4.dataFields.urskmpnenY = "urskmpnen";
series4.dataFields.nmakunY = "nmakun";
series4.dataFields.valueYShow = "totalPercent";
series4.dataItems.template.locations.categoryX = 0.5;
series4.stacked = true;
series4.tooltip.pointerOrientation = "vertical";


});
</script>
@endpush


