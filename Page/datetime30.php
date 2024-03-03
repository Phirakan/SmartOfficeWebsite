<?php 
  for($i=0; $i < 30; $i++){ 
    $date_usage = date('Y-m-d', strtotime(-$i.' days', time()));          
    echo $date_usage;
    echo "</br>";
  
    $room_id = 1;

    $conn = mysqli_connect("localhost", "root", "", "office_member");

    $sql = "SELECT            
            HOUR(TIMEDIFF(power_usage.datetime_stop, power_usage.datetime_start)) AS usehours,
            MINUTE(TIMEDIFF(power_usage.datetime_stop, power_usage.datetime_start)) AS useminutes
            FROM room
            INNER JOIN device ON room.room_id = device.room_id
            INNER JOIN power_usage ON device.device_id = power_usage.device_id
            WHERE room.room_id = $room_id AND DATE(power_usage.datetime_start) = '$date_usage'";

    echo $sql;

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        foreach ($result as $data) {
            $hours = $data['usehours'] + $data['useminutes'] / 60;
            echo "total : ".$hours;
            echo "</br>";
        }
    }
  }
?>
