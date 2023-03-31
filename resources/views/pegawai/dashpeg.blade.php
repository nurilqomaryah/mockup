@extends('layouts.crud') 
@section('main')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">A. SURAT TUGAS PER PEGAWAI</h6>
            </div>
            <div class="card-body">
                <div class="row h-100 justify-content-center align-items-center">
                    <label for="eselon3" class="col-sm-2 control-label">Nama Bidang/Bagian: </label>
                    <div class="col-sm-5">
                        <select class="form-control" name="eselon3" id="eselon3">
                            <option value="0" selected>Seluruh Bidang/Bagian</option>
                            @foreach($listBidang as $per)
                            <option value="{{$per->id}}" >{{$per->nama_unit}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row h-100 justify-content-center align-items-center">
                    </br>
                </div>
                <div class="row h-100 justify-content-center align-items-center">
                    <label for="tgl_mulai" class="col-md-auto control-label">Antara Tanggal:</label>
                    <div class="col-sm-2">
                        <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" value="<?php echo date("Y-m-d"); ?>">
                    </div>
                    <label for="tgl_selesai" class="col-md-auto control-label">Sampai Dengan Tanggal:</label>
                    <div class="col-sm-2">
                        <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" value="<?php echo date("Y-m-d"); ?>">
                    </div>
                </div>
                <div class="row h-100 justify-content-center align-items-center">
                    </br>                    
                </div>

                <div id="chartdiv"></div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">B. PERJALANAN DINAS PER PEGAWAI</h6>
            </div>
            <div id="chartdivgantt"></div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal" tabindex="-1" id="modalTable" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Daftar ST Atas Nama <span id="Risiko"></span></h5>
      </div>
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
                              <th style="text-align: center;" width="18%" data-field="nost">No. ST</th>
                              <th style="text-align: center;" data-field="tglst">Tanggal ST</th>
                              <th style="text-align: center;" data-field="urst">Uraian ST</th>
                              <th style="text-align: center;" data-field="mulai">Tanggal Mulai</th>
                              <th style="text-align: center;" data-field="selesai">Tanggal Selesai</th>
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
var mulaiID = $('#tgl_mulai').val();
var selesaiID = $('#tgl_selesai').val();

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.scrollbarX = new am4core.Scrollbar();

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "nama";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;
categoryAxis.renderer.labels.template.horizontalCenter = "right";
categoryAxis.renderer.labels.template.verticalCenter = "middle";
categoryAxis.renderer.labels.template.rotation = 270;
categoryAxis.tooltip.disabled = true;
categoryAxis.renderer.minHeight = 110;

// Create value axis
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.minWidth = 50;
valueAxis.cursorTooltipEnabled = false;

// Create series
var series = chart.series.push(new am4charts.ColumnSeries());
series.sequencedInterpolation = true;
series.dataFields.valueY = "jumlah";
series.dataFields.categoryX = "nama";
series.tooltipText = "[bold]{categoryX} : {valueY}[/]"; 
series.columns.template.strokeWidth = 0;

series.tooltip.pointerOrientation = "vertical";

series.columns.template.column.cornerRadiusTopLeft = 10;
series.columns.template.column.cornerRadiusTopRight = 10;
series.columns.template.column.fillOpacity = 0.8;
 
series.columns.template.events.on("hit", function(event) {

$('#modalTable').modal('toggle');

  var mulaiID = $('#tgl_mulai').val();
  var selesaiID = $('#tgl_selesai').val();
  var id = event.target.dataItem.dataContext.id;
  var pegawai = event.target.dataItem.dataContext.nama;
  document.getElementById("Risiko").innerHTML = pegawai;
    

  $.ajax({
    url: 'stpeg/'+id+'/'+mulaiID+'/'+selesaiID,
    type: 'get',
    dataType: 'json',
    success:function(data) {
      
      var t = $('#mytable').DataTable({
        "columnDefs": [ {
          "searchable": false,
          "orderable": false,
          "targets": [0],
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
          { mData: 'mulai',"fnRender": function( oObj ) { return oObj.aData[3].mulai }},
          { mData: 'selesai',"fnRender": function( oObj ) { return oObj.aData[3].selesai }}
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

// on hover, make corner radiuses bigger
var hoverState = series.columns.template.column.states.create("hover");
hoverState.properties.cornerRadiusTopLeft = 0;
hoverState.properties.cornerRadiusTopRight = 0;
hoverState.properties.fillOpacity = 1;

series.columns.template.adapter.add("fill", function(fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
});

// Cursor
chart.cursor = new am4charts.XYCursor();
chart.cursor.snapToSeries = [series];

//Gantt
var chart2 = am4core.create("chartdivgantt", am4charts.XYChart);
chart2.hiddenState.properties.opacity = 0; // this creates initial fade-in

$.ajax({
    type: 'get',       
    url: 'dlsatker/',
    dataType: 'json',
    success: function(data) {
        console.log(data);
        chart2.data = data;
    }
});

chart2.paddingRight = 30;
chart2.dateFormatter.inputDateFormat = "yyyy-MM-dd";

var colorSet2 = new am4core.ColorSet();
colorSet2.saturation = 0.4;

chart2.dateFormatter.dateFormat = "dd-MM-yyyy";
chart2.dateFormatter.inputDateFormat = "yyyy-MM-dd";

var categoryAxisg = chart2.yAxes.push(new am4charts.CategoryAxis());
categoryAxisg.dataFields.category = "nama";
categoryAxisg.renderer.grid.template.location = 0;
categoryAxisg.renderer.inversed = true;
categoryAxisg.keepSelection = true;
categoryAxisg.start = 0;
categoryAxisg.end = 0.5;

var dateAxisg = chart2.xAxes.push(new am4charts.DateAxis());
dateAxisg.renderer.minGridDistance = 70;
dateAxisg.baseInterval = { count: 1, timeUnit: "day" };
// dateAxis.max = new Date(2018, 0, 1, 24, 0, 0, 0).getTime();
//dateAxis.strictMinMax = true;
dateAxisg.renderer.tooltipLocation = 0;

var series1g = chart2.series.push(new am4charts.ColumnSeries());
series1g.columns.template.height = am4core.percent(70);
series1g.columns.template.tooltipText = "Nama: [bold]{nama}[/]\n\nNo. ST: {task}\nNama ST: {uraianst}\n\nTanggal Berangkat: [bold]{openDateX}[/]\nTanggal Kembali: [bold]{dateX}[/]";
series1g.tooltip.label.wrap = true;
series1g.tooltip.label.width = 300;

series1g.dataFields.openDateX = "tglberangkat";
series1g.dataFields.dateX = "tglkembali";
series1g.dataFields.categoryY = "nama";
series1g.columns.template.strokeOpacity = 1;

chart2.scrollbarX = new am4core.Scrollbar();
chart2.scrollbarY = new am4core.Scrollbar();

// Set up data source
$.ajax({
    type: 'get',       
    url: 'stsatker/'+mulaiID+'/'+selesaiID,
    dataType: 'json',
    success: function(data) {
        //alert(data);
        chart.data = data;
    }
});

$('#eselon3').on('change', function() {
    var eselonID = $('#eselon3').val();
    var mulaiID = $('#tgl_mulai').val();
    var selesaiID = $('#tgl_selesai').val();
    if(eselonID > 0){
        $.ajax({
            type: 'get',       
            url: 'stbidang/'+eselonID+'/'+mulaiID+'/'+selesaiID,
            dataType: 'json',
            success: function(data) {
                //alert(data);
                chart.data = data;
            }
        });
    } else {
        $.ajax({
            type: 'get',       
            url: 'stsatker/'+mulaiID+'/'+selesaiID,
            dataType: 'json',
            success: function(data) {
                //alert(data);
                chart.data = data;
            }
        });
    }
});

$('#tgl_mulai').on('change', function() {
    var eselonID = $('#eselon3').val();
    var mulaiID = $('#tgl_mulai').val();
    var selesaiID = $('#tgl_selesai').val();
    if(eselonID > 0){
        $.ajax({
            type: 'get',       
            url: 'stbidang/'+eselonID+'/'+mulaiID+'/'+selesaiID,
            dataType: 'json',
            success: function(data) {
                //alert(data);
                chart.data = data;
            }
        });
    } else {
        $.ajax({
            type: 'get',       
            url: 'stsatker/'+mulaiID+'/'+selesaiID,
            dataType: 'json',
            success: function(data) {
                //alert(data);
                chart.data = data;
            }
        });
    }
});

$('#tgl_selesai').on('change', function() {
    var eselonID = $('#eselon3').val();
    var mulaiID = $('#tgl_mulai').val();
    var selesaiID = $('#tgl_selesai').val();
    if(eselonID > 0){
        $.ajax({
            type: 'get',       
            url: 'stbidang/'+eselonID+'/'+mulaiID+'/'+selesaiID,
            dataType: 'json',
            success: function(data) {
                //alert(data);
                chart.data = data;
            }
        });
    } else {
        $.ajax({
            type: 'get',       
            url: 'stsatker/'+mulaiID+'/'+selesaiID,
            dataType: 'json',
            success: function(data) {
                //alert(data);
                chart.data = data;
            }
        });
    }
});

chart.events.on("datavalidated", function(ev) {
  chart.series.each(function(series) {
    series.appear();
  });
});

chart2.events.on("datavalidated", function(ev) {
    categoryAxisg.zoomToIndexes(1, 9, false, true);
    dateAxisg.zoomToDates(
        new Date(2023, 2, 1),
        new Date(2023, 2, 11)
    );
});

});
</script>
@endpush

