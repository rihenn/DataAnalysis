<?php
// Veritabanı bağlantısını dahil et
require './conn/DevTechcon.php';

// Veritabanına bağlan
$conn = sqlsrv_connect($serverName, $connectionOptions);

header('Content-Type: application/json; charset=utf-8'); // JSON çıktısı için başlık ekleyin

$infCode = $_GET['infCode'];

// Güvenli bir şekilde infCode değerini doğrulayın
$infCode = htmlspecialchars($infCode, ENT_QUOTES, 'UTF-8');

$sql = "SELECT 
prInfluecerAttribute.InfluecerCode,
prInfluecerAttribute.FirstName,
prInfluecerAttribute.LastName,
cdInfluecerAttribute.AttributeTypeCode,
cdInfluecerAttribute.AttributeName,
cdInfluecerAttribute.AttributeCode,
cdInfluecerAttribute.Attribute
FROM
prInfluecerAttribute
INNER JOIN
cdInfluecerAttribute 
ON
prInfluecerAttribute.AttributeTypeCode = cdInfluecerAttribute.AttributeTypeCode
AND prInfluecerAttribute.AttributeCode = cdInfluecerAttribute.AttributeCode
WHERE
prInfluecerAttribute.IsActive = 1
AND cdInfluecerAttribute.IsActive = 1
AND prInfluecerAttribute.InfluecerCode = ?";
$params = array($infCode);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    echo json_encode(array("error" => "Veritabanı hatası: " . print_r(sqlsrv_errors(), true)));
    exit;
}

$data = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $data[] = $row;
}

// JSON formatında veriyi döndür
echo json_encode($data);

// Sorguyu kapat
sqlsrv_free_stmt($stmt);

// Veritabanı bağlantısını kapat
sqlsrv_close($conn);
?>
