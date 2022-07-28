<!--fungsi cari barang transaksi penjualan-->

function caribarang(position){
    $.ajax({
        url: 'barang.php',
        method: 'POST',
        data:{
            namaBarang: $('#search_barang').val(),
			kode: "caribarang"
        },
        success: function (data) {
            $('#render-hasil-pencarian').html(data);
        }
    });
}

function pilihbarang(position, nominal){
	var $kodeBarang = position;
	var $jumlahBarang = nominal;
	$.ajax({
		url: 'barang.php',
		method: 'POST',
		data:{
			id_barang: $kodeBarang,
			kode: "tampilbarang"
		},
		success: function(data){
			var $json_parse = JSON.parse(data);
			$.each($json_parse, function(i){
				$('#render-data-table').append('<tr>' +
					'<td><input type="text" class="form-control" name="id_barang[]" value="'+$json_parse[i].id_barang+'" readonly></td>' +
					'<td>'+$json_parse[i].nama_barang+'</td>' +
					'<td><input type="text" class="form-control" id="harga" name="harga_jual[]" value="'+$json_parse[i].harga_jual+'"></td>' +
					'<td><input type="text" name="jumlah[]" class="form-control" value="'+parseInt($jumlahBarang)+'" onkeyup="jumlah(this)"></td>'+
					'<td>'+$json_parse[i].id_satuan+'</td>' +
					'<td><input type="text" class="form-control" id="subtotal" name="subtotal_harga[]" value="'+(parseInt($json_parse[i].harga_jual) * parseInt($jumlahBarang))+'" readonly></td>'+
					'<td><button type=\'button\' class=\'btn btn-danger btn-sm\' onclick=\'batal(this)\'>Batal</button></td>' +
					'</tr>');
				$('#totalHarga').val(parseInt($('#totalHarga').val()) + (parseInt($json_parse[i].harga_jual) * parseInt($jumlahBarang)));
			});
		}

	});
    $('#modal-search').modal('hide');
}

<!--fungsi cari pembeli-->

function caripembeli(position){
	$.ajax({
		url: 'pelanggan.php',
		method: 'POST',
		data:{
			namaPembeli: $('#search_pembeli').val(),
			kode: "caripembeli"
		},
		success: function (data) {
			$('#pencarian-pembeli').html(data);
		}
	});
}

function pilihpembeli(position){
	var $kodePembeli = $(position).closest("tr").find("#kodePembeli").html();
	$.ajax({
		url: 'pelanggan.php',
		method: 'POST',
		data:{
			id_pembeli: $kodePembeli,
			kode: "tampilpembeli"
		},
		success: function(data){
			var $json_parse = JSON.parse(data);
			$.each($json_parse, function(i){
				$('#nama-pelanggan').val($json_parse[i].nama_pembeli);
				$('#id_pembeli1').val($json_parse[i].id_pembeli);
			});
		}
	});
	$('#cari-pelanggan').modal('hide');
}

<!--fungsi subtotal-->

function jumlah(position){
	var $nominal = $(position).val();
	var	$harga = $(position).closest('tr').find('#harga').val();
	var $hargabaru = $harga*$nominal;
	$(position).closest("tr").find("#subtotal").val($hargabaru);
	var $sum = 0;
	$('#render-data-table #subtotal').each(function(){
		$sum += parseInt($(this).val());
	});
	$('#totalHarga').val($sum);
}

function batal(position){
	$(position).closest("tr").remove();
	var $sum = 0;
	$('#render-data-table #subtotal').each(function(){
		$sum += parseInt($(this).html());
		console.log($sum);
	});
	$('#totalHarga').val($sum);
	$('#uangBayar').val($sum);
	$('#uangKembali').val($sum);
}

<!--fungsi ambil barang-->

