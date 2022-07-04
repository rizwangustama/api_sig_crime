<?php
$target_path1 = "userprofile/";
/* Add the original filename to our target path.
Result is "uploads/filename.extension" */
$target_path1 = $target_path1 . basename( $_FILES['uploadedfile1']['name']);
if(move_uploaded_file($_FILES['uploadedfile1']['tmp_name'], $target_path1)) {

    echo "The first file ".  basename( $_FILES['uploadedfile1']['name']).
    " has been uploaded.";
    
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

    $sql = "UPDATE users SET filename='".basename( $_FILES['uploadedfile1']['name'])."' 
    WHERE id='".$_POST['userid']."';";
    $result = $conn->query($sql);
    if ($result) {
        # code...
    }
    mysqli_close($conn);
} else{
    echo "There was an error uploading the file, please try again!";
    echo "filename: " .  basename( $_FILES['uploadedfile1']['name']);
    echo "target_path: " .$target_path1;
}
 
?>