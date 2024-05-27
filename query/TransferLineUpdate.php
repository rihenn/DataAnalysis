<?php
header('Content-Type: application/json');

// Veritabanı bağlantısını dahil et
require "../conn/DevTechcon.php";

// JSON verisini al
$data = json_decode(file_get_contents('php://input'), true);

// Gerekli alanları kontrol et
if (isset($data['transferNumber']) && isset($data['barcode'])) {
    $transferNumber = $data['transferNumber'];
    $barcode = $data['barcode'];
    $itemCode = $data['itemCode'];
    $colorCode = $data['colorCode'];
    $itemDim1Code = $data['itemDim1Code'];
    $itemDescription = $data['itemDescription'];
    $colorCatalogDescription = $data['colorCatalogDescription'];
    $itemCostPrice = $data['itemCostPrice'];
    $shippingCostPrice = $data['shippingCostPrice'];
    $qty1 = $data['qty1'];
    $sendDate = $data['sendDate'];

    // Mevcut maliyetleri al
    $sqlSelect = "SELECT ItemCostPrice, ShippingCostPrice FROM trSendingLine WHERE TransferNumber = ? AND Barcode = ?";
    $paramsSelect = array($transferNumber, $barcode);
    $stmtSelect = sqlsrv_query($conn, $sqlSelect, $paramsSelect);

    if ($stmtSelect === false) {
        die(json_encode(['status' => 'error', 'message' => 'Mevcut maliyetleri alırken hata: ' . print_r(sqlsrv_errors(), true)]));
    }

    $currentCost = 0;
    if ($row = sqlsrv_fetch_array($stmtSelect, SQLSRV_FETCH_ASSOC)) {
        $currentCost = floatval($row['ItemCostPrice']) + floatval($row['ShippingCostPrice']);
    }

    sqlsrv_free_stmt($stmtSelect);

    // Yeni maliyet hesaplama
    $newCost = floatval($itemCostPrice) + floatval($shippingCostPrice);
    $costDifference = $newCost - $currentCost;

    // SQL güncelleme sorgusu
    $sqlUpdate = "UPDATE trSendingLine SET 
            ItemCode = ?, 
            ColorCode = ?, 
            ItemDim1Code = ?, 
            ItemDescription = ?, 
            ColorCatalogDescription = ?, 
            ItemCostPrice = ?, 
            ShippingCostPrice = ?, 
            Qty1 = ?, 
            SendDate = ? 
            WHERE TransferNumber = ? AND Barcode = ?";

    $paramsUpdate = array($itemCode, $colorCode, $itemDim1Code, $itemDescription, $colorCatalogDescription, $itemCostPrice, $shippingCostPrice, $qty1, $sendDate, $transferNumber, $barcode);

    $stmtUpdate = sqlsrv_prepare($conn, $sqlUpdate, $paramsUpdate);

    if ($stmtUpdate) {
        if (sqlsrv_execute($stmtUpdate)) {
            // trSendingHeader tablosunu güncelle
            $sqlUpdateHeader = "UPDATE trSendingHeader
                                SET ShippingCostPrice = ?
                                WHERE TransferNumber = ?";
            $paramsUpdateHeader = array($shippingCostPrice, $transferNumber);
            $stmtUpdateHeader = sqlsrv_prepare($conn, $sqlUpdateHeader, $paramsUpdateHeader);

            if ($stmtUpdateHeader) {
                if (sqlsrv_execute($stmtUpdateHeader)) {
                    // Bütçe tablosunu güncelle
                    $sqlUpdateBudget = "
                        UPDATE MonthlyBudget 
                        SET SpentBudget = SpentBudget - ?, 
                            LastTransferNumber = ?, 
                            LastLineID = (SELECT SendingLineID FROM trSendingLine WHERE TransferNumber = ? AND Barcode = ?),
                            LastUpdatedUserName = 'admin', 
                            LastUpdatedDate = GETDATE()
                        WHERE MONTH(StartDate) = MONTH(?) AND YEAR(StartDate) = YEAR(?)
                    ";

                    $paramsUpdateBudget = array($costDifference, $transferNumber, $transferNumber, $barcode, $sendDate, $sendDate);

                    $stmtUpdateBudget = sqlsrv_prepare($conn, $sqlUpdateBudget, $paramsUpdateBudget);

                    if ($stmtUpdateBudget) {
                        if (sqlsrv_execute($stmtUpdateBudget)) {
                            echo json_encode(['status' => 'success']);
                        } else {
                            echo json_encode(['status' => 'error', 'message' => 'Bütçe güncelleme başarısız: ' . print_r(sqlsrv_errors(), true)]);
                        }
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Bütçe güncelleme hazırlama başarısız: ' . print_r(sqlsrv_errors(), true)]);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Header güncelleme başarısız: ' . print_r(sqlsrv_errors(), true)]);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Header güncelleme hazırlama başarısız: ' . print_r(sqlsrv_errors(), true)]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Veri güncelleme başarısız: ' . print_r(sqlsrv_errors(), true)]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Veri güncelleme hazırlama başarısız: ' . print_r(sqlsrv_errors(), true)]);
    }

    sqlsrv_free_stmt($stmtUpdate);
    sqlsrv_close($conn);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gerekli veriler eksik.']);
}
?>
