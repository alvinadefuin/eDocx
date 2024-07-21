<?php
include "config.php";
extract($_REQUEST);

if (isset($_POST['update'])) {
  $selected_radio = $_POST['status'];
  $dob = date('Y-m-d', strtotime($_POST['claimdate']));

  $sql = "UPDATE orders SET status='$selected_radio',dob='$dob' WHERE student_id='$order_id' ";
  $result = mysqli_query($con, $sql);

  if (mysqli_query($con, $sql)) {
    header('Location: Orders.php');
  } else {
    echo "Error updating record: " . mysqli_error($con);
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Update</title>
</head>
<style>
  .container {
    width: 30%;
    margin-top: 70px;
  }

  .container h5 {
    color: green;
  }

  .container a {
    text-decoration: none;
    color: white;
  }

  .center {
    margin-top: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>

<body>
  <div class="container">
    <form method="POST">


      <h5>Status:</h5>
      &emsp;&emsp;&emsp;<input type="radio" name="status" value="Pending">&emsp;Pending<br>
      &emsp;&emsp;&emsp;<input type="radio" name="status" value="Processing">&emsp;Processing<br>
      <br>
      <h5>Claiming Date:</h5>
      <input type="date" name="claimdate" class="form-control" />
      <div class="center">
        <button type="submit" class="btn btn-primary" name="update">UPDATE</button>
        &ensp;
        <button type="submit" class="btn btn-danger" name="cancel"><a href="Orders.php">CANCEL</a></button>
      </div>
  </div>

  </form>
  </div>
</body>

</html>