function getallbarang(){
	$.ajax({
		url: 'aksibarang.php',
		method: 'POST',
		data:{
			kode: "ambilbarang"
		},
		success: function(data){
			console.log(data);
			var $json_parse = JSON.parse(data);
			$.each($json_parse, function(i){
				$('#render-data-table').append('<tr>' +
					'<td id="locationIDBarang">'+$json_parse[i].id_barang+'</td>' +
					'<td>'+$json_parse[i].nama_jenis_barang+'<span style="display: none;" id="locationJenisBarang">'+$json_parse[i].id_jenis_barang+'</span></td>' +
					'<td>'+$json_parse[i].nama_distributor+'<span style="display: none;" id="locationDistributor">'+$json_parse[i].id_distributor+'</span></td>' +
					'<td>'+$json_parse[i].satuan+'<span style="display: none;" id="locationSatuan">'+$json_parse[i].id_satuan+'</span></td>' +
					'<td id="locationJumlahPcs">'+$json_parse[i].jumlah_pcs+'</td>' +
					'<td id="locationNamaBarang">'+$json_parse[i].nama_barang+'</td>' +
					'<td id="locationStokAwal">'+$json_parse[i].stok_awal+'</td>' +
					'<td id="locationStokAkhir">'+$json_parse[i].stok_akhir+'</td>' +
					'<td id="locationKeuntungan">'+$json_parse[i].keuntungan+'</td>' +
					'<td><center><button type=\'button\' class=\'btn btn-primary btn-sm\' onclick=\'edit(this)\'>Edit</button> ' +
					' <button type=\'button\' class=\'btn btn-primary btn-sm\' onclick=hapus(this)>Hapus</button></center></td>' +
					'</tr>');
			});
		}
	});
}

function searchbarang(position, data){
	$.ajax({
		url: 'aksibarang.php',
		method: 'POST',
		data:{
			namaBarang: data,
			kode: "searchbarang"
		},
		success: function (data) {
			$('#render-data-table').html(data);
		}
	});
}

<!--fungsi ambil jenis barang-->

function getalljenisbarang(){
	$.ajax({
		url: 'aksijenisbarang.php',
		method: 'POST',
		data:{
			kode: "ambiljenisbarang"
		},
		success: function(data){
			console.log(data);
			var $json_parse = JSON.parse(data);
			$.each($json_parse, function(i){
				$('#render-data-table').append('<tr>' +
					'<td id="locationIDJenisBarang">'+$json_parse[i].id_jenis_barang+'</td>' +
					'<td id="locationNamaJenis">'+$json_parse[i].nama_jenis+'</td>' +
					'<td><center><button type=\'button\' class=\'btn btn-primary btn-sm\' onclick=\'edit(this)\'>Edit</button> ' +
					' <button type=\'button\' class=\'btn btn-primary btn-sm\' onclick=hapus(this)>Hapus</button></center></td>' +
					'</tr>');
			});
		}
	});
}

function searchjenisbarang(position, data){
	$.ajax({
		url: 'aksijenisbarang.php',
		method: 'POST',
		data:{
			namaJenis: data,
			kode: "searchjenisbarang"
		},
		success: function (data) {
			$('#render-data-table').html(data);
		}
	});
}


<!--fungsi ambil distributor-->

function getalldistributor(){
	$.ajax({
		url: 'aksidistributor.php',
		method: 'POST',
		data:{
			kode: "ambildistributor"
		},
		success: function(data){
			console.log(data);
			var $json_parse = JSON.parse(data);
			$.each($json_parse, function(i){
				$('#render-data-table').append('<tr>' +
					'<td id="locationIDDistributor">'+$json_parse[i].id_distributor+'</td>' +
					'<td>'+$json_parse[i].nama_kota+'<span style="display: none;" id="locationNamaKota">'+$json_parse[i].id_kota+'</span></td>' +
					'<td id="locationNamaDistributor">'+$json_parse[i].nama_distributor+'</td>' +
					'<td id="locationAlamatDistributor">'+$json_parse[i].alamat_distributor+'</td>' +
					'<td id="locationTeleponDistributor">'+$json_parse[i].telepon_distributor+'</td>' +
					'<td id="locationEmailDistributor">'+$json_parse[i].email_distributor+'</td>' +
					'<td id="locationKontak">'+$json_parse[i].kontak+'</td>' +
					'<td><center><button type=\'button\' class=\'btn btn-primary btn-sm\' onclick=\'edit(this)\'>Edit</button> ' +
					' <button type=\'button\' class=\'btn btn-primary btn-sm\' onclick=hapus(this)>Hapus</button></center></td>' +
					'</tr>');
			});
		}
	});
}

