<?php
require "../conn/DevTechcon.php";

// Gelen JSON veriyi alın
$data = json_decode(file_get_contents("php://input"), true);

$lines = isset($data['lines']) ? $data['lines'] : [];

foreach ($lines as $line) {
    // Insert sorgusu
    $sql = "INSERT INTO trSendingLine (
        SendingLineID, ProcessCode, TransferNumber, Barcode, ItemCode, ColorCode, ItemDim1Code,
        ItemDescription, ColorDescription, ItemCostPrice, ShippingCostPrice, Qty1, Post, InfCode,
        InfName, SendDate, SendingHeaderID, CreatedUserName, CreatedDate, LastUpdatedUserName,
        LastUpdatedDate, IsActive
    ) VALUES (
        NEWID(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, GETDATE(), ?, 'ADMIN', GETDATE(), 'ADMIN', GETDATE(), '1'
    );";

    $params = array(
        $line['ProcessCode'],
        $line['TransferNumber'],
        $line['Barcode'],
        $line['ItemCode'],
        $line['ColorCode'],
        $line['ItemDim1Code'],
        $line['ItemDescription'],
        $line['ColorDescription'],
        $line['ItemCostPrice'],
        $line['ShippingCostPrice'],
        $line['Qty1'],
        $line['Post'],
        $line['InfCode'],
        $line['InfName'],
        $line['SendingHeaderID']
    );

    // SQL sorgusunu hazırlayın ve çalıştırın
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if ($stmt === false) {
        echo json_encode(["status" => "error", "message" => "Sorgu hazırlanırken hata oluştu."]);
        die(print_r(sqlsrv_errors(), true));
    }

    if (!sqlsrv_execute($stmt)) {
        echo json_encode(["status" => "error", "message" => "Kayıt ekleme başarısız."]);
        print_r(sqlsrv_errors());
        exit;
    }
}

echo json_encode(["status" => "success"]);

sqlsrv_close($conn);
?>
