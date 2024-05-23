<?php
require "../conn/DevTechcon.php";

// Gelen JSON veriyi alın
$data = json_decode(file_get_contents("php://input"), true);

$lines = isset($data['lines']) ? $data['lines'] : [];

$totalCost = 0;

foreach ($lines as $line) {
    // SendDate'in olup olmadığını kontrol et
    if (!isset($line['SendDate'])) {
        echo json_encode(["status" => "error", "message" => "Eksik SendDate değeri."]);
        exit;
    }

    // Toplam maliyet hesaplama
    $shippingCostPrice = floatval($line['ShippingCostPrice']);
    $itemCostPrice = floatval($line['ItemCostPrice']);
    $totalCost += $shippingCostPrice + $itemCostPrice;

    // Insert sorgusu
    $sql = "INSERT INTO trSendingLine (
        SendingLineID, ProcessCode, TransferNumber, Barcode, ItemCode, ColorCode, ItemDim1Code,
        ItemDescription, ColorDescription, ItemCostPrice, ShippingCostPrice, Qty1, InfCode,
        InfName, SendDate, SendingHeaderID, Post,CreatedUserName, CreatedDate, LastUpdatedUserName,
        LastUpdatedDate, IsActive
    ) VALUES (
        NEWID(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0,'ADMIN', GETDATE(), 'ADMIN', GETDATE(), '1'
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
        $itemCostPrice,
        $shippingCostPrice,
        $line['Qty1'],
        $line['InfCode'],
        $line['InfName'],
        $line['SendDate'],
        $line['SendingHeaderID']
    );

    // SQL sorgusunu hazırlayın ve çalıştırın
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if ($stmt === false) {
        echo json_encode(["status" => "error", "message" => "Sorgu hazırlanırken hata oluştu.", "errors" => sqlsrv_errors()]);
        exit;
    }

    if (!sqlsrv_execute($stmt)) {
        echo json_encode(["status" => "error", "message" => "Kayıt ekleme başarısız.", "errors" => sqlsrv_errors()]);
        exit;
    }
}

// `trSendingLine` tablosunda yeni eklenen satırın `SendingLineID` ve `SendDate` değerini al
$sqlGetLastLine = "
    SELECT TOP 1 SendingLineID, SendDate 
    FROM trSendingLine 
    ORDER BY CreatedDate DESC
";

$stmtLastLine = sqlsrv_query($conn, $sqlGetLastLine);

if ($stmtLastLine === false) {
    echo json_encode(["status" => "error", "message" => "Son satır verileri alınamadı.", "errors" => sqlsrv_errors()]);
    exit;
}

$lastLineId = null;
$sendDate = null;
if ($row = sqlsrv_fetch_array($stmtLastLine, SQLSRV_FETCH_ASSOC)) {
    $lastLineId = $row['SendingLineID'];
    $sendDate = $row['SendDate'];
} else {
    echo json_encode(["status" => "error", "message" => "Son satır verileri bulunamadı."]);
    exit;
}

// Gönderim tarihi ile startdate ayları eşleştirme ve güncelleme
$sqlUpdateBudget = "
    UPDATE MonthlyBudget 
    SET SpentBudget = SpentBudget - ?, 
        LastTransferNumber = ?, 
        LastLineID = ?, 
        LastUpdatedUserName = 'admin', 
        LastUpdatedDate = GETDATE()
    WHERE MONTH(StartDate) = MONTH(?) AND YEAR(StartDate) = YEAR(?)
";

$paramsUpdate = array($totalCost, $line['TransferNumber'], $lastLineId, $sendDate, $sendDate);

$stmtUpdateBudget = sqlsrv_prepare($conn, $sqlUpdateBudget, $paramsUpdate);

if ($stmtUpdateBudget === false) {
    echo json_encode(["status" => "error", "message" => "Güncelleme sorgusu hazırlanırken hata oluştu.", "errors" => sqlsrv_errors()]);
    exit;
}

if (!sqlsrv_execute($stmtUpdateBudget)) {
    echo json_encode(["status" => "error", "message" => "Güncelleme başarısız.", "errors" => sqlsrv_errors()]);
    exit;
}

echo json_encode(["status" => "success"]);

sqlsrv_close($conn);
?>


