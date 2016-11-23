<h2>Report Stock Barang</h2>
<table cellspacing="1" cellpadding="1" style="border: 1px solid #ccc;">
    <thead>
    <tr style="font-size: 14px;">
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">No</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Barcode No</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">ID Barang</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Item Name</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">In Date</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Qty Display</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Qty Gudang</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Out Date from Warehouse</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Total Keluar Barang dari Gudang</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Expired Date</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Petugas</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Paraf</th>
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
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;">
                    <?php
                    if (array_key_exists($row->id, $modelDetail) === true) {
                        echo $modelDetail[$row->id];
                    }
                    ?>
                </td>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo $row->id; ?></td>
                <td style="border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo $row->nm_barang; ?></td>
                <td style="text-align: right;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;">&nbsp;</td>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format(
                        $row->stock
                    ); ?></td>
                <td style="text-align: right;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;">&nbsp;</td>
                <td style="text-align: right;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;">&nbsp;</td>
                <td style="text-align: right;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;">&nbsp;</td>
                <td style="text-align: right;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;">&nbsp;</td>
                <td style="text-align: right;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;">&nbsp;</td>
                <td style="text-align: right;border-bottom: 1px solid #ccc;">&nbsp;</td>
            </tr>

            <?php
            $i++;
        }
    }
    ?>
    </tbody>
</table>