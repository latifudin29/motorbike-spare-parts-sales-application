<div class="row" style="margin-bottom: 10px">
    <div class="col-md-2">
        <?php echo anchor(site_url('barang/create'),'Create', 'class="btn btn-primary"'); ?>
    </div>
    <div class="col-md-2 text-center">
        <div style="margin-top: 8px" id="message">
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        </div>
    </div>
    <div class="col-md-8 text-right">
        <form action="<?php echo site_url('barang/index'); ?>" class="form-inline" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                <span class="input-group-btn">
                    <?php 
                        if ($q <> '')
                        {
                            ?>
                            <a href="<?php echo site_url('barang'); ?>" class="btn btn-default">Reset</a>
                            <?php
                        }
                    ?>
                <button class="btn btn-primary" type="submit">Search</button>
                </span>
            </div>
        </form>
    </div>
</div>
    <table class="table table-bordered" style="margin-bottom: 10px;">
        <tr>
            <th style="text-align:center">No</th>
            <th style="text-align:center">Kode Barang</th>
            <th style="text-align:center">Foto Barang</th>
            <th style="text-align:center">Nama Barang</th>
            <th style="text-align:center">Merk Barang</th>
            <th style="text-align:center">Harga</th>
            <th style="text-align:center">Stok</th>
            <th style="text-align:center">Action</th>
        </tr>
        <?php
        foreach ($barang_data as $barang)
        {
            ?>
        <tr>
            <td style="text-align:center"><?php echo ++$start ?></td>
            <td><?php echo $barang->kode_barang ?></td>
            <td><img src="<?php echo base_url("./image/barang/$barang->foto_barang") ?>" style="width: 80px; height: 80px; margin-left: auto; margin-right: auto; display:block"></td>
            <td><?php echo $barang->nama_barang ?></td>
            <td><?php echo $barang->merk_barang ?></td>
            <td>Rp.<?php echo number_format($barang->harga, 0, ',', '.') ?>,-</td>
            <td style="text-align:center"><?php echo $barang->stok ?></td>
            <td style="text-align:center">
                <?php 
                echo anchor(site_url('barang/update/'.$barang->id_barang),'Update'); 
                echo ' | '; 
                echo anchor(site_url('barang/delete/'.$barang->id_barang),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                ?>
            </td>
        </tr>
            <?php
        }
        ?>
    </table>
    <div class="row">
        <div class="col-md-6">
            <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
    </div>
        <div class="col-md-6 text-right">
            <?php echo $pagination ?>
        </div>
    </div>
