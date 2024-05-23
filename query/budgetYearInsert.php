<?php

// Bağlantı bilgilerini içeren dosyayı dahil et
require_once '../conn/DevTechcon.php';

// Bağlan
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Eğer bağlantı sağlandıysa
if ($conn) {
    // Değişkenlerin tanımlanması
    $currentYear = 2024;
    $totalBudget = 40000;
    $createdUserName = 'admin';
    $isActive = 1;

    // Ay döngüsü
    for ($month = 1; $month <= 12; $month++) {
        // Ayın başlangıç ve bitiş tarihlerini ayarla (gün kısmını 01 ve 30 olarak ayarla)
        $startDate = date_create("$currentYear-$month-01")->format('Y-m-d');
        $endDate = date_create("$currentYear-$month-01")->modify('last day of')->format('Y-m-d');

        // Veritabanına ekleme sorgusu
        $sql = "INSERT INTO MonthlyBudget (ID, StartDate, EndDate, TotalBudget,SpentBudget, LastTransferNumber, CreatedUserName, CreatedDate, LastUpdatedUserName, LastUpdatedDate, IsActive)
                VALUES (NEWID(), ?, ?, ?,0, '', ?, GETDATE(), ?, GETDATE(), ?)";
        
        $params = array($startDate, $endDate, $totalBudget, $createdUserName, $createdUserName, $isActive);
        $stmt = sqlsrv_query($conn, $sql, $params);

        // Sorgu başarılı bir şekilde çalıştıysa
        if ($stmt === false) {
            echo "Error in statement execution.\n";
            die(print_r(sqlsrv_errors(), true));
        }
    }

    // Bağlantıyı kapat
    sqlsrv_close($conn);

    // Başarılı bir şekilde işlem yapıldığını bildiren JSON yanıtı döndür
    echo json_encode(array("success" => true));
} else {
    // Bağlantı kurulamazsa hata mesajı göster
    echo json_encode(array("success" => false, "error" => "Connection could not be established: " . print_r(sqlsrv_errors(), true)));
}
?>
