<?php
 $servername = "localhost";
    $username = "rizwangu_rizwangustama";
    $password = "noekasep@ok!!";
    $database = "rizwangu_sig_crime";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO `lampiran` (`kriminal_id`, `filename`) VALUES ('".$_POST['id']."', 'imgdef.png');";
    $result = $conn->query($sql);
    if ($result) {
        # code...
    }
    mysqli_close($conn);
?>