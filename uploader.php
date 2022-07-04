<?php 
 $target = "cb_upload/"; 
 $target = $target . basename( $_FILES['userfile']['name']) ; 
 $ok=1; 
 if(move_uploaded_file($_FILES['userfile']['tmp_name'], $target)) 
 {
 echo "The file ". basename( $_FILES['userfile']['name']). " has been uploaded";
 } 
 else {
 echo "Sorry, there was a problem uploading your file.";
 }
 ?> 