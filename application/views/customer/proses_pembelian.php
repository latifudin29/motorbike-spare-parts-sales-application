<form action="<?php echo $action; ?>" method="post">
    <input type="hidden" name="id_beli" value="<?php echo $id_beli; ?>" />  
    <input type="hidden" name="kode_beli" value="<?php echo $kode_beli; ?>" /> 
    <input type="hidden" name="tgl_beli" value="<?php echo $tgl_beli; ?>" /> 
    <input type="hidden" name="total_harga" value="<?php echo $total_harga; ?>" />
    <div class="form-group">
        <label for="varchar">Keterangan</label>
        <select class="form-control" name="keterangan" id="keterangan">
            <option>Pilih</option>
            <option value="paid">Sudah dibayar</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
    <a href="<?php echo site_url('customer/data_pembelian') ?>" class="btn btn-default">Cancel</a>
</form>