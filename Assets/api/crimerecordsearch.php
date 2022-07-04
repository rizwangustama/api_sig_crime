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


if (isset($_POST['search'])) {
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM view_kriminal_verfied WHERE  alamat LIKE '%" .$_POST['search']. "%' 
    OR kasus_kriminal LIKE '%" .$_POST['search']. "%' 
    OR title LIKE '%" .$_POST['search']. "%' 
    OR klasifikasi_kriminal LIKE '%" .$_POST['search']. "%' 
    OR kecamatan LIKE '%" .$_POST['search']. "%'
    LIMIT 0, 100";
    $result = $conn->query($sql);
    
    // output data of each row
    $crimedata=[];

    if ($result->num_rows > 0) {
        
        $apiResult = true;
        $apiMessage = "Load Data Berhasil";
        while($row = $result->fetch_assoc()) {
            array_push($crimedata,$row);
        }
        $x = array("result" => $apiResult, "msg" => $apiMessage,"crime_record"=>$crimedata);
    }else{
        $apiResult = false;
        $apiMessage = "No Data";
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