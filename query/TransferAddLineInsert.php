<?php
require "../conn/DevTechcon.php";

// Gelen JSON veriyi alın
$data = json_decode(file_get_contents("php://input"), true);

$lines = isset($data['lines']) ? $data['lines'] : [];

$total = 0;

foreach ($lines as $line) {
    // Toplam maliyet hesaplama
    $shippingCostPrice = floatval($line['ShippingCostPrice']);
    $itemCostPrice = floatval($line['ItemCostPrice']);
    $total += $shippingCostPrice + $itemCostPrice;

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
        $itemCostPrice,
        $shippingCostPrice,
        $line['Qty1'],
        $line['Post'],
        $line['InfCode'],
        $line['InfName'],
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

// Ay ve yıl bugünkü tarihle aynı olan TotalBudget'i çekme
$sqlDataBudget = "
    SELECT TotalBudget 
    FROM MonthlyBudget 
    WHERE YEAR(StartDate) = YEAR(GETDATE()) AND MONTH(StartDate) = MONTH(GETDATE())
";

$stmtDataBudget = sqlsrv_query($conn, $sqlDataBudget);

if ($stmtDataBudget === false) {
    echo json_encode(["status" => "error", "message" => "TotalBudget sorgusu çalıştırılamadı.", "errors" => sqlsrv_errors()]);
    exit;
}

$budget = null;
if ($row = sqlsrv_fetch_array($stmtDataBudget, SQLSRV_FETCH_ASSOC)) {
    $budget = floatval($row['TotalBudget']);
} else {
    echo json_encode(["status" => "error", "message" => "Bu ay ve yıla ait veri bulunamadı."]);
    exit;
}

$totalBudget = $budget - $total;

// Güncelleme sorgusu
$sqlUpdateBudget = "
INSERT INTO your_table_name (StartDate , EndDate , TotalBudget , SpentBudget , LastTransferNumber  , LastLineID , CreatedUserName , CreatedDate , LastUpdatedUserName , LastUpdatedDate ,IsActive ) 
            VALUES (?, ?, :Amount, :LastUpdatedUserName, :UniqueIdentifier, :CreatedBy, :CreatedDate, :UpdatedBy, :UpdatedDate, :IsActive)
    INSERT INTO MonthlyBudget 
    (TotalBudget, 
        LastTransferNumber = ?, 
        LastUpdatedUserName = 'admin', 
        LastUpdatedDate = GETDATE(), 
        LastLineId = ?)
    )
";

// `trSendingLine` tablosunda yeni eklenen satırın `SendingLineID` değerini al
$sqlGetLastLineId = "
    SELECT TOP 1 SendingLineID 
    FROM trSendingLine 
    ORDER BY CreatedDate DESC
";

$stmtLastLineId = sqlsrv_query($conn, $sqlGetLastLineId);

if ($stmtLastLineId === false) {
    echo json_encode(["status" => "error", "message" => "Son satır ID'si alınamadı.", "errors" => sqlsrv_errors()]);
    exit;
}

$lastLineId = null;
if ($row = sqlsrv_fetch_array($stmtLastLineId, SQLSRV_FETCH_ASSOC)) {
    $lastLineId = $row['SendingLineID'];
} else {
    echo json_encode(["status" => "error", "message" => "Son satır ID'si bulunamadı."]);
    exit;
}

$paramsUpdate = array($totalBudget, $line['TransferNumber'], $lastLineId);

$stmtUpdateBudget = sqlsrv_prepare($conn, $sqlUpdateBudget, $paramsUpdate);

if ($stmtUpdateBudget === false) {
    echo json_encode(["status" => "error", "message" => "Güncelleme sorgusu hazırlanırken hata oluştu.", "errors" => sqlsrv_errors()]);
    exit;
}

if (!sqlsrv_execute($stmtUpdateBudget)) {
    echo json_encode(["status" => "error", "message" => "Güncelleme başarısız.", "errors" => sqlsrv_errors()]);
    exit;
}

echo json_encode(["status" => "success", "TotalBudget" => $totalBudget]);

sqlsrv_close($conn);
?>
