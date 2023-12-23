<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<body>
<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$conn = new mysqli($servername, $username, $password);
if($conn->connect_error){
	die("Connection failed: ".$conn->connect_error);
}
$sql = "SET NAMES UTF8";
$conn->query($sql);
$sql = "DROP DATABASE IF EXISTS bookdb;";
$conn->query($sql);
$sql = "CREATE DATABASE bookdb DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;";
if ($conn->query($sql) === TRUE) {
    echo "การสร้างฐานข้อมูล bookdb สำเร็จ<br>";
} else {
    echo "<br>Error ไม่สามารถสร้างฐานข้อมูลได้ ! : " . $conn->error;
}	
$sql = "USE bookdb;";
$conn->query($sql);
$sql = "CREATE TABLE booktable 
		(book_id int(7) NOT NULL AUTO_INCREMENT
		,title VARCHAR(40) NOT NULL
		,author VARCHAR(40)
		,price INT(7)
		,pub_id INT(7)
		,PRIMARY KEY(book_id));";
if ($conn->query($sql) === TRUE) {
    	echo "สร้างตาราง booktable สำเร็จ<br>";
} else {
    	echo "<br>Error ไม่สามารถสร้างตาราง booktable ได้ ! : " . $conn->error;
}
$sql = "CREATE TABLE publishtable 
	(pub_id INT(7) NOT NULL AUTO_INCREMENT
	,publish_name VARCHAR(40) NOT NULL
	,address VARCHAR(40)
	,PRIMARY KEY(pub_id));";
if ($conn->query($sql) === TRUE) {
    echo "สร้างตาราง publishtable สำเร็จ<br>";
} else {
    echo "<br>Error ไม่สามารถสร้างตาราง publishtable ได้ ! : " . $conn->error;
}
$sql = "INSERT INTO publishtable VALUES
	(1,'SE-ED','Bangkok'),
	(2,'Chula Publisher','Bangkok'),
	(3,'ExPress','USA'),
	(4,'DevPress','JAPAN'),
	(5,'WITTY GROUP','Bangkok');";
if ($conn->query($sql) === TRUE) {
    	echo "เพิ่มข้อมูลในตาราง publishtable สำเร็จ<br>";
} else {
    	echo "<br>Error ไม่สามารถเพิ่มข้อมูลในตาราง publishtable ได้ ! : " . $conn->error;
}
$sql = "INSERT INTO booktable VALUES
	('','PHP','กิตติ',255,1),
	('','MySQL','อมรรัตน์',280,1),
	('','Harry Porter','JK Rowling',450,3),
	('','Math for IT','วิโรจน์',950,2),
	('','PHP','วิทยา',395,5);";
if ($conn->query($sql) === TRUE) {
    	echo "เพิ่มข้อมูลในตาราง booktable สำเร็จ<br>";
} else {
    	echo "<br>Error ไม่สามารถเพิ่มข้อมูลในตาราง booktable ได้ ! : " . $conn->error;
}

$conn->close();
?>
</body>
</html>