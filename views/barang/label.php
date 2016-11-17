<?php
if ($model !== null) {
    foreach ($model as $row) {
        echo '<div  style="width: 70mm; position: relative; border: #ccc 1px solid;">';
        echo '<h4>' . strtoupper($row->nm_barang) . '</h4>';
        echo '<h2> Rp. ' . number_format($row->harga_jual) . '</h2>';
        echo '</div>';
    }
}