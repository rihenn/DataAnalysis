<?php
require "../IntegratorCon.php";
require "../DevTechcon.php";

// API URL
$url = 'http://10.200.120.10:9091/(S('.$session_id.'))/Integratorservice/runproc?%7B"ProcName":"sp_GiftingStock","Parameters":[%7B"Name":"LangCode","Value":"tr"%7D]%7D';

// JSON verisi oluşturma
$data = array(
    'ProcName' => 'sp_GiftingStock',
    'Parameters' => array(
        array(
            'Name' => 'LangCode',
            'Value' => 'tr'
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
        $Renk = $row["Renk"];
        $Beden = $row["Beden"];
        $Warehouse1InventoryQty = $row["Warehouse1InventoryQty"];
       




// Veritabanında gelen Barcode değerini kontrol et
$tsql_check = "SELECT * FROM cdNebimStock WHERE Barcode = ?";
$params_check = array($barcode);
$stmt_check = sqlsrv_query($conn, $tsql_check, $params_check);
if ($stmt_check === false) {
    die(print_r(sqlsrv_errors(), true));
}

if (sqlsrv_has_rows($stmt_check)) {
    // Eğer veritabanında gelen Barcode değerine sahip bir kayıt varsa, güncelleme yap
    $tsql_update = "UPDATE cdNebimStock SET ProductCode = ?,ColorCode = ?,ItemDim1Code = ?,Warehouse1InventoryQty = ? WHERE Barcode = ?";
    $params_update = array($ProductCode,$Renk,$Beden,$Warehouse1InventoryQty,$barcode);
    $stmt_update = sqlsrv_query($conn, $tsql_update, $params_update);
    if ($stmt_update === false) {
        die(print_r(sqlsrv_errors(), true));
    }

} else {
    // Eğer veritabanında gelen Barcode değerine sahip bir kayıt yoksa, yeni kayıt ekle
    $tsql_insert = "INSERT INTO cdNebimStock (Barcode, ProductCode, ColorCode, ItemDim1Code, Warehouse1InventoryQty) VALUES (?, ? , ?, ?, ?)";
    $params_insert = array($barcode,$ProductCode,$Renk,$Renk,$Warehouse1InventoryQty);
    $stmt_insert = sqlsrv_query($conn, $tsql_insert, $params_insert);
    if ($stmt_insert === false) {
        die(print_r(sqlsrv_errors(), true));
    }

}
    }
}
// Bağlantıyı kapat
sqlsrv_close($conn);

?>