function searchdistributor(position, data){
	$.ajax({
		url: 'aksidistributor.php',
		method: 'POST',
		data:{
			namaDistributor: data,
			kode: "searchdistributor"
		},
		success: function (data) {
			$('#render-data-table').html(data);
		}
	});
}

<!--fungsi ambil pegawai-->

function getallpegawai(){
	$.ajax({
		url: 'aksipegawai.php',
		method: 'POST',
		data:{
			kode: "ambilpegawai"
		},
		success: function(data){
			console.log(data);
			var $json_parse = JSON.parse(data);
			$.each($json_parse, function(i){
				$('#render-data-table').append('<tr>' +
					'<td id="locationIDPegawai">'+$json_parse[i].id_pegawai+'</td>' +
					'<td>'+$json_parse[i].nama_kota+'<span style="display: none;" id="locationNamaKota">'+$json_parse[i].id_kota+'</span></td>' +
					'<td>'+$json_parse[i].nama_otoritas+'<span style="display: none;" id="locationNamaOtoritas">'+$json_parse[i].id_otoritas+'</span></td>' +
					'<td>'+$json_parse[i].nama_jabatan+'<span style="display: none;" id="locationNamaJabatan">'+$json_parse[i].id_jabatan+'</span></td>' +
					'<td id="locationNamaPegawai">'+$json_parse[i].nama_pegawai+'</td>' +
					'<td id="locationAlamatPegawai">'+$json_parse[i].alamat_pegawai+'</td>' +
					'<td id="locationTeleponPegawai">'+$json_parse[i].telepon_pegawai+'</td>' +
					'<td id="locationEmailPegawai">'+$json_parse[i].email_pegawai+'</td>' +
					'<td id="locationUsernamePegawai">'+$json_parse[i].username_pegawai+'</td>' +
					'<td id="locationPasswordPegawai">'+$json_parse[i].password_pegawai+'</td>' +
					'<td><center><button type=\'button\' class=\'btn btn-primary btn-sm\' onclick=\'edit(this)\'>Edit</button> ' +
					' <button type=\'button\' class=\'btn btn-primary btn-sm\' onclick=hapus(this)>Hapus</button></center></td>' +
					'</tr>');
			});
		}
	});
}

function searchpegawai(position, data){
	$.ajax({
		url: 'aksipegawai.php',
		method: 'POST',
		data:{
			namaPegawai: data,
			kode: "searchpegawai"
		},
		success: function (data) {
			$('#render-data-table').html(data);
		}
	});
}

<!--fungsi ambil otoritas-->

function getallotoritas(){
	$.ajax({
		url: 'aksiotoritas.php',
		method: 'POST',
		data:{
			kode: "ambilotoritas"
		},
		success: function(data){
			console.log(data);
			var $json_parse = JSON.parse(data);
			$.each($json_parse, function(i){
				$('#render-data-table').append('<tr>' +
					'<td id="locationIDOtoritas">'+$json_parse[i].id_otoritas+'</td>' +
					'<td id="locationNamaOtoritas">'+$json_parse[i].nama_otoritas+'</td>' +
					'<td><center><button type=\'button\' class=\'btn btn-primary btn-sm\' onclick=\'edit(this)\'>Edit</button> ' +
					' <button type=\'button\' class=\'btn btn-primary btn-sm\' onclick=hapus(this)>Hapus</button></center></td>' +
					'</tr>');
			});
		}
	});
}

function searchotoritas(position, data){
	$.ajax({
		url: 'aksiotoritas.php',
		method: 'POST',
		data:{
			namaOtoritas: data,
			kode: "searchotoritas"
		},
		success: function (data) {
			$('#render-data-table').html(data);
		}
	});
}

<!--fungsi ambil jabatan-->

