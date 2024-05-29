<?php
require '../conn/DevTechcon.php';

// JSON girişini al
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['infCode']) && isset($data['attributeType']) && isset($data['attributeValue'])) {
    echo $data['FirstName'];
    $infCode = $data['infCode'];
    $attributeType = $data['attributeType'];
    $attributeValue = $data['attributeValue'];

    // Güncelleme sorgusu
    $sql = "UPDATE prInfluecerAttribute 
            SET AttributeTypeCode = ?, AttributeCode = ? 
            WHERE InfluecerCode = ?";

    // SQL sorgusunu hazırlama
    $stmt = sqlsrv_prepare($conn, $sql, array($attributeType, $attributeValue, $infCode) );

    if ($stmt) {
        // Sorguyu yürütme
        if (sqlsrv_execute($stmt)) {
            echo json_encode(['success' => true, 'FirstName' => $data['firstName'], 'LastName' => $data['lastName'], 'AttributeName' => $attributeType, 'Attribute' => $attributeValue]);
        } else {
            $errors = sqlsrv_errors();
            error_log("SQLSRV Execute Error: " . print_r($errors, true));
            echo json_encode(['success' => false, 'error' => $errors]);
        }
    } else {
        $errors = sqlsrv_errors();
        error_log("SQLSRV Prepare Error: " . print_r($errors, true));
        echo json_encode(['success' => false, 'error' => $errors]);
    }

    // Bağlantıyı kapatma
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
} else {
    error_log("Gerekli alanlar eksik: " . print_r($data, true));
    echo json_encode(['success' => false, 'error' => 'Gerekli alanlar eksik.']);
}
?>
