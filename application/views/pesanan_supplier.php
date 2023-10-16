<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4"></div><br><br>
	<div class="col-md-12">
		<table class="table table-bordered" style="margin-bottom: 10px" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Kode Transaksi</th>
					<th>Tanggal Transaksi</th>
					<th>Total Bayar</th>
					<th>Total Bayar</th>
					<th>Pilihan</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$id = $this->session->userdata('id_user');
				$kode = $this->session->userdata('kode');
				$no = 1;
				foreach ($data->result() as $row) {
				?>
				<tr>
					<?php if ($row->keterangan == 'paid' && $row->kode_supplier == $kode) { ?>
						<td><?php echo $no++; ?></td>
						<td><?php echo $row->kode_transaksi; ?></td>
						<td><?php echo $row->tgl_transaksi; ?></td>
						<td><?php echo $row->qty; ?></td>
						<td>Rp. <?php echo number_format($row->total_harga); ?></td>
						<td>
							<a href="transaction/detail_transaksi/<?php echo $row->kode_transaksi ?>" class="btn btn-info btn-sm">detail</a>
						</td>
                    <?php } ?>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>