function getalljabatan(){
	$.ajax({
		url: 'aksijabatan.php',
		method: 'POST',
		data:{
			kode: "ambiljabatan"
		},
		success: function(data){
			console.log(data);
			var $json_parse = JSON.parse(data);
			$.each($json_parse, function(i){
				$('#render-data-table').append('<tr>' +
					'<td id="locationIDJabatan">'+$json_parse[i].id_jabatan+'</td>' +
					'<td id="locationNamaJabatan">'+$json_parse[i].nama_jabatan+'</td>' +
					'<td><center><button type=\'button\' class=\'btn btn-primary btn-sm\' onclick=\'edit(this)\'>Edit</button> ' +
					' <button type=\'button\' class=\'btn btn-primary btn-sm\' onclick=hapus(this)>Hapus</button></center></td>' +
					'</tr>');
			});
		}
	});
}

function searchjabatan(position, data){
	$.ajax({
		url: 'aksijabatan.php',
		method: 'POST',
		data:{
			namaJabatan: data,
			kode: "searchjabatan"
		},
		success: function (data) {
			$('#render-data-table').html(data);
		}
	});
}

<!--fungsi ambil satuan-->

function getallsatuan(){
	$.ajax({
		url: 'aksisatuan.php',
		method: 'POST',
		data:{
			kode: "ambilsatuan"
		},
		success: function(data){
			console.log(data);
			var $json_parse = JSON.parse(data);
			$.each($json_parse, function(i){
				$('#render-data-table').append('<tr>' +
					'<td id="locationIDSatuan">'+$json_parse[i].id_satuan+'</td>' +
					'<td id="locationNamaSatuan">'+$json_parse[i].nama_satuan+'</td>' +
					'<td><center><button type=\'button\' class=\'btn btn-primary btn-sm\' onclick=\'edit(this)\'>Edit</button>  ' +
					' <button type=\'button\' class=\'btn btn-primary btn-sm\' onclick=hapus(this)>Hapus</button></center></td>' +
					'</tr>');
			});
		}
	});
}

function searchsatuan(position, data){
	$.ajax({
		url: 'aksisatuan.php',
		method: 'POST',
		data:{
			namaSatuan: data,
			kode: "searchsatuan"
		},
		success: function (data) {
			$('#render-data-table').html(data);
		}
	});
}

<!--fungsi ambil kota-->

function getallkota(){
	$.ajax({
		url: 'aksikota.php',
		method: 'POST',
		data:{
			kode: "ambilkota"
		},
		success: function(data){
			console.log(data);
			var $json_parse = JSON.parse(data);
			$.each($json_parse, function(i){
				$('#render-data-table').append('<tr>' +
					'<td id="locationIDKota">'+$json_parse[i].id_kota+'</td>' +
					'<td>'+$json_parse[i].nama_provinsi+'<span style="display: none;" id="locationNamaProvinsi">'+$json_parse[i].id_provinsi+'</span></td>' +
					'<td id="locationNamaKota">'+$json_parse[i].nama_kota+'</td>' +
					'<td><center><button type=\'button\' class=\'btn btn-primary btn-sm\' onclick=\'edit(this)\'>Edit</button> ' +
					' <button type=\'button\' class=\'btn btn-primary btn-sm\' onclick=hapus(this)>Hapus</button></center></td>' +
					'</tr>');
			});
		}
	});
}

function searchkota(position, data){
	$.ajax({
		url: 'aksikota.php',
		method: 'POST',
		data:{
			namaKota: data,
			kode: "searchkota"
		},
		success: function (data) {
			$('#render-data-table').html(data);
		}
	});
}

<!--fungsi ambil provinsi-->

function getallprovinsi(){
	$.ajax({
		url: 'aksiprovinsi.php',
		method: 'POST',
		data:{
			kode: "ambilprovinsi"
		},
		success: function(data){
			console.log(data);
			var $json_parse = JSON.parse(data);
			$.each($json_parse, function(i){
				$('#render-data-table').append('<tr>' +
					'<td id="locationIDProvinsi">'+$json_parse[i].id_provinsi+'</td>' +
					'<td id="locationNamaProvinsi">'+$json_parse[i].nama_provinsi+'</td>' +
					'<td><center><button type=\'button\' class=\'btn btn-primary btn-sm\' onclick=\'edit(this)\'>Edit</button> ' +
					' <button type=\'button\' class=\'btn btn-primary btn-sm\' onclick=hapus(this)>Hapus</button></center></td>' +
					'</tr>');
			});
		}
	});
}

