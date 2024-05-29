<?php
// Hata ayıklama için hata raporlamayı kapat
 

// Veritabanı bağlantısını dahil et
require "../conn/DevTechcon.php";

// Veritabanı bağlantısını kur
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(json_encode(array('success' => false, 'message' => 'Veritabanı bağlantısı kurulamadı', 'errors' => sqlsrv_errors())));
}

// Gelen JSON verilerini al ve çözümle
$data = json_decode(file_get_contents('php://input'), true);

// Gelen verileri al ve kontrol et
$infCode = $data['infcode'];
$attributeType = $data['attributeType'];
$attributeValue = $data['attributeValue'];
$newAttributeType = $data['newAttributeType'];
$newAttributeValue = $data['newAttributeValue'];
    
// Verileri loglayın
error_log("Received data: " . print_r($data, true));

// SQL sorgusunu hazırlayın
$sql = "UPDATE prInfluecerAttribute 
        SET AttributeTypeCode = ?, AttributeCode = ?, LastUpdatedUserName = 'admin', LastUpdateDate = GETDATE() 
        WHERE InfluecerCode = ? AND AttributeTypeCode = ? AND AttributeCode = ?";
$params = array($newAttributeType, $newAttributeValue, $infCode, $attributeType, $attributeValue);

// Sorguyu çalıştırmadan önce loglayın
error_log("SQL Sorgusu: " . $sql);
error_log("Parametreler: " . print_r($params, true));

// Sorguyu çalıştırın
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    $errors = sqlsrv_errors();
    error_log("SQLSRV Hataları: " . print_r($errors, true));
    echo json_encode(array('success' => false, 'message' => 'Sorgu çalıştırılamadı', 'errors' => $errors));
} else {
    echo json_encode(array('success' => true, 'message' => 'Kayıt başarıyla güncellendi'));
}

// Bağlantıyı kapatın
sqlsrv_close($conn);
?>
