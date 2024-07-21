<meta name="viewport" content="width=device-width, initial-scale=1">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<style>
  #mySidenav a {
    position: absolute;
    left: -80px;
    transition: 0.3s;
    padding: 15px;
    width: 120px;
    text-decoration: none;
    font-size: 17px;
    color: white;
    border-radius: 0 5px 5px 0;
  }

  #mySidenav a:hover {
    left: 0;
  }

  #request {
    top: 20px;
    background-color: #04AA6D;
  }

  #trace {
    top: 80px;
    background-color: #2196F3;
  }

  #sid {
    top: 140px;
    background-color: #f44336;
  }

  #logout {
    top: 200px;
    background-color: #555
  }
</style>
</head>

<body>

  <?php
  $studentno = $_SESSION['studentno'];

  $sql = "SELECT * FROM `accounts` WHERE studentno = '$studentno' ";
  $result = mysqli_query($con, $sql);

  if (!($selectRes = $result)) {
    echo 'Retrieval of data from Database Failed - #' . mysqli_errno($con) . ': ' . mysqli_error($con);
  } else {
  ?>
    <?php

    if (mysqli_num_rows($selectRes) == 0) {
      echo '<tr><td colspan="4">No Rows Returned</td></tr>';
    } else {
      while ($row = mysqli_fetch_assoc($selectRes)) {


        echo "<div id='mySidenav' class='sidenav'>
          <a href='new-req.php' id='request'>Request&nbsp;&nbsp;&nbsp;<i class='fas fa-file-alt'> </i></a>
          <a href='new-track.php' id='trace'>Trace&emsp;&emsp;<i class='fas fa-tasks'> </i></a>
          <a href='#' id='sid' style='font-size:15px'>{$row['studentno']}&ensp;&nbsp;<i class='fas fa-id-badge' style='font-size:20px'></i></a>
          <a href='logout.php' id='logout'>Logout  &ensp;&nbsp;<i class='fas fa-power-off'></i></a>
        </div>";
      }
    }


    ?>

  <?php
  }
  ?>
</body>