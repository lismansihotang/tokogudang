<table cellspacing="1" cellpadding="1" style="border: 1px solid #ccc;">
    <thead>
    <tr style="font-size: 14px;">
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">No</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">ID Barang</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Nama Barang</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Harga Beli</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Margin</th>
        <th style="border-bottom: 2px solid #ccc;">Harga Jual</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if ($model !== null) {
        $i = 1;
        foreach ($model as $row) {
            ?>
            <tr>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo $i; ?></td>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo $row->id; ?></td>
                <td style="border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo $row->nm_barang; ?></td>
                <td style="text-align: right;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format($row->harga_beli); ?></td>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format($row->margin_jual); ?></td>
                <td style="text-align: right;border-bottom: 1px solid #ccc;"><?php echo number_format($row->harga_jual); ?></td>
            </tr>
            <?php
            $i++;
        }
    } ?>
    </tbody>
</table>
