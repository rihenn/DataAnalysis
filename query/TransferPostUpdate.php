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
    $platformCode = $data['platformCode'];
    $platformName = $data['platformName'];
    $contentCode = $data['contentCode'];
    $contentName = $data['contentName'];
    $shareDate = $data['shareDate'];
    $likeCount = isset($data['likeCount']) ? $data['likeCount'] : 0;
    $viewCount = isset($data['viewCount']) ? $data['viewCount'] : 0;

    // SQL güncelleme sorgusu
    $sql = "UPDATE prSendingAttribute SET 
            PlatformCode = ?, 
            PlatformName = ?, 
            ContentCode = ?, 
            ContentName = ?, 
            ShareDate = ?, 
            LikeCount = ?, 
            ViewCount = ?
            WHERE TransferNumber = ? AND Barcode = ?";

    $params = array($platformCode, $platformName, $contentCode, $contentName, $shareDate, $likeCount, $viewCount, $transferNumber, $barcode);

    // Bağlantıyı oluştur
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if ($conn === false) {
        die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . print_r(sqlsrv_errors(), true)]));
    }

    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if ($stmt) {
        if (sqlsrv_execute($stmt)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Execute failed: ' . print_r(sqlsrv_errors(), true)]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . print_r(sqlsrv_errors(), true)]);
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gerekli veriler eksik.']);
}
?>
