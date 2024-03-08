<?php

session_start();
include('../config/connectdb.php');

if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = "You must log in first";
    header('location: home.php');
}

$username = $_SESSION['username'];
$sql = "SELECT room.room_name
        FROM room
        INNER JOIN user ON room.user_id = user.id
        WHERE user.username = '$username'";
$result = mysqli_query($conn, $sql);
$room_row = mysqli_fetch_assoc($result);
$current_room = isset($room_row['room_name']) ? $room_row['room_name'] : "N/A";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" href="../asset/logo2.png" type="image/x-icon" />
    <link rel="stylesheet" href="../css/home.css">
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
                        <a class="nav-link active" href="admin.php">Manage Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Room/manageroom.php">Manage Room</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Device/manageDevice.php">Manage Device</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            <img src="../asset/dashboard.png" alt="Dashboard" class="dashboard-icon">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <?php
        if (isset($_SESSION["username"])) {
            echo '<li class="nav-item dropdown">';
            echo '<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
            echo $_SESSION["username"];
            echo '</a>';
            echo '<ul class="dropdown-menu" aria-labelledby="userDropdown">';
            echo '<li><a class="dropdown-item" href="dashboard.php">ไปยังหน้าแดชบอร์ด</a></li>';
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

    <!-- content -->
    <div class="container custom-container mt-4 mx-auto">
        <h2 class="text-center">Dashboard</h2>
        <div class="d-flex justify-content-center">
            <canvas id="myChart" class="w-full"></canvas>
        </div>
        <h2 class="text-center">Electric Current Room : <?php echo $current_room; ?></h2>
        <h5 class="text-center" id="carbonValue">ค่าการปล่อยก๊าซคาร์บอนไดออกไซด์: </h5>
    </div>

    <footer class="text-center mt-auto">
        <div class="contact-info">
            <p>Contact us at: <span>info@smarthometech.com</span></p>
        </div>
    </footer>

    <script>
        // Fetch data from API
        fetch('../api/report.php')
            .then(response => response.json())
            .then(data => {
                const dateValue = data.properties.map(item => item.date);
                const wattValue = data.properties.map(item => item.watt);
                const carbonValue = data.carbon;

                document.getElementById('carbonValue').innerText += ' ' + carbonValue.toFixed(1);


                // Create Chart
                new Chart("myChart", {
                    type: "line",
                    data: {
                        labels: dateValue,
                        datasets: [{
                            fill: false,
                            lineTension: 0.1,
                            backgroundColor: "rgba(0,0,255,1.0)",
                            borderColor: "rgba(0,0,255,0.1)",
                            data: wattValue
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        scales: {
                            xAxes: [{ 
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Date' 
                                }
                            }],
                            yAxes: [{ 
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Power Consumption (Watt)' 
                                },
                                ticks: {
                                    min: Math.min(0),
                                    max: Math.max(30000)
                                }
                            }]
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));

        function Logout() {
            window.location.href = "../service/logout.php";
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>