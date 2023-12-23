<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>หน้าหลัก</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="../../css/index.css" rel="stylesheet">

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
                        <a class="nav-link" href="../dashboard.php">
                            <img src="../../upload/dashboard.png" alt="Dashboard" class="dashboard-icon">
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>


    <h2>เมนูผู้ดูแลระบบ</h2>
    <div class="container-fluid">
        <form method="post" action="">
            <center><a href="../../service/insert.php" class="btn btn-primary btn-menu">เพิ่มข้อมูล</a></center>
            <p></p>
            <center><a href="../../service/deletestd.php" class="btn btn-danger btn-menu">ลบข้อมูล</a></center>
            <p></p>
            <center><a href="../../service/updatestdform.php" class="btn btn-warning btn-menu">แก้ไขข้อมูล</a></center>
            <p></p>
            <center><a href="../../service/showstd.php" class="btn btn-info btn-menu">แสดงข้อมูล</a></center>
            <p></p>
        </form>
    </div>


   



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>