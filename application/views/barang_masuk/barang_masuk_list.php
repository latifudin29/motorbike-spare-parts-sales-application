<table class="table table-bordered" style="margin-bottom: 10px">
    <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Merk</th>
        <th>Nama Supplier</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
        <th>Tanggal</th>
    </tr>
    <?php
    $no = 1;
    foreach ($barang_masuk_data as $barang_masuk) {
    ?>
    <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $barang_masuk->nama_barang ?></td>
        <td><?php echo $barang_masuk->merk_barang ?></td>
        <td><?php echo $barang_masuk->nama_supplier ?></td>
        <td><?php echo $barang_masuk->jumlah ?></td>
        <td>Rp. <?php echo number_format($barang_masuk->subtotal) ?></td>
        <td><?php echo $barang_masuk->tgl_masuk ?></td>
    </tr>
    <?php } ?>
</table>
<br>
<a href="<?php echo site_url('barang_masuk/print'); ?>" class="btn btn-default">Print Laporan</a>