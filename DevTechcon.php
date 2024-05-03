<?php 
$serverName = "10.200.120.10";
$instanceName = "SQLEXPRESS";
$connectionOptions = array(
    "Database" => "DevTech",
    "Uid" => "sa", 
    "PWD" => "tAVEyoiDgiZoTg3jNV2s",
    "CharacterSet" => "UTF-8",
);

// SQL Server örneği ekleniyor
$serverName .= "\\" . $instanceName;

// İkinci veritabanına bağlan
$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}