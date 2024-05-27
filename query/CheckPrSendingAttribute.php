<?php
require '../conn/DevTechcon.php';

// Yanıtın JSON formatında olduğunu belirtin
header('Content-Type: application/json');

// POST verilerini alın
$transferNumber = isset($_POST['transferNumber']) ? $_POST['transferNumber'] : '';
$barcode = isset($_POST['barcode']) ? $_POST['barcode'] : '';

// Yanıtı başlat
$response = array('post' => null, 'error' => ''); // Varsayılan olarak null yapıyoruz

// Gelen verileri kontrol etmek için hata ayıklama mesajları ekleyelim
if (empty($transferNumber) || empty($barcode)) {
    $response['error'] = 'Geçersiz transferNumber veya barcode';
    echo json_encode($response);
    exit;
}

// Veritabanında sorgu yap
$query = "SELECT post FROM trSendingLine WHERE TransferNumber = ? AND Barcode = ?";
$params = array($transferNumber, $barcode);
$stmt = sqlsrv_query($conn, $query, $params);

if ($stmt === false) {
    $response['error'] = "Sorgu hatası: " . print_r(sqlsrv_errors(), true);
} else {
    if (sqlsrv_has_rows($stmt)) {
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $response['post'] = $row['post']; // Veritabanındaki post değeri
    } else {
        $response['error'] = "Kayıt bulunamadı.";
    }
}

echo json_encode($response);

if ($stmt !== false) {
    sqlsrv_free_stmt($stmt);
}
sqlsrv_close($conn);
?>
