<?php
function cetakNamaBarang($rowNmBarang)
{
    $nmBarang = '';
    $nmBarangBawah = '';
    $arrNmBarang = explode(' ', $rowNmBarang);
    if (array_key_exists(0, $arrNmBarang) === true) {
        $nmBarang .= $arrNmBarang[0];
    }
    if (array_key_exists(1, $arrNmBarang) === true) {
        $nmBarang .= ' ' . $arrNmBarang[1];
    }
    for ($i = 2; $i < count($arrNmBarang); $i++) {
        if ($nmBarangBawah === '') {
            $nmBarangBawah .= $arrNmBarang[$i];
        } else {
            $nmBarangBawah .= ' ' . $arrNmBarang[$i];
        }
    }
    $data = [$nmBarang, $nmBarangBawah];
    return $data;
}

?>
<table border="1" cellpadding="2" cellspacing="2">
    <tbody>
    <?php
    $count = 0;
    if ($model !== null) {
        for ($i = 0; $i < count($model); $i++) {
            ?>
            <tr>
                <td>
                    <div>
                        <h4><?php
                            $barang = cetakNamaBarang($model[$i]['nm_barang']);
                            echo strtoupper($barang[0]) . '<br/>' . strtoupper($barang[1]); ?></h4>

                        <h2>Rp. <?php echo number_format($model[$i]['harga_jual']); ?></h2>
                    </div>
                </td>
                <?php
                if (array_key_exists($i + 1, $model) === true) {
                    ?>
                    <td>
                        <div>
                            <h4><?php
                                $barang = cetakNamaBarang($model[$i + 1]['nm_barang']);
                                echo strtoupper($barang[0]) . '<br/>' . strtoupper($barang[1]); ?></h4>

                            <h2>Rp. <?php echo number_format($model[$i + 1]['harga_jual']); ?></h2>
                        </div>
                    </td>
                    <?php
                }
                $i++;
                ?>
                <?php
                if (array_key_exists($i + 1, $model) === true) {
                    ?>
                    <td>
                        <div>
                            <h4><?php
                                $barang = cetakNamaBarang($model[$i + 1]['nm_barang']);
                                echo strtoupper($barang[0]) . '<br/>' . strtoupper($barang[1]); ?></h4>

                            <h2>Rp. <?php echo number_format($model[$i + 1]['harga_jual']); ?></h2>
                        </div>
                    </td>
                    <?php
                }
                $i++;
                ?>
            </tr>
            <?php
        }
    } ?>
    </tbody>
</table>
