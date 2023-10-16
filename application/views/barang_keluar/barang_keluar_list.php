<table class="table table-bordered" style="margin-bottom: 10px">
    <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Nama Pelanggan</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
        <th>Tanggal</th>
    </tr>
    <?php
    $no = 1;
    foreach ($barang_keluar_data as $barang_keluar) {
    ?>
    <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $barang_keluar->nama_barang ?></td>
        <td><?php echo $barang_keluar->pelanggan ?></td>
        <td><?php echo $barang_keluar->jumlah ?></td>
        <td>Rp. <?php echo number_format($barang_keluar->subtotal) ?></td>
        <td><?php echo $barang_keluar->tgl_keluar ?></td>
    </tr>
    <?php } ?>
</table>
<br>
<a href="<?php echo site_url('barang_keluar/print'); ?>" class="btn btn-default">Print Laporan</a>
