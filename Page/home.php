<?php 

session_start(); 
include('../config/connectdb.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Office Technology</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/home.css">

    <!-- Unicons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
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
                    <a class="nav-link active" href="authentication/admin.php">Profile</a>
                   
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addroom.php">Add Room</a>
                </li>
            
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="authentication/dashboard.php">
                        <img src="../upload/dashboard.png" alt="Dashboard" class="dashboard-icon">
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


<section class="about d-flex justify-content-center">
    <div>
        <h1>Welcome to Smart Home Technology</h1>
        <p>Your partner in creating intelligent and connected homes. Explore our innovative solutions for a smarter living experience.</p>
        <img src="../upload/smart.PNG" alt="Smart Home Illustration">
    </div>
</section>


<div class="row">
    <div id="carouselId" class="carousel slide mx-auto" data-bs-ride="carousel">
      <ol class="carousel-indicators">
        <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
        <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
        <li data-bs-target="#carouselId" data-bs-slide-to="2" aria-label="Third slide"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
          <img src="../upload/Smart Green Office Banner 1.png" class="w-100 d-block" alt="First slide" height="200px;">
        </div>
        <div class="carousel-item">
          <img src="../upload/Smart Green Office Banner2.png" class="w-100 d-block" alt="Second slide" height="200px;">
        </div>
        <div class="carousel-item">
          <img src="../upload/Smart Green Office Banner 3.png" class="w-100 d-block" alt="Third slide" height="200px;">
        </div>
      </div>
      
    </div>
  </div>

<!-- content -->

<div class="container custom-container mt-4 mx-auto">
    <div class="row">
        <!-- ซ้าย: ตัวหนังสือ -->
        <div class="col-md-6">
            <h2>Welcome to Smart Office Technology</h2>
            <p>Your partner in creating intelligent and connected homes. Explore our innovative solutions for a smarter living experience.</p>
        </div>

        <!-- ขวา: รูป -->
        <div class="col-md-6">
            <img src="../upload/smarthome.jpg" class="img-fluid" alt="Smart Home Image">
        </div>
    </div>
</div>


<div class="container custom-container mt-4 mx-auto">
    <div class="row">
        <!-- ซ้าย: รูป -->
        <div class="col-md-6">
            <img src="../upload/Ai.jpg" class="img-fluid" alt="Smart Home Image">
        </div>

        <!-- ขวา: ตัวหนังสือ -->
        <div class="col-md-6">
            <h2>Ai For Your Office</h2>
            <p>We have intelligent AI to monitor various environments and make your daily life more comfortable.</p>
        </div>

       
       
    </div>
</div>

  <!-- footer -->
  <footer class="text-center mt-auto">
    <div class="contact-info">
        <p>Contact us at: <span>info@smarthometech.com</span></p>
    </div>
    
</footer>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


<script>
function redirectToLogin() {
  window.location.href = "Login.php";
}
</script>

<script>
function Logout() {
            window.location.href = "../service/logout.php";
        }
</script>

</body>
</html>
