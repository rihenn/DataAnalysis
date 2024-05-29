<?php
require "../conn/DevTechcon.php";

// Gelen JSON veriyi alın
$data = json_decode(file_get_contents("php://input"), true);

// Form verilerini işleme
$processCode = isset($data['ProcessCode']) ? $data['ProcessCode'] : null;
$sendInfCode = isset($data['SendInfCode']) ? $data['SendInfCode'] : null;
$sendInfName = isset($data['SendInfName']) ? $data['SendInfName'] : null;
$shippingCost = isset($data['ShippingCost']) ? $data['ShippingCost'] : null;
$sendDate = isset($data['SendDate']) ? $data['SendDate'] : null;




// ProcessCode değerine göre insert sorgusunu ayarlama
if ($processCode === 'GF') {
    $sql = "INSERT INTO trSendingHeader (
                ID, ProcessCode, TransferNumber, ShippingCostPrice, SendDate, SendInfCode, SendInfName,
                CreatedUserName, CreatedDate, LastUpdatedUserName, LastUpdatedDate, IsActive
            ) OUTPUT INSERTED.ID, INSERTED.TransferNumber, INSERTED.SendDate VALUES (
                NEWID(), ?, CONCAT('1-GF-', NEXT VALUE FOR gfid), ?, ?, ?, ?, 'ADMIN', GETDATE(), 'ADMIN', GETDATE(), '1'
            );";
} else {
    $sql = "INSERT INTO trSendingHeader (
                ID, ProcessCode, TransferNumber, ShippingCostPrice, SendDate, SendInfCode, SendInfName,
                CreatedUserName, CreatedDate, LastUpdatedUserName, LastUpdatedDate, IsActive
            ) OUTPUT INSERTED.ID, INSERTED.TransferNumber, INSERTED.SendDate VALUES (
                NEWID(), ?, CONCAT('1-SD-', NEXT VALUE FOR sdid), ?, ?, ?, ?, 'ADMIN', GETDATE(), 'ADMIN', GETDATE(), '1'
            );";
}

$params = array($processCode, $shippingCost, $sendDate, $sendInfCode, $sendInfName);

// SQL sorgusunu hazırlayın ve çalıştırın
$stmt = sqlsrv_prepare($conn, $sql, $params);


if (sqlsrv_execute($stmt)) {
    sqlsrv_fetch($stmt);
    $headerID = sqlsrv_get_field($stmt, 0);
    $transferNumber = sqlsrv_get_field($stmt, 1); // TransferNumber değerini alın
    $sendDateOutput = sqlsrv_get_field($stmt, 2); // SendDate değerini alın
    echo json_encode(["status" => "success", "headerID" => $headerID, "transferNumber" => $transferNumber, "sendDate" => $sendDateOutput]);
} else {
    echo json_encode(["status" => "error", "message" => "Kayıt ekleme başarısız."]);
    print_r(sqlsrv_errors());
    exit;
}

sqlsrv_close($conn);
?>
