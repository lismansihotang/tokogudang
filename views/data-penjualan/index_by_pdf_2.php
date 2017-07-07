<table cellspacing="1" cellpadding="2" style="border: 1px solid #ccc;">
    <thead>
    <tr style="font-size: 14px;">
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">No</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Tgl</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Pembayaran</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Subtotal</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Discount</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Total</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Pembayaran</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Kembali</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $subtotal = 0;
    $discount = 0;
    $total = 0;
    $pembayaran = 0;
    $kembali = 0;
    if (count($model) > 0) {
        $i = 1;
        foreach ($model as $row) {
            ?>
            <tr>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo $i; ?></td>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo $row->tgl; ?></td>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo $row->tipe_bayar; ?></td>
                <td style="text-align: right;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format($row->subtotal); ?></td>
                <td style="text-align: right;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format($row->disc); ?></td>
                <td style="text-align: right;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format($row->total); ?></td>
                <td style="text-align: right;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format($row->pembayaran); ?></td>
                <td style="text-align: right;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format(
                        (integer)$row->pembayaran - (integer)$row->total
                    ); ?></td>
            </tr>
            <?php
            $subtotal += $row->subtotal;
            $discount += $row->disc;
            $total += $row->total;
            $pembayaran += $row->pembayaran;
            $kembali += ((integer)$row->pembayaran - (integer)$row->total);
            $i++;
        }
    }
    ?>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="2" style="text-align: right;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"></td>
        <td style="text-align: right;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format($subtotal); ?></td>
        <td style="text-align: right;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format($discount); ?></td>
        <td style="text-align: right;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format($total); ?></td>
        <td style="text-align: right;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format($pembayaran); ?></td>
        <td style="text-align: right;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format($kembali); ?></td>
    </tr>
    </tfoot>
</table>