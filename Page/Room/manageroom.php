<?php 
    session_start(); 
    include('../../config/connectdb.php');

    if (!isset($_SESSION['username'] )) {
        $_SESSION['error'] = "You must log in first";
        header('location: ../home.php');
        exit();
    }

    $sql = "SELECT room.*,user.f_name FROM room LEFT JOIN user ON room.room_id = user.id";
    $result = mysqli_query($conn, $sql);

    if ($_SESSION['role'] != 1) {
        header('location: ../home.php');
         exit();
     }

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Manage Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="../../css/home.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
    <a class="navbar-brand" href="home.php">Smart Green Office</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="manageroom.php">Manage Room</a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addroom.php">Add Room</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="manageDevice.php">Manage Device</a>
                   
                </li>
            
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">
                        <img src="../../upload/dashboard.png" alt="Dashboard" class="dashboard-icon">
                    </a>
                </li>

            </ul>

            
        </div>
    </div>
    
    <?php
    if(isset($_SESSION["username"])) {   
        echo '<li class="nav-item dropdown">';
        echo '<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
        echo $_SESSION["username"];
        echo '</a>';
        echo '<ul class="dropdown-menu" aria-labelledby="userDropdown">';
        echo '<li><a class="dropdown-item" href="authentication/profile.php">แสดงโปรไฟล์</a></li>'; // Add your dropdown options here
        echo '<li><a class="dropdown-item" href="authentication/dashboard.php">ไปยังหน้าแดชบอร์ด</a></li>';
        echo '<li><hr class="dropdown-divider"></li>';
        echo '<a href="../service/logout.php" style="color: black;">Logout</a>';
        echo '</ul>';
        echo '</li>';
        echo '<button class="button" id="form-open" onclick="Logout()">Logout</button>'; 
    } else {
        echo '<button class="button" id="form-open" onclick="redirectToLogin()">Login</button>';
    }
    ?>
</nav>

    <h2>Manage Room</h2>
    <div class="container-fluid">
    <a href="addroom.php" class="btn btn-success" style="width: 150px;">Add room</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Room Name</th>
                    <th scope="col">View Details</th>
                    <th scope="col">Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['room_name'] . "</td>";
                    echo "<td><a href='roomdetail.php?id=" . $row['room_id'] . "' class='btn btn-primary btn-menu'>View</a></td>";
                    echo "<td><a href='edit_room.php?id=" . $row['room_id'] . "' class='btn btn-danger btn-menu'>Edit</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        function Logout() {
            window.location.href = "../../service/logout.php";
        }
    </script>
</body>
</html>
