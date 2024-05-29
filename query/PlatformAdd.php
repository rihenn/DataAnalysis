<?php
header('Content-Type: application/json');

// Veritabanı bağlantısını dahil et
require "../conn/DevTechcon.php";

// JSON verisini al
$data = json_decode(file_get_contents('php://input'), true);

// Gerekli alanları kontrol et
if (isset($data['PlatformType']) && isset($data['PlatformValue'] )) {
    $PlatformType = $data['PlatformType'];
    $PlatformValue = $data['PlatformValue'];
  
    $createdUserName = 'admin'; // Bu değeri dinamik yapabilirsiniz
    $lastUpdatedUserName = 'admin'; // Bu değeri dinamik yapabilirsiniz
    $isActive = 1;

    // SQL insert sorgusu
    $sqlInsert = "INSERT INTO cdPlatformAttributeType (ID, PlatformCode, PlatformName, CreatedUserName, CreatedDate, LastUpdatedName, LastUpdatedDate, IsActive)
                  VALUES (NEWID(), ?, ?, ?, GETDATE(), ?, GETDATE(), ?)";

    $paramsInsert = array($PlatformType, $PlatformValue,$createdUserName, $lastUpdatedUserName, $isActive);

    $stmtInsert = sqlsrv_prepare($conn, $sqlInsert, $paramsInsert);

    if ($stmtInsert) {
        if (sqlsrv_execute($stmtInsert)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Veri eklenirken hata: ' . print_r(sqlsrv_errors(), true)]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Veri hazırlama başarısız: ' . print_r(sqlsrv_errors(), true)]);
    }

    sqlsrv_free_stmt($stmtInsert);
    sqlsrv_close($conn);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gerekli veriler eksik.']);
}
?>
