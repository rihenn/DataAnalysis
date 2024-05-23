<?php
require './conn/DevTechcon.php';

// Veritabanına bağlan
$conn = sqlsrv_connect($serverName, $connectionOptions);

header('Content-Type: application/json');

if ($conn) {
    // Veritabanından verileri çekme sorgusu
    $sql = "SELECT *
            FROM MonthlyBudget
            WHERE YEAR(StartDate) = YEAR(GETDATE()) ";
    
    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt === false) {
        echo json_encode(array("status" => "error", "message" => "Sorgu çalıştırılamadı", "errors" => sqlsrv_errors()));
        exit;
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
    echo json_encode(array("status" => "error", "message" => "Bağlantı kurulamadı", "errors" => sqlsrv_errors()));
}
?>
