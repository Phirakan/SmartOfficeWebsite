<?php 
  //$room_id = $_SESSION['room_id'];
  $room_id = 1;


  for($i=0; $i < 30; $i++){ 
    //$date_usage = date('d.m.Y', strtotime(-$i.' days',time()));
    $date_usage = date('Y-m-d', strtotime(-$i.' days',time()));          
    //echo $date_usage;
    echo "</br>";
  

  $conn = mysqli_connect("localhost","root","","office_member");
 /* $sql = "SELECT
            power_usage.device_id, 
            HOUR(TIMEDIFF(power_usage.datetime_stop,power_usage.datetime_start)) AS usehours,
            MINUTE(TIMEDIFF(power_usage.datetime_stop,power_usage.datetime_start)) AS useminutes
            FROM room
            INNER JOIN device
            ON room.room_id = device.room_id
            INNER JOIN power_usage
            ON device.device_id = power_usage.device_id
            WHERE room.room_id = $room_id
            ORDER BY power_usage.device_id DESC
            LIMIT 1;";
*/
$sql = "SELECT
            *,            
            HOUR(TIMEDIFF(power_usage.datetime_stop,power_usage.datetime_start)) AS usehours,
            MINUTE(TIMEDIFF(power_usage.datetime_stop,power_usage.datetime_start)) AS useminutes,
            DATE(power_usage.datetime_start) AS datestart
            FROM room
            INNER JOIN device
            ON room.room_id = device.room_id
            INNER JOIN power_usage
            ON device.device_id = power_usage.device_id
            WHERE room.room_id = $room_id AND DATE(power_usage.datetime_start) = '$date_usage';";




  //echo $sql;
  $result = $conn->query($sql);
  $sum = 0;
   if($result->num_rows > 0) {    
    foreach ($result as $data) {
      $hours = $data['usehours']+$data['useminutes']/60;
      echo " - ห้อง ".$data['room_name']." เปิดอุปกรณ์ไฟฟ้า ".$data['device_name']." ใช้เวลา ".$hours." ชั่วโมง";
      echo "</br>";
      $sum += $hours;
    }
    echo "วันที่ ".$data['datestart']." ห้อง ".$data['room_name']." เปิดอุปกรณ์ไฟฟ้ารวมทั้งหมด ".$sum." ชั่วโมง";
  }else echo "วันที ".$date_usage." ไม่มีการเปิดอุปกรณ์ไฟฟ้า";

}
?>