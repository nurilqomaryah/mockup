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
                    <div class="anggaran col-xl-3 col-md-6 mb-4 text-center" data-toggle="modal" data-target="#modalTable{{$item->id}}">
                        <h6>{{ $item->nama_unit }}</h6>
                        <h1 class="text-blue" style="padding-top: 0px !important; margin-bottom: 5px;">{{ number_format($item->realisasi/$item->anggaran,2,',','.') }} %</h1>
                    </div>
                    @endforeach  
                    @foreach($total as $item)
                    <div class="anggaran col-xl-3 col-md-6 mb-4 text-center" data-toggle="modal" data-target="#modalTable{{$item->kdsatker}}">
                        <h6>Total Satker</h6>
                        <h1 class="text-blue" style="padding-top: 0px !important; margin-bottom: 5px;">{{ number_format($item->realisasi/$item->anggaran,2,',','.') }} %</h1>
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

@foreach($bidang as $item)
<div class="modal" tabindex="-1" id="modalTable{{$item->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6>{{$item->nama_unit}}</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>      
            <div class="modal-body">
                <div class="row pd-20">
                    <div class="col mx-2">
                        <div class="row">
                            <table>
                                <tr>
                                    <td>Anggaran</td>
                                    <td>:</td>
                                    <td style="text-align:right;">{{ number_format($item->anggaran,2,',','.') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col mx-2">
                        <div class="row">
                            <table>
                                <tr>
                                    <td>Draft</td>
                                    <td>:</td>
                                    <td style="text-align:right;">{{ number_format($item->draft,2,',','.') }}</td>
                                </tr>
                                <tr>
                                    <td>Outstanding</td>
                                    <td>:</td>
                                    <td style="text-align:right;">{{ number_format($item->outstand,2,',','.') }}</td>
                                </tr>
                                <tr>
                                    <td>Realisasi</td>
                                    <td>:</td>
                                    <td style="text-align:right;">{{ number_format($item->realisasi,2,',','.') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div> 
                </div>                                
            </div>
        </div>
    </div>
</div>
@endforeach
@foreach($total as $item)
<div class="modal" tabindex="-1" id="modalTable{{$item->kdsatker}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6>Total Satker</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>      
            <div class="modal-body">
                <div class="row pd-20">
                    <div class="col mx-2">
                        <div class="row">
                            <table>
                                <tr>
                                    <td>Anggaran</td>
                                    <td>:</td>
                                    <td style="text-align:right;">{{ number_format($item->anggaran,2,',','.') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col mx-2">
                        <div class="row">
                            <table>
                                <tr>
                                    <td>Draft</td>
                                    <td>:</td>
                                    <td style="text-align:right;">{{ number_format($item->draft,2,',','.') }}</td>
                                </tr>
                                <tr>
                                    <td>Outstanding</td>
                                    <td>:</td>
                                    <td style="text-align:right;">{{ number_format($item->outstand,2,',','.') }}</td>
                                </tr>
                                <tr>
                                    <td>Realisasi</td>
                                    <td>:</td>
                                    <td style="text-align:right;">{{ number_format($item->realisasi,2,',','.') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div> 
                </div>
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
