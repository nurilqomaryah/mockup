@extends('layouts.crud') 
@section('main')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Pegawai</h6>
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

                <div class="pd-20">
                    <div class="table-responsive-lg">
                        <div class="table-wrapper">

                            {{ csrf_field() }}
                            <table id="tbl-identifikasi" class="table display">
                                <thead align="center">
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th width="20%" style="text-align: center;">NIP</th>
                                        <th width="22%" >Nama Pegawai</th>
                                        <th>Bidang/Bagian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; ?>
                                    @foreach($listPegawai as $item)
                                    <tr>
                                        <td width="5%">{{$no++}}</td>
                                        <td width="20%" style="text-align: center;">{{$item->nip}}</td>
                                        <td width="22%" >{{$item->nama}}</td>
                                        <td>{{$item->nama_unit}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>                    
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
    
@endsection
