<?php
require "../conn/DevTechcon.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['ProcessCode'])) {
        $processCodes = $_POST['ProcessCode'];
        $sendInfCodes = $_POST['SendInfCode'];
        $sendInfNames = $_POST['SendInfName'];
  
        $barcodes = $_POST['ItemBarcode'];
        $itemCodes = $_POST['ItemCode'];
        $colorCodes = $_POST['ColorCode'];
        $itemDim1Codes = $_POST['ItemDim1Code'];
        $itemNames = $_POST['ItemName'];
        $MLY_EURs = $_POST['MLY_EUR'];
        $qty1s = $_POST['Qty1'];
        $shippingcost = $_POST['shippingcost'];

        

        foreach ($barcodes as $index => $barcode) {

            $MLY_EUR = floatval($MLY_EURs[$index]);
            $sendInfCode = $sendInfCodes[0]; // Doğru indeksi alın
            $sendInfName = $sendInfNames[0]; // Doğru indeksi alın
            $itemCode = $itemCodes[$index];
            $colorCode = $colorCodes[$index];
            $itemDim1Code = $itemDim1Codes[$index];
            $itemName = $itemNames[$index];
            $qty1 = intval($qty1s[$index]);

            if ($processCodes["0"] === "GF") {
                $transferNumberQuery = "SELECT CONCAT('1-GF-', NEXT VALUE FOR gfid) AS TransferNumber";
            } else {
                $transferNumberQuery = "SELECT CONCAT('1-SD-', NEXT VALUE FOR sdid) AS TransferNumber";
            }

            $transferNumberStmt = sqlsrv_query($conn, $transferNumberQuery);
            if ($transferNumberStmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            sqlsrv_fetch($transferNumberStmt);
            $transferNumber = sqlsrv_get_field($transferNumberStmt, 0);

            $sql = "INSERT INTO trSendingHeader (
                ID, ProcessCode, TransferNumber, ShippingCostPrice, SendDate, SendInfCode, SendInfName,
                CreatedUserName, CreatedDate, LastUpdatedUserName, LastUpdatedDate, IsActive
            ) OUTPUT INSERTED.ID VALUES (
                NEWID(), ?, ?, ?, GETDATE(), ?, ?, 'ADMIN', GETDATE(), 'ADMIN', GETDATE(), '1'
            );";

            $params = array($processCodes[0], $transferNumber, $shippingcost, $sendInfCode, $sendInfName);

            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            // Sorguyu çalıştırın
            if (sqlsrv_execute($stmt)) {
                // Yeni eklenen ID'yi alın
                $newId = null;
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    $newId = $row['ID'];
                }

                if ($newId !== null) {
              
                    for ($i=0; $i < $qty1; $i++) { 
                      $shippingcostprice =   $shippingcost[0] ;           // trSendingLine tablosuna veri ekleyin
                      $total =  $shippingcostprice/$qty1;
      
                  
                    $sqlLine = "INSERT INTO trSendingLine (
                        SendingLineID, ProcessCode, TransferNumber, Barcode, ItemCode, ColorCode, ItemDim1Code,
                        ItemDescription, ColorDescription, ItemCostPrice, ShippingCostPrice, Qty1, Post, InfCode,
                        InfName, SendDate, SendingHeaderID, CreatedUserName, CreatedDate, LastUpdatedUserName,
                        LastUpdatedDate, IsActive
                    ) VALUES (
                        NEWID(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, GETDATE(), ?, 'ADMIN', GETDATE(), 'ADMIN', GETDATE(), '1'
                    );";
    
                    $paramsLine = array(
                        $processCodes["0"],
                        $transferNumber,
                        $barcode,
                        $itemCode,
                        $colorCode,
                        $itemDim1Code,
                        $itemName,
                        $colorCode, // Renk açıklaması olduğunu varsayalım
                        $MLY_EUR,
                        $total , // Nakliye maliyeti, Ürün maliyetine eşit olduğunu varsayalım
                        "1",
                        "1",
                        $sendInfCode,
                        $sendInfName,
                        $newId // SendingHeaderID
                    );
    
                    $stmtLine = sqlsrv_prepare($conn, $sqlLine, $paramsLine);
                    if ($stmtLine === false) {
                        die(print_r(sqlsrv_errors(), true));
                    }
    
                    if (sqlsrv_execute($stmtLine)) {
                        echo "True";
                    } else {
                        echo "trSendingLine kaydı ekleme işlemi başarısız oldu: ";
                        print_r(sqlsrv_errors());
                    }
                    }
                    
    
                } else {
                    echo "Yeni ID alınamadı.";
                }
            } else {
                echo "Kayıt ekleme işlemi başarısız oldu: ";
                print_r(sqlsrv_errors());
            }
        }
    } else {
        echo "ProcessCode dizisi belirtil";
    }
}