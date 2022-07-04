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
            COUNT(kriminal.id) AS Total_Laporan,
            (SELECT COUNT(trueKriminal.id) FROM kriminal AS trueKriminal WHERE trueKriminal.create_by='".$_POST['id']."' 
            AND trueKriminal.is_verified='true') AS Total_Laporan_Verfied
            FROM kriminal WHERE
            kriminal.create_by = '".$_POST['id']."'";
    $result = $conn->query($sql);
    
    // output data of each row
    $userdata;
    $userdetail;

    if ($result->num_rows > 0) {
        
        $apiResult = true;
        $apiMessage = "Load Data Berhasil";
        while($row = $result->fetch_assoc()) {
            $userdata=$row;
        }
        $x = array("result" => $apiResult, "msg" => $apiMessage,"user_data"=>$userdata);
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