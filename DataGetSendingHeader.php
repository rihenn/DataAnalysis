<?php
require './conn/DevTechcon.php';

// Veritabanına bağlan
$conn = sqlsrv_connect($serverName, $connectionOptions);


if ($conn) {
    // Veritabanından verileri çekme sorgusu
    $sql = "SELECT 
    sh.ID AS SendingHeaderID,
    sh.ProcessCode,
    sh.TransferNumber,
    sh.ShippingCostPrice,
    sh.SendDate,
    sh.SendInfCode,
    sh.SendInfName,
    sh.CreatedUserName,
    sh.CreatedDate,
    sh.LastUpdatedUserName,
    sh.LastUpdatedDate,
    sh.IsActive,
    SUM(sl.ItemCostPrice) AS TotalItemCostPrice
FROM 
    trSendingHeader sh
JOIN 
    trSendingLine sl ON sh.ID = sl.SendingHeaderID
GROUP BY 
    sh.ID,
    sh.ProcessCode,
    sh.TransferNumber,
    sh.ShippingCostPrice,
    sh.SendDate,
    sh.SendInfCode,
    sh.SendInfName,
    sh.CreatedUserName,
    sh.CreatedDate,
    sh.LastUpdatedUserName,
    sh.LastUpdatedDate,
    sh.IsActive";
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
