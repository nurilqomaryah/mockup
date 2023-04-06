@extends('layouts.crud')
@section('main')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">A. PENYERAPAN ANGGARAN</h6>
            </div>
            <div class="card-body">
                <div class="row align-items-end justify-content-center">
                    @foreach($bidang as $item)
                    <div class="anggaran col-xl-3 col-md-6 mb-4 text-center" data-toggle="modal" data-target="#modalTable{{$item->id}}" data-id="{{$item->id}}" onclick="showModalBidang(this)">
                        <h6>{{ $item->nama_unit }}</h6>
                        <h1 class="text-blue" style="padding-top: 0px !important; margin-bottom: 5px;">{{ number_format($item->realisasi/$item->anggaran*100,2,',','.') }} %</h1>
                    </div>
                    @endforeach  
                    @foreach($total as $item)
                    <div class="anggaran col-xl-3 col-md-6 mb-4 text-center" data-toggle="modal" data-target="#modalTable{{$item->kdsatker}}" onclick="showModalSatker(this)">
                        <h6>Total Satker</h6>
                        <h1 class="text-blue" style="padding-top: 0px !important; margin-bottom: 5px;">{{ number_format($item->realisasi/$item->anggaran*100,2,',','.') }} %</h1>
                    </div>
                    @endforeach                                      
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">B. PKAU</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($listPkau as $pkau)
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card pkau border-left-primary shadow h-100 py-1" data-toggle="modal" data-target="#modalTable" data-id="{{$pkau->kode_pkau_pkpt}}" onclick="showModal(this)">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-md-9 mb-0" style="margin-bottom: 1em;">
                                            <span>{{ $loop->iteration }}. {{ $pkau->uraian_pkau_pkpt }}</span>
                                        </div>
                                        <div class="col-md-3 mb-0 text-center">
                                            <span class="text-magenta">Jumlah ST</span>
                                            <h5 class="text-magenta">{{ $pkau->total_st }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">C. PKPT</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($listPkpt as $pkpt)
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card pkau border-left-primary shadow h-100 py-1" data-toggle="modal" data-target="#modalTable" data-id="{{$pkpt->kode_pkau_pkpt}}" onclick="showModal(this)">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-md-9 mb-0" style="margin-bottom: 1em;">
                                            <span>{{ $loop->iteration }}. {{ $pkpt->uraian_pkau_pkpt }}</span>
                                        </div>
                                        <div class="col-md-3 mb-0 text-center">
                                            <span class="text-magenta">Jumlah ST</span>
                                            <h5 class="text-magenta">{{ $pkpt->total_st }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($bidang as $item)
<div class="modal" tabindex="-1" id="modalTable{{$item->id}}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h6>{{$item->nama_unit}}</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>      
            <div class="modal-body">
                <div id="chartdiv{{$item->id}}" style="width: 100%; height: 75vh;"></div>                                
            </div>
        </div>
    </div>
</div>
@endforeach
@foreach($total as $item)
<div class="modal" tabindex="-1" id="modalTable{{$item->kdsatker}}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h6>Total Satker</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>      
            <div class="modal-body">                
                <div id="chartdiv"></div>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- The Modal -->

<div class="modal" tabindex="-1" id="modalTable" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                    <th class="col-1" data-field="id_st">No.</th>
                    <th class="col-2" data-field="no_surat_tugas">Nomor ST</th>
                    <th class="col-2" data-field="tanggal_surat_tugas">Tanggal ST</th>
                    <th class="col-6" data-field="nama_penugasan">Nama Penugasan</th>
                    <th class="col-1" data-field="status_st">Status ST</th>
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

@push('js1')
<script type="text/javascript">
function showModalBidang(ele){
    am4core.disposeAllCharts();
    var idBid = $(ele).attr('data-id');

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    window['chart'+idBid] = am4core.create("chartdiv"+idBid, am4charts.XYChart);
    window['chart'+idBid].language.locale = am4lang_id_ID;

    window['chart'+idBid].numberFormatter.numberFormat = "#,###.##";

    window['indicator'+idBid];
    window['indicatorInterval'+idBid];

    function showIndicator() {
      
      if (!window['indicator'+idBid]) {
        window['indicator'+idBid] = window['chart'+idBid].tooltipContainer.createChild(am4core.Container);
        window['indicator'+idBid].background.fill = am4core.color("#fff");
        window['indicator'+idBid].background.fillOpacity = 0.8;
        window['indicator'+idBid].width = am4core.percent(100);
        window['indicator'+idBid].height = am4core.percent(100);

        window['indicatorLabel'+idBid] = window['indicator'+idBid].createChild(am4core.Label);
        window['indicatorLabel'+idBid].text = "Mengumpulkan data...";
        window['indicatorLabel'+idBid].align = "center";
        window['indicatorLabel'+idBid].valign = "middle";
        window['indicatorLabel'+idBid].fontSize = 20;
        window['indicatorLabel'+idBid].dy = 50;
        
        window['hourglass'+idBid] = window['indicator'+idBid].createChild(am4core.Image);
        window['hourglass'+idBid].href = "https://s3-us-west-2.amazonaws.com/s.cdpn.io/t-160/hourglass.svg";
        window['hourglass'+idBid].align = "center";
        window['hourglass'+idBid].valign = "middle";
        window['hourglass'+idBid].horizontalCenter = "middle";
        window['hourglass'+idBid].verticalCenter = "middle";
        window['hourglass'+idBid].scale = 0.7;
      }
      
      window['indicator'+idBid].hide();
      window['indicator'+idBid].show();
      
      clearInterval(window['indicatorInterval'+idBid]);
      window['indicatorInterval'+idBid] = setInterval(function() {
        window['hourglass'+idBid].animate([{
          from: 0,
          to: 360,
          property: "rotation"
        }], 1000);
      }, 1000);
    }

    function hideIndicator() {
      window['indicator'+idBid].hide();
      clearInterval(window['indicatorInterval'+idBid]);
    }

    

    // Set up data source
    $.ajax({
        type: 'get',       
        url: 'serapbid/'+idBid,
        dataType: 'json',
        beforeSend: function() {
            showIndicator();
        },
        success: function(data) {
            hideIndicator();
            //alert(data);
            window['chart'+idBid].data = data;            

            // Create axes
            window['categoryAxis'+idBid] = window['chart'+idBid].xAxes.push(new am4charts.CategoryAxis());
            window['categoryAxis'+idBid].dataFields.category = "nama_unit";
            window['categoryAxis'+idBid].renderer.grid.template.location = 0;
            window['categoryAxis'+idBid].renderer.minGridDistance = 20;
            window['categoryAxis'+idBid].renderer.inside = true;
            window['categoryAxis'+idBid].renderer.labels.template.disabled = true;
            window['categoryAxis'+idBid].renderer.cellStartLocation = 0.1;
            window['categoryAxis'+idBid].renderer.cellEndLocation = 0.9;

            // Create value axis
            window['valueAxis'+idBid] = window['chart'+idBid].yAxes.push(new am4charts.ValueAxis());
            window['valueAxis'+idBid].renderer.minWidth = 50;
            window['valueAxis'+idBid].cursorTooltipEnabled = false;

            // Create series
            function createSeries(field, name) {
              window['series'+idBid] = window['chart'+idBid].series.push(new am4charts.ColumnSeries());
              window['series'+idBid].dataFields.valueY = field;
              window['series'+idBid].dataFields.categoryX = "nama_unit";
              window['series'+idBid].name = name;
              window['series'+idBid].columns.template.tooltipText = "{name}: [bold]{valueY}[/]";
              window['series'+idBid].columns.template.width = am4core.percent(95);
              
              window['bullet'+idBid] = window['series'+idBid].bullets.push(new am4charts.LabelBullet);
              window['bullet'+idBid].label.text = "{name}";
              window['bullet'+idBid].label.rotation = 90;
              window['bullet'+idBid].label.truncate = false;
              window['bullet'+idBid].label.hideOversized = false;
              window['bullet'+idBid].label.horizontalCenter = "left";
              window['bullet'+idBid].locationY = 1;
              window['bullet'+idBid].dy = 10;
            };

            window['chart'+idBid].paddingBottom = 150;
            window['chart'+idBid].maskBullets = false;

            createSeries("anggaran", "Anggaran", false);
            createSeries("draft", "Draft", false);
            createSeries("outstand", "Outstanding", false);
            createSeries("realisasi", "Realisasi", false);

        }
    });
};

function showModalSatker(ele){
    am4core.disposeAllCharts();

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    chart = am4core.create("chartdiv", am4charts.XYChart);
    chart.language.locale = am4lang_id_ID;

    chart.numberFormatter.numberFormat = "#,###.##";

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

    showIndicator();

    // Set up data source
    $.ajax({
        type: 'get',       
        url: 'serapsatker',
        dataType: 'json',
        success: function(data) {
            hideIndicator();
            //alert(data);
            chart.data = data;            

            // Create axes
            categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "kdsatker";
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.minGridDistance = 20;
            categoryAxis.renderer.inside = true;
            categoryAxis.renderer.labels.template.disabled = true;
            categoryAxis.renderer.cellStartLocation = 0.1;
            categoryAxis.renderer.cellEndLocation = 0.9;

            // Create value axis
            valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.renderer.minWidth = 50;
            valueAxis.cursorTooltipEnabled = false;

            // Create series
            function createSeries(field, name) {
              series = chart.series.push(new am4charts.ColumnSeries());
              series.dataFields.valueY = field;
              series.dataFields.categoryX = "kdsatker";
              series.name = name;
              series.columns.template.tooltipText = "{name}: [bold]{valueY}[/]";
              series.columns.template.width = am4core.percent(95);
              
              bullet = series.bullets.push(new am4charts.LabelBullet);
              bullet.label.text = "{name}";
              bullet.label.rotation = 90;
              bullet.label.truncate = false;
              bullet.label.hideOversized = false;
              bullet.label.horizontalCenter = "left";
              bullet.locationY = 1;
              bullet.dy = 10;
            };

            chart.paddingBottom = 150;
            chart.maskBullets = false;

            createSeries("anggaran", "Anggaran", false);
            createSeries("draft", "Draft", false);
            createSeries("outstand", "Outstanding", false);
            createSeries("realisasi", "Realisasi", false);

        }
    });
};

function showModal(ele) 
{
  var id= $(ele).attr('data-id');

  $.ajax({
      url: 'stpkau/'+id,
      type: 'get',
      dataType: 'json',
      success:function(data) {
        
        var t = $('#mytable').DataTable({
            "columnDefs": [ {
                              "searchable": false,
                              "orderable": false,
                              "targets": [0],
                            }],

            "bDestroy": true,
            bJQueryUI: true,
            aaData: data,
            aoColumns: [
                { mData: 'id_st' ,"fnRender": function( oObj ) { return oObj.aData[3].id_st }},
                { mData: 'no_surat_tugas' ,"fnRender": function( oObj ) { return oObj.aData[3].no_surat_tugas }},
                { mData: 'tanggal_surat_tugas',"fnRender": function( oObj ) { return oObj.aData[3].tanggal_surat_tugas }},
                { mData: 'nama_penugasan',"fnRender": function( oObj ) { return oObj.aData[3].nama_penugasan }},
                { mData: 'status_st',"fnRender": function( oObj ) { return oObj.aData[3].status_st }}
                     ],
        });

        t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            });
        }).draw();

     }     
  });  
};

</script>
@endpush
