<?php
date_default_timezone_set('Europe/Istanbul');


function PriceServiceFunction () {
    $serviceType = 2;
 require "../conn/DevTechcon.php";

require "../conn/IntegratorCon.php";

  
if ($lastWorkingDate == null) {
  $lastWorkingDate ="20210101";
}

$service_run_datetime = date('Y-m-d H:i:s');
// API URL
$url = 'http://10.200.120.10:9091/(S('.$session_id.'))/Integratorservice/runproc?%7B"ProcName":"sp_GiftingPrice"%7D';

// JSON verisi oluşturma
$data = array(
    'ProcName' => 'sp_GiftingPrice',
    'Parameters' => array(
        array(
            'Name' => 'date',
            'Value' => $lastWorkingDate  // $lastWorkingDate değişkeninizin değeri
        )
    )
);

// JSON formatına dönüştürme
$data_json = json_encode($data); 

// HTTP isteği başlıkları
$options = array(
    'http' => array(
        'header' => "Content-Type: application/json\r\n",
        'method' => 'POST',
        'content' => $data_json
    )
);

// HTTP isteği gönderme
$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);
// Gelen veriler


if ($result !== false) {
    $result_data = json_decode($result, true);

    foreach ($result_data as $row) {


        $barcode = $row["Barcode"];
        $ProductCode = $row["ProductCode"];
        $ColorCode = $row["ColorCode"];
        $ItemDim1Code = $row["ItemDim1Code"];
        $PSF_TRY = $row["PSF_TRY"];
        $PSF_EUR = $row["PSF_EUR"];
        $PSF_USD = $row["PSF_USD"];
        $MLY_EUR = $row["MLY_EUR"];




// Veritabanında gelen Barcode değerini kontrol et
$tsql_check = "SELECT * FROM cdNebimPrice WHERE Barcode = ?";
$params_check = array($barcode);
$stmt_check = sqlsrv_query($conn, $tsql_check, $params_check);
if ($stmt_check === false) {
    
      $error_message = sqlsrv_errors();
            $tsql_service_log = "INSERT INTO ServiceLog (ServiceType, ServiceName,ErrorMessage,LastWorkingDate) VALUES ('2', 'Price Services', ?,?)";
            $params_service_log = array($error_message, $service_run_datetime);
            $stmt_error = sqlsrv_query($conn, $tsql_service_log, $params_service_log);
}

if (sqlsrv_has_rows($stmt_check)) {
    // Eğer veritabanında gelen Barcode değerine sahip bir kayıt varsa, güncelleme yap
    $tsql_update = "UPDATE cdNebimPrice SET ProductCode = ?,ColorCode = ?,ItemDim1Code = ?,PSF_TRY = ?,PSF_EUR = ?,PSF_USD = ?,MLY_EUR = ? WHERE Barcode = ?";
    $params_update = array($ProductCode,$ColorCode,$ItemDim1Code,$PSF_TRY,$PSF_EUR,$PSF_USD,$MLY_EUR,$barcode);
    $stmt_update = sqlsrv_query($conn, $tsql_update, $params_update);
 
    if ($stmt_update === false) {

        $error_message = sqlsrv_errors();
        $tsql_service_log = "INSERT INTO ServiceLog (ServiceType, ServiceName,ErrorMessage,LastWorkingDate) VALUES ('2', 'Price Services', ?,?)";
        $params_service_log = array($error_message, $service_run_datetime);
        $stmt_error = sqlsrv_query($conn, $tsql_service_log, $params_service_log);
    }

} else {
    // Eğer veritabanında gelen Barcode değerine sahip bir kayıt yoksa, yeni kayıt ekle
    $tsql_insert = "INSERT INTO cdNebimPrice (Barcode, ProductCode, ColorCode, ItemDim1Code, PSF_TRY, PSF_EUR, PSF_USD, MLY_EUR) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $params_insert = array($barcode,$ProductCode,$ColorCode,$ItemDim1Code,$PSF_TRY,$PSF_EUR,$PSF_USD,$MLY_EUR);
    $stmt_insert = sqlsrv_query($conn, $tsql_insert, $params_insert);

    if ($stmt_insert === false) {

        $error_message =sqlsrv_errors();
        $tsql_service_log = "INSERT INTO ServiceLog (ServiceType, ServiceName,ErrorMessage,LastWorkingDate) VALUES ('2', 'Price Services', ?,?)";
        $params_service_log = array($error_message, $service_run_datetime);
        $stmt_error = sqlsrv_query($conn, $tsql_service_log, $params_service_log);
    }

}
    }
    $error_message = "Update Successful";
    $tsql_service_log = "INSERT INTO ServiceLog (ServiceType, ServiceName,ErrorMessage,LastWorkingDate) VALUES ('2', 'Price Services', ?,?)";
    $params_service_log = array($error_message, $service_run_datetime);
    $stmt_error = sqlsrv_query($conn, $tsql_service_log, $params_service_log);
}
// Bağlantıyı kapat
sqlsrv_close($conn);
}


while (true) {
    
 
    // Fonksiyonu çağırv
    PriceServiceFunction();

    // 1 saat beklemek için
    sleep(3600); // 3600 saniye = 1 saat
}