function searchprovinsi(position, data){
	$.ajax({
		url: 'aksiprovinsi.php',
		method: 'POST',
		data:{
			namaProvinsi: data,
			kode: "searchprovinsi"
		},
		success: function (data) {
			$('#render-data-table').html(data);
		}
	});
}

//fungsi lihat detail laporan penjualan
function lihatpenjualan(position){
	$.ajax({
		url: 'detillappenjualan.php',
		method: 'POST',
		data:{

		},
		success: function (data) {
			$('#render-detil-penjualan').html(data);
		}
	});
}

//pilih barang yg mau dipesan yg nanti muncul di atas tabel
function pilihbarangkritis(position){
	var $kodeBarang = $(position).closest("tr").find("#kodeBarang").html();
	$.ajax({
		url: 'stokkritis.php',
		method: 'POST',
		data:{
			id_barang: $kodeBarang,
			kode: "tampilbarangkritis"
		},
		success: function(data){
			var $json_parse = JSON.parse(data);
			$.each($json_parse, function(i){
				$('#id_barang').val($json_parse[i].id_barang),
				$('#nama_barang').val($json_parse[i].nama_barang);
			});
		}
	});
	$('#cari-barang-kritis').modal('hide');
}

//tambah data pesan yang muncul di tabel bawah outputnya pda halaman pemesanan
function tambahpesanan(position){
	if($('#nama_barang').val() === "" || $('#jumlah_pesan').val() === "")
	{
		alert(" pemesanan kosong");
	}
	else
	{
		var $kodeBarang = $(position).closest("tr").find("#kodeBarang").html();
		$('#render-data-table').append('<tr>' +
			'<td>'+$('#id_barang').val()+'<input type="hidden" value="'+$('#id_barang').val()+'" name="id_barang[]"></td>' +
			'<td>'+$('#nama_barang').val()+'</td>' +
			'<td>'+$('#jumlah_pesan').val()+'<input type="hidden" value="'+$('#jumlah_pesan').val()+'" name="jumlah_pesan[]"></td>' +
			'<td><button type=\'button\' class=\'btn btn-danger btn-sm\' onclick=\'batal(this)\'>Batal</button></td>' +
			'</tr>');
		$('#form-pesanan').find('#id_barang').val('');
		$('#form-pesanan').find('#nama_barang').val('');
		$('#form-pesanan').find('#jumlah_pesan').val('');
	}
}

//pilih pemesanan dihalaman penerimaan yang outputnya tampil di tabel bawahnya
function pilihpemesanan(position){
	var $kodePesan = $(position).closest("tr").find("#kodePesan").html();
	$.ajax({
		url: 'pemesanan.php',
		method: 'POST',
		data:{
			no_pemesanan: $kodePesan,
			kode: "tampilpesanan"
		},
		success: function(data){
			$('#render-data-table').html('');
			$json_parse = JSON.parse(data);
			$('#no_pemesanan').val($json_parse[0].no_pemesanan);
			$('#nama_distributor').val($json_parse[0].nama_distributor);
			$.each($json_parse, function(i){
				$('#render-data-table').append('<tr>' +
					'<td id="locationIDBarang">'+$json_parse[i].id_barang+'<input type="hidden" name="id_barang[]" value="'+$json_parse[i].id_barang+'"></td>' +
					'<td id="locationNamaBarang"><input type="hidden" name="nama_barang[]" value="'+$json_parse[i].nama_barang+'"> '+$json_parse[i].nama_barang+'</td>' +
					'<td id="locationJumlahPesan"><input type="hidden" name="jumlah_pesan[]" value="'+$json_parse[i].jumlah_pesan+'"> '+$json_parse[i].jumlah_pesan+'</td>' +
					'<td id="locationJumlahTerima"><input type="text" class="form-control" name="jumlah_terima[]" onkeyup="checkJumlahTerima(this)"></td>' +
					'<td id="locationHargaBeli"><input type="text" class="form-control" onkeyup="total(this)" name="harga_beli[]"></td>' +
					'<td id="locationDiskonSpesial"><input type="text" value="0" class="form-control" name="diskon_spesial[]"></td>' +
					'<td id="locationDiskonPromosi"><input type="text" value="0" class="form-control" name="diskon_promosi[]"></td>' +
					'</tr>');
			});
		}
	});
	$('#cari-pemesanan').modal('hide');
}

