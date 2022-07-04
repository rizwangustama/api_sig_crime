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


if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['id'])) {
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT id, user, pass, email, full_name, is_admin, user_verified, filename FROM users WHERE email='".$_POST['username']."' AND pass='".$_POST['password']."' AND isdeleted='False'";
    $result = $conn->query($sql);
    
    // output data of each row
    $userdata;
    $userdetail;

    if ($result->num_rows > 0) {
        
        $userid;
        
        $apiResult = true;
        $apiMessage = "Login Berhasil";
        while($row = $result->fetch_assoc()) {
            $userdata=$row;
            $userid=$row['id'];
        }

        $sql="SELECT id, nik, user_id, name, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, rt_rw, kel_desa, kecamatan, agama, st_kawin, pekerjaan, kewarganegaraan, exp, last_update, filename FROM user_data WHERE user_id='".$userid."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $apiResult = true;
            $apiMessage = "Login Berhasil";
            while($row = $result->fetch_assoc()) {
                $userdetail=$row;
            }
            
        $x = array("result" => $apiResult, "msg" => $apiMessage,
        "user_data" => $userdata,"user_detail" => $userdetail);
        }else{
            $apiResult = false;
            $apiMessage = "Login Gagal";
            $x = array("result" => $apiResult, "msg" => $apiMessage);
        }
    }else{
        $apiResult = false;
        $apiMessage = "Login Gagal";
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