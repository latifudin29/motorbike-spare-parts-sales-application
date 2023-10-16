<div class="row">
    <div class="col-md-4">
		<a href="customer/tambah_pembelian" class="btn btn-primary">Tambah Pembelian</a>
	</div>
    <br>
	<div class="col-md-4"></div>
	<div class="col-md-4"></div><br><br>
	<div class="col-md-12">
		<table class="table table-bordered" style="margin-bottom: 10px" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Kode Beli</th>
					<th>Pelanggan</th>
					<th>Tanggal Pembelian</th>
					<th>Total Bayar</th>
					<th>Pilihan</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$id = $this->session->userdata('id_user');
				$sql = $this->db->query("SELECT * FROM pembelian as t, detail_beli as d, barang as b where t.kode_beli=d.kode_beli and d.kode_barang=b.kode_barang group by t.kode_beli order by t.kode_beli");
				$no = 1;
				foreach ($sql->result() as $row) {
				?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $row->kode_beli; ?></td>
					<td><?php echo $row->pelanggan; ?></td>
					<td><?php echo $row->tgl_beli; ?></td>
					<td>Rp.<?php echo number_format($row->total_harga); ?></td>
					<td>
						<a href="customer/detail_pembelian/<?php echo $row->kode_beli?>" class="btn btn-info btn-sm">detail</a>
						<a href="customer/hapus_pembelian/<?php echo $row->kode_beli ?>" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm('Are You Sure ?')">hapus</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>