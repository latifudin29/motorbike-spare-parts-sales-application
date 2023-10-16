<div class="row">
	<div class="col-md-4">
		<a href="transaction/tambah_transaksi" class="btn btn-primary">Tambah Transaksi</a>
	</div>
	<div class="col-md-4"></div>
	<div class="col-md-4"></div><br><br><br>
	<div class="col-md-12">
		<table class="table table-bordered" style="margin-bottom: 10px" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Kode Transaksi</th>
					<th>Tanggal Transaksi</th>
					<th>Total Bayar</th>
					<th>Pilihan</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$sql = $this->db->query("SELECT * FROM transaksi order by id_transaksi DESC");
				$no = 1;
				foreach ($sql->result() as $row) {
				?>
				<tr>
					<?php if ($row->keterangan != 'succeed') { ?>
					<td><?php echo $no++; ?></td>
					<td><?php echo $row->kode_transaksi; ?></td>
					<td><?php echo $row->tgl_transaksi; ?></td>
					<td><?php echo number_format($row->total_harga); ?></td>
					<td>
						<a href="transaction/detail_transaksi/<?php echo $row->kode_transaksi ?>" class="btn btn-info btn-sm">detail</a>
						<a href="transaction/hapus_transaksi/<?php echo $row->kode_transaksi ?>" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm('Are You Sure ?')">hapus</a>
						<!-- <a href="transaction/cetak_transaksi/<?php echo $row->kode_transaksi ?>" target="_blank" class="btn btn-success btn-sm">cetak</a> -->
					</td>
					<?php } ?>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>