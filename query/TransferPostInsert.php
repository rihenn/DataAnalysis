<?php 
require "../conn/DevTechcon.php";
if (!$conn) {
    die(json_encode(["status" => "error", "message" => "Veritabanı bağlantısı kurulamadı."]));
}

// Gelen JSON veriyi alın
$data = json_decode(file_get_contents("php://input"), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    die(json_encode(["status" => "error", "message" => "Geçersiz JSON verisi."]));
}

// Form verilerini işleme
$barcode = isset($data['barcode']) ? $data['barcode'] : null;
$transferNumber = isset($data['transferNumber']) ? $data['transferNumber'] : null;
$PlatformCode = isset($data['PlatformCode']) ? $data['PlatformCode'] : null;
$PlatformName = isset($data['PlatformName']) ? $data['PlatformName'] : null;
$ContentCode = isset($data['ContentCode']) ? $data['ContentCode'] : null;
$ContentName = isset($data['ContentName']) ? $data['ContentName'] : null;
$ShareDate = isset($data['ShareDate']) ? $data['ShareDate'] : null;
$LikeCount = isset($data['LikeCount']) ? $data['LikeCount'] : null;
$WievCount = isset($data['WievCount']) ? $data['WievCount'] : null;

// Gelen verileri kontrol edin
if (!$transferNumber || !$PlatformCode || !$PlatformName || !$ContentCode || !$ContentName || !$ShareDate || !$LikeCount || !$WievCount || !$barcode) {
    die(json_encode(["status" => "error", "message" => "Eksik veri. Tüm alanları doldurun."]));
}

// ShareDate formatını kontrol et ve dönüştür
$date = DateTime::createFromFormat('Y-m-d', $ShareDate);
if (!$date) {
    die(json_encode(["status" => "error", "message" => "Geçersiz tarih formatı."]));
}
$formattedShareDate = $date->format('Y-m-d');

// SQL sorgusunu hazırlayın
$sqlInsert = "INSERT INTO prSendingAttribute (ID, TransferNumber, PlatformCode, PlatformName, ContentCode, ContentName, ShareDate,
                                      LikeCount, ViewCount, Barcode, CreatedUserName, CreatedDate, LastUpdatedUserName,
                                      LastUpdatedDate, IsActive)
        VALUES (NEWID(), ?, ?, ?, ?, ?, ?, ?, ?, ?, 'admin', GETDATE(), 'admin', GETDATE(), '1')";

$sqlUpdate = "UPDATE trSendingLine SET Post = '1' WHERE TransferNumber = ? AND Barcode = ?";

$paramsInsert = array($transferNumber, $PlatformCode, $PlatformName, $ContentCode, $ContentName, $formattedShareDate, $LikeCount, $WievCount, $barcode);
$paramsUpdate = array($transferNumber, $barcode);

// SQL sorgusunu çalıştırın
$stmtInsert = sqlsrv_prepare($conn, $sqlInsert, $paramsInsert);
if ($stmtInsert === false) {
    die(json_encode(["status" => "error", "message" => "INSERT sorgusu hazırlanırken hata oluştu: " . print_r(sqlsrv_errors(), true)]));
}

$stmtUpdate = sqlsrv_prepare($conn, $sqlUpdate, $paramsUpdate);
if ($stmtUpdate === false) {
    die(json_encode(["status" => "error", "message" => "UPDATE sorgusu hazırlanırken hata oluştu: " . print_r(sqlsrv_errors(), true)]));
}

// INSERT ve UPDATE sorgularını çalıştırın
if (sqlsrv_execute($stmtInsert) && sqlsrv_execute($stmtUpdate)) {
    echo json_encode(["status" => "success", "message" => "Kayıt başarılı."]);
} else {
    die(json_encode(["status" => "error", "message" => "Kayıt ekleme veya güncelleme başarısız: " . print_r(sqlsrv_errors(), true)]));
}

sqlsrv_close($conn);
?>
