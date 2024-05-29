<?php
// Veritabanı bağlantısını dahil et
require "../conn/DevTechcon.php";

// Veritabanı bağlantısını kur
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(json_encode(array('success' => false, 'message' => 'Veritabanı bağlantısı kurulamadı', 'errors' => sqlsrv_errors())));
}

// Form verilerini al
$infCode = $_POST['infCode'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$attributeType = $_POST['attributeType'];
$attributeValue = $_POST['attributeValue'];

// Aynı kaydın var olup olmadığını kontrol eden sorgu
$checkSql = "SELECT COUNT(*) as count FROM prInfluecerAttribute WHERE InfluecerCode = ? AND AttributeTypeCode = ? AND AttributeCode = ?";
$checkParams = array($infCode, $attributeType, $attributeValue);
$checkStmt = sqlsrv_query($conn, $checkSql, $checkParams);

if ($checkStmt === false) {
    die(json_encode(array('success' => false, 'message' => 'Kontrol sorgusu çalıştırılamadı', 'errors' => sqlsrv_errors())));
}

$row = sqlsrv_fetch_array($checkStmt, SQLSRV_FETCH_ASSOC);

if ($row['count'] > 0) {
    echo json_encode(array('success' => false, 'message' => 'Aynı kayıttan bir daha girilemez'));
    sqlsrv_close($conn);
    exit();
}

// SQL sorgusunu hazırlayın
$sql = "INSERT INTO prInfluecerAttribute (ID, InfluecerCode, FirstName, LastName, AttributeTypeCode, AttributeCode, CreatedUserName, CreatedDate, LastUpdatedUserName, LastUpdateDate, IsActive) 
        VALUES (NEWID(), ?, ?, ?, ?, ?, 'admin', GETDATE(), 'admin', GETDATE(), 1)";
$params = array($infCode, $firstName, $lastName, $attributeType, $attributeValue);

// Sorguyu çalıştırın
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(json_encode(array('success' => false, 'message' => 'Sorgu çalıştırılamadı', 'errors' => sqlsrv_errors())));
}

// Bağlantıyı kapatın
sqlsrv_close($conn);

// Başarılı mesajı dön
echo json_encode(array('success' => true, 'message' => 'Veriler başarıyla kaydedildi'));
?>
