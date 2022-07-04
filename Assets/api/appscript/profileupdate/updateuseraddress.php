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


if (isset($_POST['alamat']) && isset($_POST['rtrw']) 
    && isset($_POST['desa']) && isset($_POST['kecamatan'])
    &&  isset($_POST['userid'])) {
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    $sql2 ="UPDATE user_data SET alamat='".$_POST['alamat']."', rt_rw='".$_POST['rtrw']."', kel_desa='".$_POST['desa']."', kecamatan='".$_POST['kecamatan']."' WHERE (user_id='".$_POST['userid']."');";
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $result = $conn->query($sql2);
    if ($result) {
        $apiResult = true;
        $apiMessage = "Update Berhasil";
    }else{
        $apiResult = false;
        $apiMessage = "Update Gagal";
    } 
    
    if ($apiResult=true) {
        // output data of each row
        $sql = "SELECT id, user, pass, email, full_name, is_admin, user_verified, filename FROM users WHERE id='".$_POST['userid']."'";
        $userdetail;
        $userdata;

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // $data_array=$row;
                $userdata=$row;
            }

            $sql="SELECT id, nik, user_id, name, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, rt_rw, kel_desa, kecamatan, agama, st_kawin, pekerjaan, kewarganegaraan, exp, last_update, filename FROM user_data WHERE user_id='".$_POST['userid']."'";
            $result2 = $conn->query($sql);
            if ($result2->num_rows > 0) {
                $apiResult = true;
                $apiMessage = "Update Berhasil";
                while($row = $result2->fetch_assoc()) {
                    $userdetail=$row;
                }
            }else{
                $apiResult = false;
                $apiMessage = "Update Gagal";
                $x = array("result" => $apiResult, "msg" => $apiMessage);
            }

            $x = array("result" => $apiResult, "msg" => $apiMessage,
            "user_data" => $userdata,"user_detail" => $userdetail);
        }
        else{
            $apiResult = true;
            $apiMessage = "Update Berhasil";
            $x = array("result" => $apiResult, "msg" => $apiMessage);
        }
    }else{
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