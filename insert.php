<?php
// Veritabanı bağlantısı
require '../conn/DevTechcon.php';

// Formdan gelen verileri al
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$countryCode = $_POST['countryCode'];
$country = $_POST['country'];
$city = $_POST['city'];
$address = $_POST['address'];

// Ekleme işlemi için SQL sorgusu
$sql = "INSERT INTO cdInfluecer (FirstName, LastName,  CountryCode, Country, City, Address, CreatedUserName, CreatedDate, LastUpdatedUserName, LastUpdatedDate, IsActive) 
VALUES (?, ?,  ?, ?, ?, ?, 'Admin', GETDATE(), 'Admin', GETDATE(), 1)";

// Sorguyu hazırla
$stmt = sqlsrv_prepare($conn, $sql, array(&$firstName, &$lastName, &$influenceNationality, &$countryCode, &$country, &$city, &$address));
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Sorguyu çalıştır
if (sqlsrv_execute($stmt)) {
    echo "Kayıt başarıyla eklendi!";
} else {
    echo "Kayıt ekleme işlemi başarısız oldu: " . sqlsrv_errors();
}

// Bağlantıyı kapat
sqlsrv_close($conn);
?>