//pilih barang yg akan di retur pda popup
function pilihbarangterima(position){
	var $NoTerimaBarang = $(position).closest("tr").find("#NoTerimaBarang").html();
	var $IDBarang = $(position).closest("tr").find("#IDBarang").html();
	$.ajax({
		url: 'inputretur.php',
		method: 'POST',
		data:{
			no_terima_barang: $NoTerimaBarang,
			id_barang: $IDBarang,
			kode: "tampilretur"
		},
		success: function(data){
			var $json_parse = JSON.parse(data);
			$.each($json_parse, function(i){
				$('#no_terima_barang').val($json_parse[i].no_terima_barang),
				$('#id_barang').val($json_parse[i].id_barang),
				$('#nama_barang').val($json_parse[i].nama_barang);
			});
		}
	});
	$('#cari-penerimaan').modal('hide');
}

//tambah retur yang muncul di tabel bawah
function tambahretur(position){
	var $kodeBarang = $(position).closest("tr").find("#kodeBarang").html();
	$('#render-data-table').append('<tr>' +
		'<td>'+$('#id_barang').val()+'<input type="hidden" value="'+$('#id_barang').val()+'" name="id_barang[]"></td>' +
		'<td>'+$('#nama_barang').val()+'</td>' +
		'<td>'+$('#jumlah_retur').val()+'<input type="hidden" value="'+$('#jumlah_retur').val()+'" name="jumlah_retur[]"></td>' +
		'<td>'+$('#harga_retur').val()+'<input type="hidden" value="'+$('#harga_retur').val()+'" name="harga_retur[]"></td>' +
		'<td><button type=\'button\' class=\'btn btn-danger btn-sm\' onclick=\'batal(this)\'>Batal</button></td>' +
		'</tr>');
	$('#form-retur').find('#id_barang').val('');
	$('#form-retur').find('#nama_barang').val('');
	$('#form-retur').find('#jumlah_retur').val('');
	$('#form-retur').find('#harga_retur').val('');
}

//hitung total penerimaan
function total(position){

	var	$harga_beli = $(position).closest('tr').find('#harga_beli').val();
	var	$diskon_spesial = $(position).closest('tr').find('#diskon_spesial').val();
	var $diskon_promosi = $(position).closest('tr').find('#diskon_promosi').val();
	//$(position).closest("tr").find("#subtotal").val($hargabaru);
	var $sum = 0;
	$('input[name="harga_beli[]"]').each(function(){
		$sum += parseInt($(this).val());
	});
	$('#total_pesan').val($sum);
}

//pilih penerimaan retur di popup
function pilihterimaretur(position){
	var $NoRetur = $(position).closest("tr").find("#NoRetur").html();
	$.ajax({
		url: 'terimaretur.php',
		method: 'POST',
		data:{
			no_retur: $NoRetur,
			kode: "tampilterimaretur"
		},
		success: function(data){
			$json_parse = JSON.parse(data);
			$('#no_retur').val($json_parse[0].no_retur);
			$.each($json_parse, function(i){
				$('#render-data-table').append('<tr>' +
					'<td id="locationIDBarang">'+$json_parse[i].id_barang+'<input type="hidden" name="id_barang[]" value="'+$json_parse[i].id_barang+'"></td>' +
					'<td id="locationNamaBarang">'+$json_parse[i].nama_barang+'</td>' +
					'<td id="locationJumlahRetur">'+$json_parse[i].jumlah_retur+'</td>' +
					'<td id="locationJumlahTerima"><input type="text" class="form-control" name="jumlah_terima[]"></td>' +
					'</tr>');
			});
		}
	});
	$('#cari-retur').modal('hide');
}

