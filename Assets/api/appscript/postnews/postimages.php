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
$apiResult = false;
$apiMessage = "";
if (isset($_POST['id'])) {
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT
            id, kriminal_id, filename FROM lampiran WHERE kriminal_id = '".$_POST['id']."' LIMIT 0,4";
    $result = $conn->query($sql);
    
    // output data of each row
    $data=[];

    if ($result->num_rows > 0) {
        
        $apiResult = true;
        $apiMessage = "Load Data Berhasil";
        while($row = $result->fetch_assoc()) {
            array_push($data,$row);
        }
        $x = array("result" => $apiResult, "msg" => $apiMessage,"data"=>$data);
    }else{
        $apiResult = false;
        $apiMessage = "Load Data Gagal";
        $x = array("result" => $apiResult, "msg" => $apiMessage);
    } 
    mysqli_close($conn);
} else{
    $apiResult = false;
    $apiMessage = "All fields are required";
    $x = array("result" => $apiResult, "msg" => $apiMessage);
}
echo json_encode($x);
?>