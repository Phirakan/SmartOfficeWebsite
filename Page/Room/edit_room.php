<?php
session_start();
include('../../config/connectdb.php');

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
    header('location: ../home.php');
    exit();
}


if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = "Room ID is missing in the URL";
    header('location: manageroom.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_GET['id']; // รับค่า ID ของห้องจาก URL
    $new_room_name = $_POST['room_name']; // รับค่าชื่อห้องที่แก้ไขจากฟอร์ม
    // รับค่าเจ้าของห้องที่เลือกจากฟอร์ม
    $new_owner_id = $_POST['owner'];

    // Check if the selected owner already has a room
    $check_existing_room_query = "SELECT COUNT(*) as count FROM room WHERE user_id = $new_owner_id AND room_id != $room_id";
    $check_result = mysqli_query($conn, $check_existing_room_query);
    $row = mysqli_fetch_assoc($check_result);
    if ($row['count'] > 0) {
        $_SESSION['error'] = "This user already has a room.";
        header('location: edit_room.php?id=' . $room_id);
        exit();
    }

    // Update room name and owner
    $update_room_query = "UPDATE room SET room_name = '$new_room_name', user_id = $new_owner_id WHERE room_id = $room_id";
    $result = mysqli_query($conn, $update_room_query);

    if (!$result) {
        $_SESSION['error'] = "Error updating room";
    } else {
        // Update device information in the room
        $devices = $_POST['device_name'];
        foreach ($devices as $device_id => $device_name) {
            $update_device_query = "UPDATE device SET device_name = '$device_name' WHERE device_id = $device_id";
            $result = mysqli_query($conn, $update_device_query);
            if (!$result) {
                $_SESSION['error'] = "Error updating device";
                header('location: manageroom.php');
                exit();
            }
        }
        $_SESSION['success'] = "Room updated successfully";
    }
    header('location: edit_room.php?id=' . $room_id);
    exit();
}

$room_id = $_GET['id'];
$sql = "SELECT room.*, user.f_name FROM room LEFT JOIN user ON room.user_id = user.id WHERE room.room_id = $room_id";
$result = mysqli_query($conn, $sql);
$room_data = mysqli_fetch_assoc($result);

// Retrieve device information in the room
$device_sql = "SELECT * FROM device WHERE room_id = $room_id";
$device_result = mysqli_query($conn, $device_sql);

?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Update Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="../../css/home.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- Navbar content -->
    </nav>

    <div class="container-fluid">
        <h2>Edit Room</h2>
        <?php if (isset($_SESSION['error'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['error']; ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['success']; ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-3">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $room_id; ?>" id="updateRoomForm" onsubmit="submitForm(); return false;">

                    <div class="mb-3">
                        <label for="room_name" class="form-label">Room Name</label>
                        <input type="text" class="form-control" id="room_name" name="room_name" value="<?php echo $room_data['room_name']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="device_name" class="form-label">Devices</label>
                        <?php while ($device_data = mysqli_fetch_assoc($device_result)) : ?>
                            <input type="text" class="form-control mb-2" id="device_name" name="device_name[<?php echo $device_data['device_id']; ?>]" value="<?php echo $device_data['device_name']; ?>">
                        <?php endwhile; ?>
                    </div>
                    <div class="mb-3">
                        <label for="owner" class="form-label">Owner</label>
                        <select class="form-select" id="owner" name="owner">
                            <option value="">Select Owner</option>
                            <?php
                            $user_sql = "SELECT id, f_name FROM user";
                            $user_result = mysqli_query($conn, $user_sql);
                            while ($user_data = mysqli_fetch_assoc($user_result)) {
                                $selected = ($user_data['id'] == $room_data['user_id']) ? "selected" : "";
                                echo "<option value='" . $user_data['id'] . "' $selected>" . $user_data['f_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary" onclick="return validateForm();">Update Room</button>
                    <a href="../Device/manageDevice.php" class="btn btn-success">Add Device</a>
                    <a href="manageroom.php" class="btn btn-danger">Back to Room Page</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
    function submitForm() {
        var selectBox = document.getElementById("owner");
        var selectedUserId = selectBox.options[selectBox.selectedIndex].value;

        // เช็คว่าผู้ใช้เลือก f_name ที่มีห้องอยู่แล้วหรือไม่
        if (selectedUserId != "<?php echo $room_data['user_id']; ?>") {
            document.getElementById("updateRoomForm").submit();
        } else {
            // แสดง Alert และยกเลิกการ submit ถ้าผู้ใช้เลือก f_name ที่มีห้องอยู่แล้ว
            alert("This user already has a room.");
        }
    }
</script>

</body>

</html>
