@extends('layouts.crud') 
@section('main')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">A. STATUS LAPORAN KEGIATAN PERJALANAN DINAS</h6>
            </div>
            <div class="card-body">
                <div id="chartdiv"></div>
                
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal" tabindex="-1" id="modalTable1" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="m-0 font-weight-bold text-primary">Laporan <span id="bidang"></span> dengan Status <span id="status"></span></h5>
        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="card card-table">
            <div class="pd-20">
                <div class="table-responsive-lg">
                    <div class="table-wrapper">
                        <table id="mytable1" class="table">
                        <thead>
                            <tr>
                              <th style="text-align: center;" width="5%" data-field="id_st">No.</th>
                              <th style="text-align: center;" width="23%" data-field="no_surat_tugas">No. ST</th>
                              <th style="text-align: center;" width="12%" data-field="tanggal_surat_tugas">Tanggal ST</th>
                              <th style="text-align: center;" data-field="nama_penugasan">Uraian ST</th>
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

<!-- The Modal -->
<div class="modal" tabindex="-1" id="modalTable7" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="m-0 font-weight-bold text-primary">Laporan <span id="bidang7"></span> dengan Status <span id="status7"></span></h5>
        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="card card-table">
            <div class="pd-20">
                <div class="table-responsive-lg">
                    <div class="table-wrapper">
                        <table id="mytable7" class="table">
                        <thead>
                            <tr>
                              <th style="text-align: center;" width="5%" data-field="id_st">No.</th>
                              <th style="text-align: center;" width="15%" data-field="no_surat_tugas">No. ST</th>
                              <th style="text-align: center;" width="15%" data-field="tanggal_surat_tugas">Tanggal ST</th>
                              <th style="text-align: center;" data-field="nama_penugasan">Uraian ST</th>
                              <th style="text-align: center;" width="15%" data-field="no_laporan">No. Laporan</th>
                              <th style="text-align: center;" width="15%" data-field="tgl_laporan">Tanggal Laporan</th>
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
    url: '/rekapstatlap',
    dataType: 'json',
    success: function(data) {
        hideIndicator();
        chart.data = data;
    }
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
categoryAxis.dataFields.category = "id_unit";
categoryAxis.dataFields.namaUnit = "nama_unit";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.labels.template.adapter.add("text", function(text) {
  return "{namaUnit}";
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
  "{name}: {valueY.formatNumber('#,###')} Laporan";
series1.name = "Konsep";
series1.dataFields.categoryX = "id_unit";
series1.dataFields.valueY = "jml_1";
series1.dataFields.valueYShow = "totalPercent";
series1.dataItems.template.locations.categoryX = 0.5;
series1.stacked = true;
series1.tooltip.pointerOrientation = "vertical";
series1.columns.template.events.on("hit", function(event) {
    var status = "Konsep";
    var bidang = event.target.dataItem.dataContext.nama_unit;
    document.getElementById("status").innerHTML = status;
    document.getElementById("bidang").innerHTML = bidang;
    $('#modalTable1').modal('toggle');

    var id = event.target.dataItem.dataContext.id_unit;    

    $.ajax({
        url: '/stat1bid/'+id,
        type: 'get',
        dataType: 'json',
        success:function(data) {
          
            var t = $('#mytable1').DataTable({
                "order": [],
                "columnDefs": [ {
                  "searchable": false,
                  "orderable": false,
                  "targets": [0],
                },{
                    "className": "text-center",
                    "targets": [0,1,2],
                },{
                    "targets": 2,
                    "render": DataTable.render.moment( 'YYYY-MM-DD', 'D MMMM YYYY', 'id')
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
                  { mData: 'id_st' ,"fnRender": function( oObj ) { return oObj.aData[3].no }},
                  { mData: 'no_surat_tugas' ,"fnRender": function( oObj ) { return oObj.aData[3].nost }},
                  { mData: 'tanggal_surat_tugas',"fnRender": function( oObj ) { return oObj.aData[3].tglst }},
                  { mData: 'nama_penugasan',"fnRender": function( oObj ) { return oObj.aData[3].urst }}
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

var series7 = chart.series.push(new am4charts.ColumnSeries());
series7.columns.template.width = am4core.percent(80);
series7.columns.template.tooltipText =
  "{name}: {valueY.formatNumber('#,###')} Laporan";
series7.name = "Final";
series7.dataFields.categoryX = "id_unit";
series7.dataFields.valueY = "jml_7";
series7.dataFields.valueYShow = "totalPercent";
series7.dataItems.template.locations.categoryX = 0.5;
series7.stacked = true;
series7.tooltip.pointerOrientation = "vertical";
series7.columns.template.events.on("hit", function(event) {
    var status = "Final";
    var bidang = event.target.dataItem.dataContext.nama_unit;
    document.getElementById("status7").innerHTML = status;
    document.getElementById("bidang7").innerHTML = bidang;
    $('#modalTable7').modal('toggle');

    var id = event.target.dataItem.dataContext.id_unit;    

    $.ajax({
        url: '/stat7bid/'+id,
        type: 'get',
        dataType: 'json',
        success:function(data) {
          
            var t = $('#mytable7').DataTable({
                "order": [],
                "columnDefs": [ {
                  "searchable": false,
                  "orderable": false,
                  "targets": [0],
                },{
                    "className": "text-center",
                    "targets": [0,1,2,4,5],
                },{
                    "targets": 2,
                    "render": DataTable.render.moment( 'YYYY-MM-DD', 'D MMMM YYYY', 'id')
                },{
                    "targets": 5,
                    "render": DataTable.render.moment( 'YYYY-MM-DD HH:mm:ss', 'D MMMM YYYY', 'id')
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
                  { mData: 'id_st' ,"fnRender": function( oObj ) { return oObj.aData[3].no }},
                  { mData: 'no_surat_tugas' ,"fnRender": function( oObj ) { return oObj.aData[3].nost }},
                  { mData: 'tanggal_surat_tugas',"fnRender": function( oObj ) { return oObj.aData[3].tglst }},
                  { mData: 'nama_penugasan',"fnRender": function( oObj ) { return oObj.aData[3].urst }},
                  { mData: 'no_laporan' ,"fnRender": function( oObj ) { return oObj.aData[3].nost }},
                  { mData: 'tgl_laporan',"fnRender": function( oObj ) { return oObj.aData[3].tglst }}
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


});
</script>
@endpush


