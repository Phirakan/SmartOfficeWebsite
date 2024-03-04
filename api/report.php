<?php
include('../config/connectdb.php');
// $room_id = $_SESSION['room_id'];
$room_id = 1;
$carbon_intensity_factor = 0.5;

// Initialize array to store room data
$data = array();

// Loop through the last 30 days
for ($i = 0; $i < 30; $i++) {
    $date_usage = date('Y-m-d', strtotime(-$i . ' days', time()));

    // Fetch data from the database
    $sql = "SELECT
                *,            
                HOUR(TIMEDIFF(power_usage.datetime_stop, power_usage.datetime_start)) AS usehours,
                MINUTE(TIMEDIFF(power_usage.datetime_stop, power_usage.datetime_start)) AS useminutes,
                DATE(power_usage.datetime_start) AS datestart
            FROM room
            INNER JOIN device
                ON room.room_id = device.room_id
            INNER JOIN power_usage
                ON device.device_id = power_usage.device_id 
            WHERE room.room_id = $room_id";

    $result = $conn->query($sql);

    // Process fetched data
    if ($result->num_rows > 0) {
        // Initialize arrays to store properties for the current date
        $properties = array();

        foreach ($result as $data) {
            $hours = $data['usehours'] + $data['useminutes'] / 60;
            $power_consumption = $data['watt'] * $hours; // Assuming you have this column in your database for power consumption in watts
            $datestart = $data['datestart'];
            $datestop = $data['datetime_stop'];
            // format date to 17 May 2021
            $dateformat = date('d F Y', strtotime($datestart));

            // Build properties array for the current date
            $properties[] = array(
                "date" => $dateformat,
                "watt" => $power_consumption
            );
        }

        // Calculate total carbon emissions for the current date
        $carbon_emissions = array_sum(array_column($properties, 'watt')) * $carbon_intensity_factor;

        // Add room data to main array
        // $data[] = array(
        //     "room_id" => $room_id,
        //     "properties" => $properties,
        //     "carbon" => $carbon_emissions
        //     );
    }
}

$data = [
    "room_id" => $room_id,
    "properties" => $properties,
    "carbon" => $carbon_emissions
];



header('Content-Type: application/json');
echo json_encode($data);
?>
