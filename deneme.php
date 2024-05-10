<?php
require './conn/DevTechcon.php';

// MSSQL sunucusuna bağlan
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn) {
    // Veri tabanından veri çekme sorgusu
    $sql = "SELECT * FROM cdInfluecer";
    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Verileri tabloya eklemeq
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
               
        echo  $row['Code'];
        echo  $row['FirstName'] . " " . $row['LastName'] ; 
        echo  $row['CountryCode'] ; 
        echo  $row['Country'] ; 
        echo  $row['City'] ; 
        echo  $row['Address'] ; 
        echo  $row['CreatedUserName'] ; 
        echo  $row['CreatedDate']->format('Y-m-d H:i:s') ;
        echo  $row['LastUpdatedUserName'] ; 
        echo  $row['LastUpdatedDate']->format('Y-m-d H:i:s') ;
        echo  $row['IsActive'] ;
       
    } 
    

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
} else {
    echo "Connection could not be established.<br />";
    die(print_r(sqlsrv_errors(), true));
}