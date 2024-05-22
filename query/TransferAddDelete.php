<?php
require "../conn/DevTechcon.php";

// Gelen JSON veriyi alın
$data = json_decode(file_get_contents("php://input"), true);
$headerID = isset($data['headerID']) ? $data['headerID'] : null;

if (!$headerID) {
    echo json_encode(["status" => "error", "message" => "Header ID eksik."]);
    exit;
}

// Delete sorgusu
$sql = "DELETE FROM trSendingHeader WHERE ID = ?";

$params = array($headerID);

// SQL sorgusunu hazırlayın ve çalıştırın
$stmt = sqlsrv_prepare($conn, $sql, $params);

if ($stmt === false) {
    echo json_encode(["status" => "error", "message" => "Sorgu hazırlanırken hata oluştu."]);
    die(print_r(sqlsrv_errors(), true));
}

if (sqlsrv_execute($stmt)) {
    echo json_encode(["status" => "success", "message" => "Kayıt başarıyla silindi."]);
} else {
    echo json_encode(["status" => "error", "message" => "Kayıt silme başarısız."]);
    print_r(sqlsrv_errors());
}

sqlsrv_close($conn);
?>
