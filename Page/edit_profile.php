<?php
// เรียกใช้ session_start() ที่ต้องใช้ในทุกหน้าที่ใช้ session
session_start();
include('../config/connectdb.php');

if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = "You must log in first";
    header('location: ../home.php');
    exit();
}
$username = $_SESSION['username'];
$query = "SELECT role FROM user WHERE username = '$username' AND role = 1";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 0) {
    $_SESSION['error'] = "You don't have permission to access this page";
    header('location: home.php');
    exit();
}


if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Error: ID parameter is missing in the URL";
    exit();
}

$user_id = $_GET['id'];
$query = "SELECT user.*, room.room_name 
          FROM user 
          LEFT JOIN room ON user.id = room.user_id
          WHERE user.id = '$user_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $f_name = $row['f_name'];
    $l_name = $row['l_name'];
    $email = $row['email'];
    $tel = $row['tel'];
    $img_path = $row['img'];
    
} else {
    echo "Error retrieving user data";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="../css/profile.css" rel="stylesheet">
    <title>Edit Profile - <?php echo $f_name; ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- Navbar content -->
    </nav>

    <div class="container mt-5">
        <h1>Edit Profile  <?php echo $f_name; ?></h1>

        <form action="../service/update_profile.php?id=<?php echo $user_id ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <?php if (isset($img_path) && !empty($img_path)) : ?>
                    <img src="<?php echo $img_path; ?>" alt="User Image" width="400" class="mb-3">
                <?php else : ?>
                    <img src="../upload/profile.png" alt="Default Image" width="400" class="mb-3">
                <?php endif; ?>

              
                <input type="file" class="form-control" id="profileImage" name="profileImage">
            </div>

            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $f_name; ?>">
            </div>

            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $l_name; ?>">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
            </div>

            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo $tel; ?>">
            </div>

            <button type="submit" name="btn_update" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        function Logout() {
            window.location.href = "../service/logout.php";
        }
    </script>
</body>

</html>
