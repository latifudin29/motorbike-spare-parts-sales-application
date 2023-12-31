<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo base_url() ?>">
	<title>Cetak Struk transaksi</title>
	<link rel="stylesheet" type="text/css" href="assets/bootflat-admin/css/bootstrap.min.css">
</head>
<body >
	<div class="container">
	<center>
		<h4>BENGKEL MOTOR</h4>
		<p>Jl. Moh. Toha, leuwi panjang, Cigelereng, Bandung City, West Java 40243</p>
		<p>Telp. 0812-1441-6869</p>
	</center>
	<?php 
	$rs = $data->row();
	?>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<tr>
					<th>Kode transaksi</th>
					<th>:</th>
					<td><?php echo $rs->kode_transaksi; ?></td>
				</tr>
				<tr>
					<th>Tgl transaksi</th>
					<th>:</th>
					<td><?php echo $rs->tgl_transaksi; ?></td>
					<th>Total Harga</th>
					<th>:</th>
					<td>Rp. <?php echo number_format($rs->total_harga); ?></td>
				</tr>
			</table>
		</div>
		<div class="col-md-12">
			<table class="table table-bordered" style="margin-bottom: 10px" >
				<thead>
					<tr>
						<th>No.</th>
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>Supplier</th>
						<th>Qty</th>
						<th>Harga</th>
						<th>Jumlah</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$sql = $this->db->query("SELECT * FROM detail_transaksi as a, barang as b, where a.kode_barang=b.kode_barang and a.kode_transaksi=$rs->kode_transaksi ");
					$no = 1;
					foreach ($sql->result() as $row) {
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $row->kode_barang; ?></td>
						<td><?php echo $row->nama_barang; ?></td>
						<td><?php echo $row->nama_supplier; ?></td>
						<td><?php echo $row->qty; ?></td>
						<td><?php echo $row->harga; ?></td>
						<td><?php 
						$totharga = $row->qty*$row->harga;
						echo number_format($totharga);
						?></td>
					</tr>
					<?php } ?>
					<tr>
						<td colspan="6">Total</td>
						<td>Rp. <?php echo number_format($rs->total_harga) ?></td>
					</tr>
				</tbody>
			</table>

			<div style="text-align: right;">
				<p>Bandung, <?php echo date('d/m/Y') ?></p>
				<br><br><br><br><br>
				<p>West Java</p>
			</div>
		</div>
	</div>
</div>

<script src='assets/jspdf.debug.js'></script>
<script src='assets/html2pdf.js'></script>
<script>
	var pdf = new jsPDF('l', 'pt', 'A4');
	var canvas = pdf.canvas;
	var width = 1200;
	//canvas.width=8.5*72;
	document.body.style.width=width + "px";

	html2canvas(document.body, {
		canvas:canvas,
		onrendered: function(canvas) {
			var iframe = document.createElement('iframe');
			iframe.setAttribute('style', 'position:absolute;top:0;right:0;height:100%; width:100%');
			document.body.appendChild(iframe);
			iframe.src = pdf.output('datauristring');

			//var div = document.createElement('pre');
			//div.innerText=pdf.output();
			//document.body.appendChild(div);
		}
	});
</script>

</body>
</html>