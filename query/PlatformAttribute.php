<?php
// Veritabanı bağlantısını dahil edin
require "../conn/DevTechcon.php";

// Gelen POST verilerini al
$input = json_decode(file_get_contents('php://input'), true);
$PlatformCode = $input['PlatformCode'] ?? '';
$PlatformName = $input['PlatformName'] ?? '';
$ContentCode = $input['ContentCode'] ?? '';
$ContentName = $input['ContentName'] ?? '';

// Alanların boş olup olmadığını kontrol et
if (empty($PlatformCode) || empty($PlatformName) || empty($ContentCode) || empty($ContentName)) {
    echo json_encode(['success' => false, 'message' => 'Lütfen tüm alanları doldurunuz.']);
    exit;
}

// Veritabanı bağlantısı ve veri ekleme işlemi
try {
    $sql = "INSERT INTO cdPlatformAttribute (ID, PlatformCode, PlatformName, ContentCode, ContentName, CreatedUserName, CreatedDate, LastUpdatedUserName, LastUpdatedDate, IsActive)
            VALUES (NEWID(), ?, ?, ?, ?, 'admin', GETDATE(), 'admin', GETDATE(), 1)";
    $params = array($PlatformCode, $PlatformName, $ContentCode, $ContentName);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        $errors = sqlsrv_errors();
        if ($errors !== null) {
            echo json_encode(['success' => false, 'message' => 'Veri eklenirken bir hata oluştu.', 'errors' => $errors]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Bilinmeyen bir hata oluştu.', 'errors' => 'No additional error information available.']);
        }
    } else {
        echo json_encode(['success' => true]);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

// Veritabanı bağlantısını kapat
sqlsrv_close($conn);
?>
