<?php
require './conn/DevTechcon.php';

// Veritabanına bağlan
$conn = sqlsrv_connect($serverName, $connectionOptions);
$barcode = $_GET['barcode'];

if ($conn) {
    // Veritabanından verileri çekme sorgusu
    $sql = " 
    SELECT
        p.Barcode,
        p.ItemCode,
        p.ColorCode,
        p.ItemDescription,
        p.ItemDim1Code,
        pr.PSF_EUR,
        pr.PSF_TRY,
        pr.PSF_USD,
        pr.MLY_EUR,
        p.ColorThemeCode,
        p.ColorThemeDescription,
        p.ColorCatalogCode,
        p.ColorCatalogDescription,
        p.ProductHierarchyLevel01,
        p.ProductHierarchyLevel02,
        p.ProductHierarchyLevel03,
        p.ProductHierarchyLevel04,
        p.ProductHierarchyLevel05
    FROM
        cdNebimProduct AS p
    JOIN
        cdNebimPrice AS pr ON p.Barcode = pr.Barcode
    where p.Barcode =

           '$barcode'";
    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $data = array();
    // Verileri döngü ile JSON formatında oluşturma
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $data[] = $row;
    }

    // JSON formatında verileri yazdırma
    echo json_encode($data);

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
} else {
    echo "Connection could not be established.<br />";
    die(print_r(sqlsrv_errors(), true));
}
?>
