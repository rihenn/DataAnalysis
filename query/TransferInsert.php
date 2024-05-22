<?php 

require "../conn/DevTechcon.php";

// Gelen JSON veriyi alın
$data = json_decode(file_get_contents("php://input"), true);

// Form verilerini işleme
$barcode = isset($data['barcode']) ? $data['barcode'] : null;
$transferNumber = isset($data['transferNumber']) ? $data['transferNumber'] : null;
$PlatformCode = isset($data['PlatformCode']) ? $data['PlatformCode'] : null;
$ContentName = isset($data['ContentName']) ? $data['ContentName'] : null;
$ShareDate = isset($data['ShareDate']) ? $data['ShareDate'] : null;
$LikeCount = isset($data['LikeCount']) ? $data['LikeCount'] : null;
$WievCount = isset($data['WievCount']) ? $data['WievCount'] : null;
$PlatformName = isset($data['PlatformName']) ? $data['PlatformName'] : null;
$ContentCode = isset($data['ContentCode']) ? $data['ContentCode'] : null;




// ProcessCode değerine göre insert sorgusunu ayarlama

    $sql = "insert into prSendingAttribute ( TransferNumber, PlatformCode, PlatformName, ContentCode, ContentName, ShareDate,
    LikeCount, ViewCount, CreatedUserName, CreatedDate, LastUpdatedUserName,
    LastUpdatedDate, IsActive)
values (?,?,?,?,?,?,?,?, GETDATE(),'admin', GETDATE(),'admin','1');";
    
$params = array($transferNumber, $PlatformCode, $PlatformName, $ContentCode,$ContentName,$ShareDate,$LikeCount,$WievCount);

// SQL sorgusunu hazırlayın ve çalıştırın
$stmt = sqlsrv_prepare($conn, $sql, $params);

if ($stmt === false) {
    echo json_encode(["status" => "error", "message" => "Sorgu hazırlanırken hata oluştu."]);
    die(print_r(sqlsrv_errors(), true));
}

if (sqlsrv_execute($stmt)) {
    sqlsrv_fetch($stmt);
    $headerID = sqlsrv_get_field($stmt, 0);

} else {
    echo json_encode(["status" => "error", "message" => "Kayıt ekleme başarısız."]);
    print_r(sqlsrv_errors());
}

sqlsrv_close($conn);