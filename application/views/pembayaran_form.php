<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Kode Transaksi </label>
        <input type="text" class="form-control" name="kode_transaksi" id="kode_transaksi" value="<?php echo $kode_transaksi; ?>" />
    </div>
    <div class="form-group">
        <label>Tanggal </label>
        <input type="text" class="form-control" name="tgl_transaksi" id="tgl_transaksi" value="<?php echo $tgl_transaksi; ?>" />
    </div>
    <div class="form-group">
        <label>Total Harga </label>
        <input type="text" class="form-control" name="total_harga" id="total_harga" value="<?php echo $total_harga; ?>" />
    </div>
    <div class="form-group">
        <label for="int">Foto Bukti </label>
        <input type="file" class="form-control" name="bukti_tf" id="bukti_tf" value="<?php echo $bukti_tf; ?>" />
    </div>
    <div class="form-group">
        <input type="hidden" class="form-control" name="keterangan" id="keterangan" value="paid" />
    </div>
    <input type="hidden" name="id_transaksi" value="<?php echo $id_transaksi; ?>" /> 
    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
</form>