<?php 
include 'config.php';
extract($_REQUEST);

if (isset($_GET['del'])) {
  $del=$_GET['del'];

  $sql = "DELETE FROM product WHERE  student_id='$del' ";
  $result = mysqli_query($con, $sql);

  $sql2 = "DELETE FROM orders WHERE  student_id='$del' ";
  $result2 = mysqli_query($con, $sql2);
  
  if ($result) {
    header('Location: Orders.php');
  } else {
    echo "Error updating record: " . mysqli_error($con);
  }
}


?>