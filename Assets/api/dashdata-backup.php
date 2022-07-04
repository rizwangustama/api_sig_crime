<?php

$servername = "localhost";
$username = "rizwangu_rizwangustama";
$password = "noekasep@ok!!";
$database = "rizwangu_sig_crime";
// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "sig_crime";
$x = array();

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// echo "Connected successfully";
$sql = "SELECT COUNT(id) as crime_record FROM kriminal WHERE is_verified='true'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $data_array=$row;
  }
    array_push($x,$data_array);
} 

$sql = "SELECT * FROM kecamatan";
$result = $conn->query($sql);
$kecamatan_data_array = array();
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    // $kecamatan_data_array=$row;
    array_push($kecamatan_data_array,$row);
  }
    array_push($x,$kecamatan_data_array);
} 

$sql = "SELECT * FROM view_kriminal WHERE is_verified='true' LIMIT 0, 10";
$result = $conn->query($sql);
$kriminal_data_array = array();
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    // $kriminal_data_array=$row;
    array_push($kriminal_data_array,$row);
  }
    array_push($x,$kriminal_data_array);
} 

echo json_encode($x);
mysqli_close($conn);
?>