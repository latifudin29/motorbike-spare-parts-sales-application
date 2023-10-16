<?php 
$rs = $data->row();
?>
<div class="card">
    <div class="card-body">
        <p>Silahkan lakukan pembayaran untuk bisa kami proses selanjutnya dengan cara:</p>
        <ol>
            <li>Lakukan pembayaran pada rekening <strong>BCA 123901249421</strong> a/n Supplier</li>
            <li>Sertakan keterangan dengan nomor order: <strong><?= $rs->kode_transaksi ?></strong></li>
            <li>Total pembayaran: <strong>Rp. <?php echo number_format($rs->total_harga); ?></strong></li>
        </ol>
        <p>Jika sudah silahkan kirimkan bukti transfer dengan cara <a href="<?= site_url('transaction/konfirmasi/'.$rs->id_transaksi) ?>">klik disini</a></p>
    </div>
</div>