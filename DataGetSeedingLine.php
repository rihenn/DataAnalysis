<?php
require './conn/DevTechcon.php';

// Veritabanına bağlan
$conn = sqlsrv_connect($serverName, $connectionOptions);

    $Time =date("Y-m-d");
if ($conn) {
    // Veritabanından verileri çekme sorgusu
    $sql = "select * from trSendingLine WHERE  CAST(SendDate AS DATE) = ?";
    $stmt = sqlsrv_query($conn, $sql,array($Time));

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
