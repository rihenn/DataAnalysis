<?php
date_default_timezone_set('Europe/Istanbul');

function ProductServiceFunction(){
require "../DevTechcon.php"; // Bu dosyanın nerede olduğuna bağlı olarak yolunu güncellemelisiniz.
require "../DevTechLastServiceDate.php";
require "../IntegratorCon.php";


// API URL
$apiUrl = "http://10.200.120.10:9091/(S(".$session_id."))/Integratorservice/runproc";

// JSON verisi oluşturma
$data = array(
    'ProcName' => 'sp_GiftingProduct',
    'Parameters' => array(
        array(
            'Name' => 'date',
            'Value' => $lastWorkingDate  // $lastWorkingDate değişkeninizin değeri
        )
    )
);

// JSON verisini string'e çevir
$jsonData = json_encode($data);

// HTTP isteği başlıkları
$options = array(
    'http' => array(
        'header' => "Content-Type: application/json\r\nContent-Length: " . strlen($jsonData) . "\r\n",
        'method' => 'POST',
        'content' => $jsonData  // Burada jsonData değişkenini kullanın
    )
);

// HTTP isteği gönderme
$context = stream_context_create($options);
$result = file_get_contents($apiUrl, false, $context);  // Burada apiUrl değişkenini kullanın


// Gelen veriler
if ($result !== false) {
    $result_data = json_decode($result, true);
      $service_run_datetime = date('Y-m-d H:i:s');
    foreach ($result_data as $row) {
        $ItemCode = $row["ItemCode"];
        $ItemDescription = $row["ItemDescription"];
        $ColorCode = $row["ColorCode"];
        $ItemDim1Code = $row["ItemDim1Code"];
        $barcode = $row["Barcode"];
        $ColorThemeCode = $row["ColorThemeCode"];
        $ColorThemeDescription = $row["ColorThemeDescription"];
        $ColorCatalogCode = $row["ColorCatalogCode"];
        $ColorCatalogDescription = $row["ColorCatalogDescription"];
        $ProductHierarchyLevel01 = $row["ProductHierarchyLevel01"];
        $ProductHierarchyLevel02 = $row["ProductHierarchyLevel02"];
        $ProductHierarchyLevel03 = $row["ProductHierarchyLevel03"];
        $ProductHierarchyLevel04 = $row["ProductHierarchyLevel04"];
        $ProductHierarchyLevel05 = $row["ProductHierarchyLevel05"];
      
        // Veritabanında gelen Barcode değerini kontrol et
        $tsql_check = "SELECT * FROM cdNebimProduct WHERE Barcode = ?";
        $params_check = array($barcode);
        $stmt_check = sqlsrv_query($conn, $tsql_check, $params_check);
        if ($stmt_check === false) {
      

            // Eğer veritabanında gelen Barcode değerine sahip bir kayıt yoksa, yeni kayıt ekle
            $tsql_insert = "INSERT INTO cdNebimProduct (ItemCode, ItemDescription, ColorCode, ItemDim1Code, Barcode, ColorThemeCode, ColorThemeDescription, ColorCatalogCode, ColorCatalogDescription, ProductHierarchyLevel01, ProductHierarchyLevel02, ProductHierarchyLevel03, ProductHierarchyLevel04, ProductHierarchyLevel05) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $params_insert = array($ItemCode, $ItemDescription, $ColorCode, $ItemDim1Code, $barcode, $ColorThemeCode, $ColorThemeDescription, $ColorCatalogCode, $ColorCatalogDescription, $ProductHierarchyLevel01, $ProductHierarchyLevel02, $ProductHierarchyLevel03, $ProductHierarchyLevel04, $ProductHierarchyLevel05);
            $stmt_insert = sqlsrv_query($conn, $tsql_insert, $params_insert);
            if ($stmt_insert === false) {
                $error_message = "Update failed: " . print_r(sqlsrv_errors(), true);
                $tsql_service_log = "INSERT INTO ServiceLog (ServiceType, ServiceName,ErrorMessage,LastWorkingDate) VALUES ('1', 'Product Services', ?,?)";
                $params_service_log = array($error_message, $service_run_datetime);
                $stmt_error = sqlsrv_query($conn, $tsql_service_log, $params_service_log);
            }
           
           
        } else {
           
            // Eğer veritabanında gelen Barcode değerine sahip bir kayıt varsa, güncelleme yap
            $tsql_update = "UPDATE cdNebimProduct SET ItemCode = ?, ItemDescription = ?, ColorCode = ?, ItemDim1Code = ?, ColorThemeCode = ?, ColorThemeDescription = ?, ColorCatalogCode = ?, ColorCatalogDescription = ?, ProductHierarchyLevel01 = ?, ProductHierarchyLevel02 = ?, ProductHierarchyLevel03 = ?, ProductHierarchyLevel04 = ?, ProductHierarchyLevel05 = ? WHERE Barcode = ?";
            $params_update = array($ItemCode, $ItemDescription, $ColorCode, $ItemDim1Code, $ColorThemeCode, $ColorThemeDescription, $ColorCatalogCode, $ColorCatalogDescription, $ProductHierarchyLevel01, $ProductHierarchyLevel02, $ProductHierarchyLevel03, $ProductHierarchyLevel04, $ProductHierarchyLevel05, $barcode);
            $stmt_update = sqlsrv_query($conn, $tsql_update, $params_update);

            if ($stmt_update === false) {
                // Güncelleme başarısız olduğunda hata mesajını al
                $error_message = "Update failed: " . print_r(sqlsrv_errors(), true);


                // ServiceLog tablosuna hata mesajını ve güncelleme tarihini kaydet
                $tsql_service_log = "INSERT INTO ServiceLog (ServiceType, ServiceName, ErrorMessage, LastWorkingDate) VALUES ('2', 'Price Services', ?, ?)";
                $params_service_log = array($error_message, $service_run_datetime);
                $stmt_error = sqlsrv_query($conn, $error_message, $params_service_log);
            }
        }
    }
    $error_message = "Update Successful";
  
    // ServiceLog tablosuna hata mesajını ve güncelleme tarihini kaydet
    $tsql_service_log = "INSERT INTO ServiceLog (ServiceType, ServiceName, ErrorMessage, LastWorkingDate) VALUES ('1', 'Product Services', ?, ?)";
    $params_service_log = array($error_message, $service_run_datetime);
    $stmt_error = sqlsrv_query($conn, $tsql_service_log, $params_service_log);

    
    sqlsrv_close($conn);
    }
    
}




while (true) {
    
 
    // Fonksiyonu çağırv
    ProductServiceFunction();

    // 1 saat beklemek için
    sleep(3600); // 3600 saniye = 1 saat
}