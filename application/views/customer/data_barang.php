<div class="row">
    <?php foreach ($barang as $brg) : ?>
        <div class="col-md-3">
        <div class="card-barang">
            <img src="image/barang/<?= $brg->foto_barang ?>" alt="barang" class="card-image"> 
            <div class="card-body" style="text-align: center">
                <h5 class="card-title"><?= $brg->nama_barang ?></h5>
                <p class="card-text">Merk: <?= $brg->merk_barang ?></p>
                <p class="card-text">Stok: <?= $brg->stok ?></p>
                <p class="card-text"><strong>Harga: Rp.<?= number_format($brg->harga, 0, ',', '.') ?>,-</strong></p>
            </div>
        </div>
        </div> 
    <?php endforeach ?>
</div>