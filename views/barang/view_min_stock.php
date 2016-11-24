<h2>Minimal Stock Barang</h2>
<table cellspacing="1" cellpadding="1" style="border: 1px solid #ccc;">
    <thead>
    <tr style="font-size: 14px;">
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">No</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Item Name</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Min. Stock</th>
        <th style="border-bottom: 2px solid #ccc;">Stock</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($model) > 0) {
        $i = 1;
        foreach ($model as $row) {
            ?>
            <tr>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo $i; ?></td>
                <td style="border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo $row->nm_barang; ?></td>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo $row->min_stock; ?></td>
                <td style="text-align: center;border-bottom: 1px solid #ccc;"><?php echo $row->stock; ?></td>
            </tr>
            <?php
            $i++;
        }
    }
    ?>
    </tbody>
</table>
