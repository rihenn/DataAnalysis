<?php 
$serverName = "10.200.120.10\\SQLEXPRESS";
$connectionOptions = array(
    "Database" => "DevTech",
    "Uid" => "sa", 
    "PWD" => "tAVEyoiDgiZoTg3jNV2s",
    "CharacterSet" => "UTF-8",
);

$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// $sql = "SELECT ID, ProcessCode, TransferNumber, ItemBarcode, ItemCode, ColorCode, ItemDim1Code, Qty1, ItemName,
//         ItemCostPrice, CurrencyCode, SendDate, SendInfCode, SendInfName, Post, CreatedUserName,
//         CreatedDate, LastUpdatedUserName, LastUpdatedDate, IsActive FROM trSending";
// $stmt = sqlsrv_query($conn, $sql);
// if ($stmt === false) {
//     die(print_r(sqlsrv_errors(), true));
// }

// $data = array();
// while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
//     $data[] = $row;
// }

// sqlsrv_free_stmt($stmt);
// sqlsrv_close($conn);

// header('Content-Type: application/json');
// echo json_encode($data);
?>
