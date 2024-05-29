<?php
require './conn/DevTechcon.php';

// Veritabanına bağlan
$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$influencerCode = $_POST['InfluencerCode'];
$firstName = $_POST['FirstName'];
$lastName = $_POST['LastName'];
$attributeTypeCode = $_POST['AttributeTypeCode'];
$attributeCode = $_POST['AttributeCode'];
$createdUserName = "your_username"; // Bunu dinamik olarak alabilirsiniz
$createdDate = date("Y-m-d H:i:s");
$lastUpdatedUserName = "your_username"; // Bunu dinamik olarak alabilirsiniz
$lastUpdateDate = date("Y-m-d H:i:s");
$isActive = 1;

$sql = "INSERT INTO prInfluencerAttribute (InfluencerCode, FirstName, LastName, AttributeTypeCode, AttributeCode, CreatedUserName, CreatedDate, LastUpdatedUserName, LastUpdateDate, IsActive) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssi", $influencerCode, $firstName, $lastName, $attributeTypeCode, $attributeCode, $createdUserName, $createdDate, $lastUpdatedUserName, $lastUpdateDate, $isActive);

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
