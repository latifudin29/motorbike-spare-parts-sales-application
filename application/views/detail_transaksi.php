<?php 
$rs = $data->row();
?>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<tr>
				<th>Kode Transaksi</th>
				<th>:</th>
				<td><?php echo $rs->kode_transaksi; ?></td>
				<th>Tgl Pemesanan</th>
				<th>:</th>
				<td><?php echo $rs->tgl_transaksi; ?></td>
			</tr>
			<tr>
				<th>Total Harga</th>
				<th>:</th>
				<td>Rp. <?php echo number_format($rs->total_harga); ?></td>
				<th>Keterangan</th>
				<th>:</th>
				<?php if ($rs->keterangan == 'waiting') { ?>
				<td>Belum dibayar</td>
				<?php } else if ($rs->keterangan == 'paid') { ?>
				<td>Sudah dibayar</td>
				<?php } else if ($rs->keterangan == 'succeed') { ?>
				<td>Transaksi Berhasil</td>
				<?php } ?>
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
					<th>Harga Satuan</th>
					<th>Jumlah</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$sql = $this->db->query("SELECT * FROM detail_transaksi as a,barang as b where a.kode_barang=b.kode_barang and a.kode_transaksi='$rs->kode_transaksi' ");
				$no = 1;
				foreach ($sql->result() as $row) {
				?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $row->kode_barang; ?></td>
					<td><?php echo $row->nama_barang; ?></td>
					<td><?php echo $row->harga; ?></td>
					<td><?php echo $row->qty; ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php if ($this->session->userdata('level') == 'admin' && $rs->keterangan == 'waiting') { ?>
		<a href="transaction/pembayaran/<?php echo $row->kode_transaksi ?>" class="btn btn-info btn-sm">Pembayaran</a>
		<?php } else if ($this->session->userdata('level') == 'supplier' && $rs->keterangan == 'paid') { ?>
		<a href="<?= site_url('proses_pesanan/konfirmasi/'.$rs->id_transaksi) ?>" class="btn btn-info btn-sm">Konfirmasi</a>
		<?php } ?>
	</div>
</div>