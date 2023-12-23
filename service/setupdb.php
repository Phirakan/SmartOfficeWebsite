<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>สร้างฐานข้อมูลและตาราง</title>
</head>
<body>
<?php
	require("../config/connectdb.php");
	$sql = "DROP DATABASE IF EXISTS roomdb;";
	$conn->query($sql);
    $sql = "CREATE DATABASE roomdb DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;";
	if ($conn->query($sql) === TRUE) {
    	echo "การสร้างฐานข้อมูลสำเร็จ<br>";
	} else {
    	echo "<br>Error ไม่สามารถสร้างฐานข้อมูลได้ ! : " . $conn->error;
	}
	
	$sql = "USE roomdb;";
	$conn->query($sql);
    $sql = "CREATE TABLE roomtable
    (id int(10), RoomName VARCHAR(25), LightBulb int(2)
    , PRIMARY KEY (id));";
if ($conn->query($sql) === TRUE) {
echo "การสร้างตาราง roomtable สำเร็จ";
} else {
die("<br>Error ไม่สามารถสร้างตาราง roomtable ได้ ! : ".$conn->error);
}
$conn->close();
?>
</body>
</html>
