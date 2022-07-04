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


if (isset($_POST['id_kecamatan']) && isset($_POST['id_klassifikasi_kriminal']) 
    && isset($_POST['kasus_kriminal']) && isset($_POST['tanggal_kejadian'])
    && isset($_POST['waktu_kejadian']) && isset($_POST['alamat'])
    && isset($_POST['map_lat']) && isset($_POST['map_lang'])
    && isset($_POST['create_by']) && isset($_POST['created'])
    && isset($_POST['is_verified']) && isset($_POST['title'])) {
    
    
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $database);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "INSERT INTO kriminal 
        (id_kecamatan, id_klassifikasi_kriminal, kasus_kriminal, tanggal_kejadian, 
        waktu_kejadian, alamat, map_lat, map_lang, 
        create_by, created, is_verified, title) VALUES  
        ('".$_POST['id_kecamatan']."', '".$_POST['id_klassifikasi_kriminal']."'
        ,'".$_POST['kasus_kriminal']."', '".$_POST['tanggal_kejadian']."', '".$_POST['waktu_kejadian']."'
        , '".$_POST['alamat']."', '".$_POST['map_lat']."', '".$_POST['map_lang']."'
        , '".$_POST['create_by']."', '".$_POST['created']."', '".$_POST['is_verified']."'
        , '".$_POST['title']."');";
        $result = $conn->query($sql);

        if ($result) {
            $apiResult = true;
            $apiMessage = "Berita Telah Terkirim";
            $last_id = $conn->insert_id;

            $x = array("result" => $apiResult, "msg" => $apiMessage,"lastID"=>$last_id);
                
            mysqli_close($conn);
        }else{
            $apiResult = false;
            $apiMessage = "Berita Gagal Terkirim";
            $x = array("result" => $apiResult, "msg" => $apiMessage);
        } 
    }else{
        $apiResult = false;
        $apiMessage = "All fields are required";
        $x = array("result" => $apiResult, "msg" => $apiMessage);
    }
echo json_encode($x);
?>