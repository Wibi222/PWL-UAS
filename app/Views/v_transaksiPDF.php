<h1>Data Produk</h1>

<table border="1" width="100%" cellpadding="5">
    <tr>
        <th>No</th>
        <th>Username</th>
        <th>Total Harga</th>
        <th>Alamat</th>
        <th>Ongkir</th>
        <th>Status</th>
    </tr>

    <?php
    $no = 1;
    foreach ($transaction as $index => $produk) :
        
    ?>
        <tr>
            <td align="center"><?= $index + 1 ?></td>
            <td><?= $produk['username'] ?></td>
            <td align="right"><?= "Rp " . number_format($produk['total_harga'], 2, ",", ".") ?></td>
            <td align="center"><?= $produk['alamat'] ?></td>
            <td align="center"><?= $produk['ongkir'] ?></td>
            <td align="center"><?= $produk['status'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
Downloaded on <?= date("Y-m-d H:i:s") ?>