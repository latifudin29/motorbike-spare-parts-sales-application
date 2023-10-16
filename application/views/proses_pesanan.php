<form action="<?php echo $action; ?>" method="post">
    <input type="hidden" name="id_transaksi" value="<?php echo $id_transaksi; ?>" />  
    <input type="hidden" name="kode_transaksi" value="<?php echo $kode_transaksi; ?>" /> 
    <input type="hidden" name="tgl_transaksi" value="<?php echo $tgl_transaksi; ?>" /> 
    <input type="hidden" name="total_harga" value="<?php echo $total_harga; ?>" /> 
    <input type="hidden" name="bukti_tf" value="<?php echo $bukti_tf; ?>" /> 
    <div class="form-group">
        <label for="varchar">Keterangan</label>
        <select class="form-control" name="keterangan" id="keterangan">
            <option>Pilih</option>
            <option value="succeed">Sudah diproses</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
    <a href="<?php echo site_url('supplier/pesanan') ?>" class="btn btn-default">Cancel</a>
</form>