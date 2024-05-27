<?php
// MSSQL veritabanı bağlantısını dahil edin
require_once '../conn/DevTechcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $year = date("Y");
    $budget = $_POST['budget'];
    $selectedMonth = $_POST['year']; // Değişken adını 'year' olarak değiştirin

    // Başlangıç ve Bitiş tarihlerini seçilen yıl ve aya göre hesaplayın
    $startDate = $year . '-' . $selectedMonth . '-01';
    
    // MonthlyBudget tablosundan SpentBudget değerini alın
    $sqlGetSpentBudget = "SELECT SpentBudget,TotalBudget FROM MonthlyBudget WHERE YEAR(StartDate) = ? AND MONTH(StartDate) = ?";
    $paramsGetSpentBudget = array($year, $selectedMonth);
    $stmtGetSpentBudget = sqlsrv_prepare($conn, $sqlGetSpentBudget, $paramsGetSpentBudget);
    if (sqlsrv_execute($stmtGetSpentBudget)) {
        $row = sqlsrv_fetch_array($stmtGetSpentBudget, SQLSRV_FETCH_ASSOC);
        $spentBudget = $row['SpentBudget'] ?? 0;
        $TotalBudgetbefore = $row['TotalBudget'] ?? 0;
    } else {
        $spentBudget = 0;
    }
    
    // Güncellenecek bütçeyi hesapla
    $TotalBudget = $TotalBudgetbefore - $spentBudget;
    $updatedTotalBudget = $budget -$TotalBudgetbefore;
    // SQL ifadesini hazırlayın
    $sql = "UPDATE MonthlyBudget 
            SET TotalBudget = ?, SpentBudget = ?, LastUpdatedUserName = 'admin', LastUpdatedDate = SYSDATETIME()
            WHERE YEAR(StartDate) = ? AND MONTH(StartDate) = ?";

    // Veritabanı bağlantısını kullanarak sorguyu hazırlayın
    $params = array($updatedTotalBudget, $updatedTotalBudget, $year, $selectedMonth);
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    // Sorguyu çalıştırın
    if (sqlsrv_execute($stmt)) {
        $response = array('success' => true, 'message' => 'Bütçe başarıyla güncellendi.');
    } else {
        $response = array('success' => false, 'message' => 'Bütçe güncelleme sırasında bir hata oluştu: ' . print_r(sqlsrv_errors(), true));
    }

    // Sorgu kaynağını serbest bırakın
    sqlsrv_free_stmt($stmt);
} else {
    $response = array('success' => false, 'message' => 'Geçersiz istek yöntemi.');
}

// Veritabanı bağlantısını kapatın
sqlsrv_close($conn);

// Yanıtı JSON olarak döndürün
echo json_encode($response);
?>
