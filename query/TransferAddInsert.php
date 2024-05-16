<?php 
require "../conn/DevTechcon.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['ProcessCode'])) {
        $processCodes = $_POST['ProcessCode'];
        $sendInfCodes = $_POST['SendInfCode'];
        $SendInfName = $_POST['SendInfName'];
        $Post = $_POST['Post'];
        $ItemCode = $_POST['ItemCode'];
        $ColorCode = $_POST['ColorCode'];
        $ItemDim1Code = $_POST['ItemDim1Code'];
        $ItemName = $_POST['ItemName'];
        $MLY_EUR = $_POST['MLY_EUR'];
        $Qty1 = $_POST['Qty1'];


        // Verileri işleyin (örneğin, veritabanına ekleyin)
        foreach ($processCodes as $index => $processCode) {
            $sendInfCode = $sendInfCodes[$index];
            // Burada $processCode ve $sendInfCode ile işlem yapın
            // Örneğin, veritabanına ekleyin
            echo "Process Code: $processCode, Send Inf Code: $sendInfCode<br>";
        }
    } else {
        echo "ProcessCode array is not set.";
    }
} else {
    echo "Form POST methodu ile gönderilmedi.";
}