<?php
// api/report.php

// Include necessary files and perform any required operations to fetch data
// For example, fetching data from your database

// Sample data for demonstration
$xValues = [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150];
$yValues = [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15];

// Prepare data to be sent as JSON
$data = [
  'xValues' => $xValues,
  'yValues' => $yValues
];

// Set response headers
header('Content-Type: application/json');

// Output JSON
echo json_encode($data);
?>
