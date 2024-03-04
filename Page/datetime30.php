<?php 
session_start();
include('../config/connectdb.php');
  // $room_id = $_SESSION['room_id'];
  $room_id = 1;

  // Carbon Intensity Factor (example value, replace with actual value)
  $carbon_intensity_factor = 0.5; // kgCO2/kWh

  for($i=0; $i < 30; $i++){ 
    //$date_usage = date('d.m.Y', strtotime(-$i.' days',time()));
    $date_usage = date('Y-m-d', strtotime(-$i.' days',time()));          
    //echo $date_usage;
    echo "</br>";
  
   
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
        $hours = $data['usehours'] + $data['useminutes'] / 60;
        $power_consumption = $data['watt']; // Assuming you have this column in your database for power consumption in watts
        $energy_usage = $power_consumption * $hours ; // Convert watt-hours to kilowatt-hours
        $carbon_emissions = $energy_usage * $carbon_intensity_factor; // Carbon dioxide emissions in kilograms
        echo " - ห้อง ".$data['room_name']." เปิดอุปกรณ์ไฟฟ้า ".$data['device_name']." ใช้พลังงาน ".$power_consumption." วัตต์";
        echo "</br>";
        echo " - ห้อง ".$data['room_name']." เปิดอุปกรณ์ไฟฟ้า ".$data['device_name']." ปล่อยก๊าซคาร์บอนไดออกไซด์ ".$carbon_emissions." กิโลกรัม"; // Output carbon dioxide emissions
        echo "</br>";
        $sum += $energy_usage;
      }
      echo "วันที่ ".$data['datestart']." ห้อง ".$data['room_name']." เปิดอุปกรณ์ไฟฟ้ารวมทั้งหมด ".$sum." กิโลวัตต์-ชั่วโมง";
    } else {
      echo "วันที ".$date_usage." ไม่มีการเปิดอุปกรณ์ไฟฟ้า";
    }
  }
  header('Content-Type: application/json');

echo json_encode($data);
?>
