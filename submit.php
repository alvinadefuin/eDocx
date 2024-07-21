<?php 

if(isset($_POST['submit']))
{
    echo "Request Submitted";
}
else{
    echo "Error";
}
header('location: new-track.php');
?>
