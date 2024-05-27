<?php
// Bağlantı bilgilerini içeren dosyayı dahil et
require_once '../conn/DevTechcon.php';

// Bağlan
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Eğer bağlantı sağlandıysa
if ($conn) {
    // POST ile gelen yıl verisini al
    $currentYear = isset($_POST['year']) ? intval($_POST['year']) : 2024; // Varsayılan yıl 2024
    $totalBudget =0;
    $createdUserName = 'admin';
    $isActive = 1;

    // Veritabanında o yıla ait veri olup olmadığını kontrol et
    $checkSql = "SELECT COUNT(*) AS count FROM MonthlyBudget WHERE YEAR(StartDate) = ?";
    $checkParams = array($currentYear);
    $checkStmt = sqlsrv_query($conn, $checkSql, $checkParams);

    // Sorgu başarılı bir şekilde çalıştıysa
    if ($checkStmt !== false) {
        $rowCount = sqlsrv_fetch_array($checkStmt, SQLSRV_FETCH_ASSOC)['count'];
        if ($rowCount > 0) {
            // Eğer o yıla ait veri zaten varsa işlem yapmadan önce hata mesajı göster ve işlemi sonlandır
            echo json_encode(array("success" => false, "message" => "Seçilen yıl zaten veritabanında mevcut."));
            exit;
        }
    } else {
        // Hata durumunda hata mesajını döndür ve işlemi sonlandır
        echo json_encode(array("success" => false, "error" => "Veritabanında yıl kontrolü yapılırken bir hata oluştu: " . print_r(sqlsrv_errors(), true)));
        exit;
    }

    // Ay döngüsü
    for ($month = 1; $month <= 12; $month++) {
        // Ayın başlangıç ve bitiş tarihlerini ayarla (gün kısmını 01 ve 30 olarak ayarla)
        $startDate = date_create("$currentYear-$month-01")->format('Y-m-d');
        $endDate = date_create("$currentYear-$month-01")->modify('last day of')->format('Y-m-d');

        // Veritabanına ekleme sorgusu
        $sql = "INSERT INTO MonthlyBudget (ID, StartDate, EndDate, TotalBudget, SpentBudget, LastTransferNumber, CreatedUserName, CreatedDate, LastUpdatedUserName, LastUpdatedDate, IsActive)
                VALUES (NEWID(), ?, ?, ?, ?, '', ?, GETDATE(), ?, GETDATE(), ?) ";
        
        $params = array($startDate, $endDate, $totalBudget, $totalBudget, $createdUserName, $createdUserName, $isActive);
        $stmt = sqlsrv_query($conn, $sql, $params);

        // Sorgu başarılı bir şekilde çalıştıysa
        if ($stmt === false) {
            // Hata durumunda hata mesajını döndür ve işlemi sonlandır
            echo json_encode(array("success" => false, "error" => "Yıl ekleme sırasında bir hata oluştu: " . print_r(sqlsrv_errors(), true)));
            exit;
        }
    }

    // Bağlantıyı kapat
    sqlsrv_close($conn);

    // Başarılı bir şekilde işlem yapıldığını bildiren JSON yanıtı döndür
    echo json_encode(array("success" => true, "message" => "Yıl başarıyla eklendi."));
} else {
    // Bağlantı kurulamazsa hata mesajı göster
    echo json_encode(array("success" => false, "error" => "Bağlantı kurulamadı: " . print_r(sqlsrv_errors(), true)));
}
