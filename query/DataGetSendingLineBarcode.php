<?php
require dirname(__FILE__) . '/../conn/DevTechcon.php';

// Hata raporlamayı etkinleştir
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json'); // JSON çıktısı olduğundan emin olun

// Veritabanına bağlan
$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    echo json_encode(["error" => "Connection could not be established.", "details" => sqlsrv_errors()]);
    exit();
}

$transferNumber = $_POST['transferNumber'];
$barcode = $_POST['barcode'];

// Veritabanından verileri çekme sorgusu
$sql = "SELECT Barcode, ItemCode, ColorCode, ItemDim1Code, ItemDescription, ColorCatalogDescription, ItemCostPrice, ShippingCostPrice, Qty1, Post, InfCode, InfName, SendDate FROM trSendingLine WHERE TransferNumber = ? AND Barcode = ?";
$stmt = sqlsrv_query($conn, $sql, array($transferNumber, $barcode));

if ($stmt === false) {
    echo json_encode(["error" => "Query could not be executed.", "details" => sqlsrv_errors()]);
    exit();
}

$data = array();
// Verileri döngü ile JSON formatında oluşturma
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $data[] = $row;
}

// JSON formatında verileri yazdırma
$response = ["status" => "success", "message" => "PHP script is working fine", "data" => $data];
echo json_encode($response);

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
