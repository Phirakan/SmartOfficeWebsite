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
$sql = "USE bookdb;";
$conn->query($sql);
//////  ตาราง booktable //////////////
$sql ="SELECT * FROM booktable";
$result = $conn->query($sql);
if($result->num_rows > 0) {
	echo "<center>";
	echo "<table width='60%' cellpadding='5'>";
	echo "<caption align = 'center'>ข้อมูลตาราง booktable</caption>";
	echo "<tr bgcolor=#0099FF >";
	echo "<th width='100' ><font color=#FFFFFF>รหัสหนังสือ";
	echo "<th><font color=#FFFFFF>ชื่อหนังสือ";
	echo "<th><font color=#FFFFFF>ผู้แต่ง
	<th><font color=#FFFFFF>ราคา
	<th width='20%'><font color=#FFFFFF>รหัสสำนักพิมพ์";
	echo "</tr>";
	$count =0;
	while ($data = $result->fetch_array()){
	if ($count==0){
		echo "<tr bgcolor=#E0EEEE>";
		$count=1;
	}else{
		echo "<tr bgcolor=#C6E2FF>";
		$count=0;
	}
	

    echo "<td align = 'center'>".$data['book_id']."<td>".$data['title']
    ."<td>".$data['author']."<td align = 'center'>".$data['price']
    ."<td align = 'center'>".$data['pub_id'];
echo "</tr>";
}
echo "</table><p>";
echo "</center>";
}

echo "<br><br>";

//////  ตาราง publishtable //////////////
$sql ="SELECT * FROM publishtable";
$result = $conn->query($sql);
if($result->num_rows > 0) {
	echo "<center>";
	echo "<table width='60%' cellpadding='5'>";
	echo "<caption align = 'center'>ข้อมูลตาราง publishtable</caption>";
	echo "<tr bgcolor=#bc8f8f >";
	echo "<th width='100' ><font color=#FFFFFF>รหัสสำนักพิมพ์";
	echo "<th><font color=#FFFFFF>ชื่อสำนักพิมพ์";
	echo "<th><font color=#FFFFFF>ที่อยู่สำนักพิมพ์";
	echo "</tr>";
	$count =0;
	while ($data = $result->fetch_array()){
	if ($count==0){
		echo "<tr bgcolor=#E0EEEE>";
		$count=1;
	}else{
		echo "<tr bgcolor=#bc8f8f>";
		$count=0;
	}
	

    echo "<td align = 'center'>".$data['pub_id']."<td>".$data['publish_name']
    ."<td>".$data['address'];
echo "</tr>";
}
echo "</table><p>";
echo "</center>";
}
echo "<br><br>";

//////  Inner Join //////////////
$sql ="SELECT book_id, title, author, price,publish_name, address FROM booktable INNER JOIN publishtable ON booktable.pub_id = publishtable.pub_id ";
$result = $conn->query($sql);
if($result->num_rows > 0) {
	echo "<center>";
	echo "<table width='60%' cellpadding='5'>";
	echo "<caption align = 'center'>Inner Join </caption>";
	echo "<tr bgcolor=#d8bfd8 >";
	echo "<th width='100' ><font color=#FFFFFF>รหัสหนังสือ";
	echo "<th><font color=#FFFFFF>ชื่อหนังสือ";
	echo "<th><font color=#FFFFFF>ชื่อผู้แต่ง";
	echo "<th><font color=#FFFFFF>ราคา";
	echo "<th><font color=#FFFFFF>ชื่อสำนักพิมพ์";
	echo "<th><font color=#FFFFFF>ที่อยู่สำนักพิมพ์";
	echo "</tr>";
	$count =0;
	while ($data = $result->fetch_array()){
	if ($count==0){
		echo "<tr bgcolor=#E0EEEE>";
		$count=1;
	}else{
		echo "<tr bgcolor=#d8bfd8>";
		$count=0;
	}
	

    echo "<td align = 'center'>".$data['book_id']."<td>".$data['title']."<td>".$data['author']."<td>".$data['price']."<td>".$data['publish_name']."<td>".$data['address'];
    
echo "</tr>";
}
echo "</table><p>";
echo "</center>";
}

echo "<br><br>";

