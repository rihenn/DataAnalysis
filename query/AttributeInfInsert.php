<?php
require '../conn/DevTechcon.php';

// JSON girişini al
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['infCode']) && isset($data['attributeType']) && isset($data['attributeValue'])) {
    $infCode = $data['infCode'];
    $firstName = $data['firstName'];
    $lastName = $data['lastName'];
    $attributeType = $data['attributeType'];
    $attributeValue = $data['attributeValue'];
    $createdUserName = 'admin';
    $createdDate = date('Y-m-d H:i:s');
    $lastUpdatedUserName = 'admin';
    $lastUpdateDate = date('Y-m-d H:i:s');
    $isActive = 1;

    // Aynı attributeTypeCode ve attributeCode kombinasyonu için kontrol yapma
    $checkSql = "SELECT COUNT(*) as count 
                 FROM prInfluecerAttribute 
                 WHERE InfluecerCode = ? 
                 AND (AttributeTypeCode = ? OR (AttributeTypeCode = ? AND AttributeCode = ?))";
    $checkStmt = sqlsrv_prepare($conn, $checkSql, [$infCode, $attributeType, $attributeType, $attributeValue]);
    
    if ($checkStmt) {
        sqlsrv_execute($checkStmt);
        $row = sqlsrv_fetch_array($checkStmt, SQLSRV_FETCH_ASSOC);
        
        if ($row['count'] > 0) {
            echo json_encode(['success' => false, 'message' => 'Bu özellik zaten mevcut.']);
            sqlsrv_free_stmt($checkStmt);
            sqlsrv_close($conn);
            exit();
        }
        sqlsrv_free_stmt($checkStmt);
    } else {
        echo json_encode(['success' => false, 'message' => 'Veritabanı hatası.']);
        exit();
    }

    // MSSQL uyumlu insert sorgusu
    $sql = "INSERT INTO prInfluecerAttribute (
                ID, InfluecerCode, FirstName, LastName, AttributeTypeCode, AttributeCode, 
                CreatedUserName, CreatedDate, LastUpdatedUserName, LastUpdateDate, IsActive
            ) VALUES (
                NEWID(), ?, ?, ?, ?, ?, 
                ?, ?, ?, ?, ?
            )";

    // SQL sorgusunu hazırlama
    $stmt = sqlsrv_prepare($conn, $sql, [
        $infCode, $firstName, $lastName, $attributeType, $attributeValue, 
        $createdUserName, $createdDate, $lastUpdatedUserName, $lastUpdateDate, $isActive
    ]);

    if ($stmt) {
        // Sorguyu yürütme
        if (sqlsrv_execute($stmt)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Veri eklenirken hata oluştu.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Sorgu hatası.']);
    }

    // Bağlantıyı kapatma
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
} else {
    echo json_encode(['success' => false, 'message' => 'Gerekli alanlar eksik.']);
}
?>
