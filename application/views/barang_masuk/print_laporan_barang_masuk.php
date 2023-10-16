<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        table { font-size: 12px}
        table { width: 100%; }
        table#tb-item tr th, table#tb-item tr td { border: 1px solid #000 }
    </style>
</head>
<body>
    <p style="font-size:20px; text-align: center">Data Barang Masuk</p>
    <table id="tb-item">
        <tr style="background-color:#a9a9a9">
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
        foreach ($barang_masuk as $row) {
        ?>
        <tr>
            <td style="text-align: center;"><?php echo $no++ ?></td>
            <td><?php echo $row->nama_barang ?></td>
            <td><?php echo $row->merk_barang ?></td>
            <td><?php echo $row->nama_supplier ?></td>
            <td style="text-align: center;"><?php echo $row->jumlah ?></td>
            <td>Rp. <?php echo number_format($row->subtotal) ?></td>
            <td><?php echo $row->tgl_masuk ?></td>
        </tr>
        <?php } ?>
    </table>  
    <br><br><br><br><br><br><br>
    <table>
        <tr>
            <td width="50%" style="height: 20px;text-align:center">
                <p>&nbsp;</p>
            </td>
            <td width="50%" style="height: 20px;text-align:center">
                <label for="select">Bandung, <?php echo date('d F Y')?></label><br>
                <label for="select">Hormat kami,</label><br><br><br>
                <label for="select">Deta Motorage</label>
            </td>
        </tr>
    </table>
</body>  
</html>