//////  Left Join //////////////
$sql ="SELECT * FROM booktable LEFt JOIN publishtable ON booktable.book_id = publishtable.pub_id ";
$result = $conn->query($sql);
if($result->num_rows > 0) {
	echo "<center>";
	echo "<table width='60%' cellpadding='5'>";
	echo "<caption align = 'center'>Left Join </caption>";
	echo "<tr bgcolor=#ffd700 >";
	echo "<th width='100' ><font color=#FFFFFF>รหัสหนังสือ";
	echo "<th><font color=#FFFFFF>ชื่อหนังสือ";
	echo "<th><font color=#FFFFFF>ชื่อผู้แต่ง";
	echo "<th><font color=#FFFFFF>ราคา";
	echo "<th><font color=#FFFFFF>ชื่อสำนักพิมพ์";
	echo "<th><font color=#FFFFFF>ที่อยู่สำนักพิมพ์";
	echo "</tr>";
	$count =0;
	while ($data = $result->fetch_array()){
	if ($count==0){
		echo "<tr bgcolor=#E0EEEE>";
		$count=1;
	}else{
		echo "<tr bgcolor=#ffd700>";
		$count=0;
	}
	

    echo "<td align = 'center'>".$data['book_id']."<td>".$data['title']."<td>".$data['author']."<td>".$data['price']."<td>".$data['publish_name']."<td>".$data['address'];
    
echo "</tr>";
}
echo "</table><p>";
echo "</center>";
}

echo "<br><br>";

//////  right Join //////////////
$sql ="SELECT * FROM booktable Right JOIN publishtable ON booktable.book_id = publishtable.pub_id ";
$result = $conn->query($sql);
if($result->num_rows > 0) {
	echo "<center>";
	echo "<table width='60%' cellpadding='5'>";
	echo "<caption align = 'center'>Right Join </caption>";
	echo "<tr bgcolor=#008080 >";
	echo "<th width='100' ><font color=#FFFFFF>รหัสหนังสือ";
	echo "<th><font color=#FFFFFF>ชื่อหนังสือ";
	echo "<th><font color=#FFFFFF>ชื่อผู้แต่ง";
	echo "<th><font color=#FFFFFF>ราคา";
	echo "<th><font color=#FFFFFF>ชื่อสำนักพิมพ์";
	echo "<th><font color=#FFFFFF>ที่อยู่สำนักพิมพ์";
	echo "</tr>";
	$count =0;
	while ($data = $result->fetch_array()){
	if ($count==0){
		echo "<tr bgcolor=#E0EEEE>";
		$count=1;
	}else{
		echo "<tr bgcolor=#008080>";
		$count=0;
	}
	

    echo "<td align = 'center'>".$data['book_id']."<td>".$data['title']."<td>".$data['author']."<td>".$data['price']."<td>".$data['publish_name']."<td>".$data['address'];
    
echo "</tr>";
}
echo "</table><p>";
echo "</center>";
}
echo "<br><br>";

//////  Left Join แบบมีเงื่อนไข //////////////
$sql ="SELECT * FROM booktable LEFt JOIN publishtable ON booktable.book_id = publishtable.pub_id ORDER BY price DESC";
$result = $conn->query($sql);
if($result->num_rows > 0) {
	echo "<center>";
	echo "<table width='60%' cellpadding='5'>";
	echo "<caption align = 'center'>Left Join แบบมีเงื่อนไข Priceจากมากไปน้อย </caption>";
	echo "<tr bgcolor=#ffdab9 >";
	echo "<th width='100' ><font color=#FFFFFF>รหัสหนังสือ";
	echo "<th><font color=#FFFFFF>ชื่อหนังสือ";
	echo "<th><font color=#FFFFFF>ชื่อผู้แต่ง";
	echo "<th><font color=#FFFFFF>ราคา";
	echo "<th><font color=#FFFFFF>ชื่อสำนักพิมพ์";
	echo "<th><font color=#FFFFFF>ที่อยู่สำนักพิมพ์";
	echo "</tr>";
	$count =0;
	while ($data = $result->fetch_array()){
	if ($count==0){
		echo "<tr bgcolor=#E0EEEE>";
		$count=1;
	}else{
		echo "<tr bgcolor=#ffdab9>";
		$count=0;
	}
	

    echo "<td align = 'center'>".$data['book_id']."<td>".$data['title']."<td>".$data['author']."<td>".$data['price']."<td>".$data['publish_name']."<td>".$data['address'];
    
echo "</tr>";
}
echo "</table><p>";
echo "</center>";
}

echo "<br><br>";
$conn->close();
?>
</body>
</html>
