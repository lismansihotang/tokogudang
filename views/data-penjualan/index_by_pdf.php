<h2>Laporan Penjualan</h2>
<table cellspacing="1" cellpadding="1" style="border: 1px solid #ccc;">
    <thead>
    <tr style="font-size: 14px;">
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">No</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Barcode No</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">ID Barang</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Item Name</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Qty Display</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Qty Gudang</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Qty Sales</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Stock</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Net Price</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Margin</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Disc</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Tax</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Sales Price</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Profit/Qty</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Profit</th>
        <th style="border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;">Total Sales</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if ($data !== null) {
        $i = 1;
        $qtySales = 0;
        $netPrice = 0;
        $margin = 0;
        $discount = 0;
        $tax = 0;
        $salesPrice = 0;
        $profitItemPrice = 0;
        $profitPrice = 0;
        $totalSales = 0;
        foreach ($data as $row) {
            $profitItem = $row->harga - $row->harga_beli;
            $profit = $profitItem * $row->jml;
            //$profitItem = @($profit / $row->jml);
            # counting for total
            $qtySales += $row->jml;
            $netPrice += $row->harga_beli;
            $margin += $row->margin_jual;
            $discount += ($row->disc === null) ? 0 : $row->disc;
            $tax += $row->pajak;
            $salesPrice += $row->harga;
            $profitItemPrice += $profitItem;
            $profitPrice += $profit;
            $totalSalesItem = $row->harga * $row->jml;
            $totalSales += $totalSalesItem;
            ?>
            <tr>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo $i; ?></td>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo $row->barcode; ?></td>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo $row->id_barang; ?></td>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo $row->nm_barang; ?></td>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format(
                        $row->stock
                    ); ?></td>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"></td>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format(
                        $row->jml
                    ); ?></td>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format(
                        $row->stock
                    ); ?></td>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format(
                        $row->harga_beli
                    ); ?></td>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format(
                        $row->margin_jual
                    ); ?></td>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format(
                        ($row->disc === null) ? '0' : $row->disc
                    ); ?></td>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format(
                        $row->pajak
                    ); ?></td>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format(
                        $row->harga
                    ); ?></td>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format(
                        $profitItem
                    ); ?></td>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format(
                        $profit
                    ); ?></td>
                <td style="text-align: center;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format(
                        $totalSalesItem
                    ); ?></td>
            </tr>
            <?php
            $i++;
        }
        ?>
        <tr>
            <td colspan="6"
                style="text-align: center;font-weight: bold;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;">
                Total
            </td>
            <td style="text-align: center;font-weight: bold;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format(
                    $qtySales
                ); ?></td>
            <td style="text-align: center;font-weight: bold;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"></td>
            <td style="text-align: center;font-weight: bold;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format(
                    $netPrice
                ); ?></td>
            <td style="text-align: center;font-weight: bold;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format(
                    $margin
                ); ?></td>
            <td style="text-align: center;font-weight: bold;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format(
                    $discount
                ); ?></td>
            <td style="text-align: center;font-weight: bold;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format(
                    $tax
                ); ?></td>
            <td style="text-align: center;font-weight: bold;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format(
                    $salesPrice
                ); ?></td>
            <td style="text-align: center;font-weight: bold;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format(
                    $profitItemPrice
                ); ?></td>
            <td style="text-align: center;font-weight: bold;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format(
                    $profitPrice
                ); ?></td>
            <td style="text-align: center;font-weight: bold;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;"><?php echo number_format(
                    $totalSales
                ); ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>

<br><br><br><br><br>
<table>
    <tbody>
    <tr>
        <td style="border-left: 1px solid #ccc;border-top: 1px solid #ccc;border-right: 1px solid #ccc;">Kasir</td>
        <td style="border-top: 1px solid #ccc;border-right: 1px solid #ccc;">Store Head</td>
        <td style="border-top: 1px solid #ccc;border-right: 1px solid #ccc;">Manager CP</td>
    </tr>
    <tr>
        <td style="border-left: 1px solid #ccc;border-top: 1px solid #ccc;border-right: 1px solid #ccc;height: 100px;"></td>
        <td style="border-top: 1px solid #ccc;border-right: 1px solid #ccc;"></td>
        <td style="border-top: 1px solid #ccc;border-right: 1px solid #ccc;"></td>
    </tr>
    <tr>
        <td style="border-left: 1px solid #ccc;border-top: 1px solid #ccc;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;">&nbsp;</td>
        <td style="border-top: 1px solid #ccc;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;">&nbsp;</td>
        <td style="border-top: 1px solid #ccc;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;">&nbsp;</td>
    </tr>
    </tbody>
</table>