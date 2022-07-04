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

// Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM klasifikasi_kriminal";
    $sql2 = "SELECT * FROM kecamatan";
    $j_kriminal=[];
    $kecamatan=[];

    $result = $conn->query($sql);
    // output data of each row
    if ($result->num_rows > 0) {
        
        $apiResult = true;
        $apiMessage = "Load Data Berhasil";
        while($row = $result->fetch_assoc()) {
            array_push($j_kriminal,$row);
        }
        $x = array("result" => $apiResult, "msg" => $apiMessage,"user_data"=>$j_kriminal);
    }else{
        $apiResult = false;
        $apiMessage = "Load Data Gagal";
        $x = array("result" => $apiResult, "msg" => $apiMessage);
    } 

    $result = $conn->query($sql2);
    // output data of each row
    if ($result->num_rows > 0) {
        
        $apiResult = true;
        $apiMessage = "Load Data Berhasil";
        while($row = $result->fetch_assoc()) {
            array_push($kecamatan,$row);
        }
        $x = array("result" => $apiResult, "msg" => $apiMessage,"jenis_kriminal"=>$j_kriminal,"kecamatan"=>$kecamatan);
    }else{
        $apiResult = false;
        $apiMessage = "Load Data Gagal";
        $x = array("result" => $apiResult, "msg" => $apiMessage);
    } 
    mysqli_close($conn);

echo json_encode($x);
?>