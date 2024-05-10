<?php 
  
$query = "SELECT * FROM dbo.ServiceLog WHERE LastWorkingDate = (SELECT MAX(LastWorkingDate) FROM dbo.ServiceLog) AND ServiceType = $serviceType;";

$stmt_LastServiceDate = sqlsrv_query($conn, $query);

if ($stmt_LastServiceDate === false) {
    die(print_r(sqlsrv_errors(), true));
}
$lastWorkingDate = "20210503 00:00:00";
// Fetch the result
$row = sqlsrv_fetch_array($stmt_LastServiceDate, SQLSRV_FETCH_ASSOC);
if ($row) {
    echo"fsakofoafk";
    $lastWorkingDate = $row['LastWorkingDate']->format('Ymd H:i:s'); // Date stored in a variable



}
?>
