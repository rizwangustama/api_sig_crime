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


if (isset($_POST['user']) && isset($_POST['pass']) 
    && isset($_POST['email']) && isset($_POST['full_name'])) {
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO users (user, pass, email, full_name, is_admin, user_verified,filename) VALUES 
    ('".$_POST['user']."', '".$_POST['pass']."', '".$_POST['email']."', '".$_POST['full_name']."', 'False', 'False','?');";
    $result = $conn->query($sql);

    if ($result) {
        
        // output data of each row
        $sql = "SELECT id, user, pass, email, full_name, is_admin, user_verified, filename 
            FROM users WHERE user='".$_POST['user']."' AND pass='".$_POST['pass']."' 
            AND email='".$_POST['email']."' AND full_name='".$_POST['full_name']."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $userdata;
            $apiResult = true;
            $apiMessage = "Pendaftaran Berhasil";
            while($row = $result->fetch_assoc()) {
                // $data_array=$row;
                $userdata=$row;
            }
            
        // $sql2 = "INSERT INTO user_data (user_id, name) VALUES ('".$userdata['id']."', '".$_POST['full_name']."')";
        $sql2 = "INSERT INTO user_data VALUES ('', '', '".$userdata['id']."', '".$_POST['full_name']."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '')";
        
        $result2 = $conn->query($sql2);

        $x = array("result" => $apiResult, "msg" => $apiMessage,"user_data" => $userdata);
        }
        
        
                
        mysqli_close($conn);
    }else{
        $apiResult = false;
        $apiMessage = "Pendaftaran Gagal";
        $x = array("result" => $apiResult, "msg" => $apiMessage);
    } 

} else{
    $apiResult = false;
    $apiMessage = "All fields are required";
    $x = array("result" => $apiResult, "msg" => $apiMessage);
}
echo json_encode($x);
?>