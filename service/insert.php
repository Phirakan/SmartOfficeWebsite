<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>เพิ่มข้อมูลผู้ใช้</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link href="../css/insertform.css" rel="stylesheet">

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Smart Green Office</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Solutions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../Page/dashboard.php">
                        <img src="../upload/dashboard.png" alt="Dashboard" class="dashboard-icon">
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
<div class="container"></div>
	<?php
	$send = (isset($_POST['send']) ? $_POST['send'] : '');
	if ($send == '') {
		
	?>
	<div class="container-fluid">
		<h2>แบบฟอร์มการเพิ่มข้อมูล</h2>
		<form method="post" action="">
			<p>
				หมายเลขห้อง <input type="text" name="id">
			<p>
				ชื่อห้อง <input type="text" name="RoomName">
			<p>
				จำนวนเครื่องใช่ไฟฟ้า<input type="text" name="LightBulb">
			
				<input type="submit" name="send" value="Submit">
				<input type="reset" name="cancel" value="Reset"><br><br>
				<a href=../Page/authentication/index.php>กลับไปเมนูผู้ดูแลระบบ</a>
		</form>
		</div>
	<?php
	} else {
    $id = (isset($_POST['id']) ? $_POST['id'] : '');
    $RoomName = (isset($_POST['RoomName']) ? $_POST['RoomName'] : '');
    $LightBulb = (isset($_POST['LightBulb']) ? $_POST['LightBulb'] : '');

    require("../config/connectdb.php");
    $sql = "USE roomdb";
    $conn->query($sql);

    // Check if id or RoomName already exists
    $checkQuery = "SELECT * FROM roomtable WHERE id = '$id' OR RoomName = '$RoomName'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        // Record already exists
        echo '<div class="alert alert-warning" role="alert">';
        echo 'มีห้องนี้ในระบบแล้ว';
        echo '</div>';
    } else {
        // Insert new record
        $insertQuery = "INSERT INTO roomtable VALUES('$id', '$RoomName', '$LightBulb');";
        
        if ($conn->query($insertQuery) === TRUE) {
            echo '<div class="alert alert-success" role="alert">';
            echo 'การเพิ่มข้อมูลลงในฐานข้อมูลประสบความสำเร็จ';
            echo '</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">';
            echo 'ไม่สามารถเพิ่มข้อมูลใหม่ลงในฐานข้อมูลได้ : ' . $conn->error;
            echo '</div>';
        }
    }

    echo '<br><center><a href="insert.php" class="btn btn-primary">กลับหน้าเว็บการเพิ่มข้อมูล</a></center><br>';
    echo '<center><a href="../Page/authentication/index.php" class="btn btn-secondary">กลับไปเมนูผู้ดูแลระบบ</a></center><br>';
    $conn->close();
}
	?>
	</div>

	<!-- footer -->
	
    



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>