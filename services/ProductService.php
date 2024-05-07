<?php
date_default_timezone_set('Europe/Istanbul');

function ProductServiceFunction(){

$serviceType = 1;

// Veritabanı bağlantı dosyası
require "../DevTechcon.php";

// Son işlem tarihi dosyası
require "../DevTechLastServiceDate.php";

// API bağlantı ayarları dosyası
require "../IntegratorCon.php";

// Hata mesajı
$error_message = "";

// Servis çalışma tarihi
$service_run_datetime = date('Y-m-d H:i:s');

// API URL
$url = "http://10.200.120.10:9091/(S(".$session_id."))/Integratorservice/runproc";

// JSON verisi oluşturma
$data = array(
    'ProcName' => 'sp_GiftingProduct',
    'Parameters' => array(
        array(
            'Name' => 'date',
            'Value' => $lastWorkingDate
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
    $error_message = "Update Successful";
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
            // SQL hatası
            $error_message = "SQL hatası: " . print_r(sqlsrv_errors(), true);
            break;
        }

        if (sqlsrv_has_rows($stmt_check)) {
            // Veri bulundu, güncelle
            $tsql_update = "UPDATE cdNebimProduct SET ItemCode = ?, ItemDescription = ?, ColorCode = ?, ItemDim1Code = ?, ColorThemeCode = ?, ColorThemeDescription = ?, ColorCatalogCode = ?, ColorCatalogDescription = ?, ProductHierarchyLevel01 = ?, ProductHierarchyLevel02 = ?, ProductHierarchyLevel03 = ?, ProductHierarchyLevel04 = ?, ProductHierarchyLevel05 = ? WHERE Barcode = ?";
            $params_update = array($ItemCode, $ItemDescription, $ColorCode, $ItemDim1Code, $ColorThemeCode, $ColorThemeDescription, $ColorCatalogCode, $ColorCatalogDescription, $ProductHierarchyLevel01, $ProductHierarchyLevel02, $ProductHierarchyLevel03, $ProductHierarchyLevel04, $ProductHierarchyLevel05, $barcode);
            $stmt_update = sqlsrv_query($conn, $tsql_update, $params_update);

            if ($stmt_update === false) {
                // Güncelleme hatası
                $error_message = "Güncelleme hatası: " . print_r(sqlsrv_errors(), true);
                break;
            }
        } else {
            // Veri bulunamadı, ekle
            if($barcode == null){
                $error_message = "Ekleme hatası: Barcode error";
            }else{
                $tsql_insert = "INSERT INTO cdNebimProduct (ItemCode, ItemDescription, ColorCode, ItemDim1Code, Barcode, ColorThemeCode, ColorThemeDescription, ColorCatalogCode, ColorCatalogDescription, ProductHierarchyLevel01, ProductHierarchyLevel02, ProductHierarchyLevel03, ProductHierarchyLevel04, ProductHierarchyLevel05) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $params_insert = array($ItemCode, $ItemDescription, $ColorCode, $ItemDim1Code, $barcode, $ColorThemeCode, $ColorThemeDescription, $ColorCatalogCode, $ColorCatalogDescription, $ProductHierarchyLevel01, $ProductHierarchyLevel02, $ProductHierarchyLevel03, $ProductHierarchyLevel04, $ProductHierarchyLevel05);
                $stmt_insert = sqlsrv_query($conn, $tsql_insert, $params_insert);
            }
   

            if ($stmt_insert === false) {
                // Ekleme hatası
                $error_message = "Ekleme hatası: " . print_r(sqlsrv_errors(), true);
                break;
            }
        }
    }
} else {
    // HTTP isteği hatası
    $error_message = "HTTP isteği hatası: " . error_get_last()["message"];
}

// Hata mesajını logla
if (!empty($error_message)) {
    $tsql_service_log = "INSERT INTO ServiceLog (ServiceType, ServiceName, ErrorMessage, LastWorkingDate) VALUES (?, ?, ?, ?)";
    $params_service_log = array($serviceType, 'Product Services', $error_message, $service_run_datetime);
    $stmt_error = sqlsrv_query($conn, $tsql_service_log, $params_service_log);

    if ($stmt_error === false) {
        die("Service log kaydı başarısız: " . print_r(sqlsrv_errors(), true));
    }
}

// Bağlantıyı kapat
sqlsrv_close($conn);


}

while(true){
    ProductServiceFunction();

    sleep(3600);
}
