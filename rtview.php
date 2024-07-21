<?php
include "config.php";
// Check user login or not


?>

<html lang="en" class="">

<head>
  <meta name="robots" content="noindex">

  <link rel="mask-icon" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-8f3771b1072e3c38bd662872f6b673a722f4b3ca2421637d5596661b4e2132cc.svg" color="#111">
  <link rel="canonical" href="https://codepen.io/FlorinCornea/pen/poPeRKB">

  <link href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">



  <style class="INLINE_PEN_STYLESHEET_ID">
    body {
      font-family: 'Roboto';
      background-color: white;
      display: grid;
      place-items: center;
      margin: 0;
      min-height: 100vh;
    }

    .page {
      position: relative;
      display: grid;
      grid-template-columns: 200px auto;
      background-image: linear-gradient(-70deg, #f5f7ff, #c7c7c7);
      height: 600px;
      width: 80%;
      margin: 40px 0;
      border-radius: 80px;
    }

    .menu {
      margin: 20px;
      border-radius: 60px;
      box-sizing: border-box;
      list-style-type: none;
      height: calc(100% - 40px);
      width: 160px;
      background-image: linear-gradient(-40deg, #041C09, #1A3B23);
    }

    .menu a.menu-item {
      display: block;
      text-decoration: none;
    }

    .menu a.menu-item:hover .icon,
    .menu a.menu-item.active .icon {
      background-image: linear-gradient(-70deg, #08bfb3, #44e4c4);
      color: #eee;
      border-radius: 10px 10px 0 10px;
      z-index: 2;
    }

    .menu a.menu-item:hover .text,
    .menu a.menu-item.active .text {
      background-color: #1ABA3A;
      z-index: -1;
      border-radius: 10px 0 0 10px;
      width: 54%;
    }

    .menu .icon {
      position: relative;
      color: #0e8af6;
      margin: 5px;
      padding: 10px;
    }

    .menu .text {
      color: #eee;
      padding: 20px 20px 20px 25px;
      margin: 0 0 0 -30px;
    }

    .menu p {
      line-height: 24px;
      vertical-align: middle;
      display: inline-block;
    }

    .menu a.logo {
      display: block;
      width: 100%;
      height: 60px;
      text-align: center;
      visibility: hidden;
    }

    .main ul {
      list-style: none;
      margin-right: 20px;
      padding: 0;
    }

    .main ul li {
      width: 100%;
      display: grid;
      grid-template-columns: 60% 15% 20%;
      background: #fff;
      border: 1px solid #eee;
      padding: 10px;
      box-sizing: border-box;
      border-radius: 10px;
      border-right: 10px solid #44e4c4;
    }

    .main ul li:hover {
      transform: scale(1.1);
      box-shadow: 3px 5px 12px #555;
    }

    .main ul li div:not(:last-child) {
      border-right: 2px solid #eee;
    }

    .main ul li div {
      padding: 5px 10px;
    }

    h2 {
      max-width: 150px;
      margin: 10px 20px;
      padding: 10px 40px;
      border-bottom: 3px solid #44e4c4;
    }
  </style>



  <script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeConsoleRunner-7549a40147ccd0ba0a6b5373d87e770e49bb4689f1c2dc30cccc7463f207f997.js"></script>
  <script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRefreshCSS-4793b73c6332f7f14a9b6bba5d5e62748e9d1bd0b5c52d7af6376f3d1c625d7e.js"></script>
  <script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRuntimeErrors-4f205f2c14e769b448bcf477de2938c681660d5038bc464e3700256713ebe261.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>


<body data-new-gr-c-s-check-loaded="14.1060.0" data-gr-ext-installed="">
  <?php include "header.php" ?>
  <div class="page">
    <aside class="menu">
      <a href="" class="logo">Logo</a>
      <a href="dash.php" class="menu-item active">
        <p class="material-icons icon">dashboard</p>
        <p class="text">ALL ORDERS</p>
      </a>

      <a href="new-track.php" class="menu-item">
        <p class="material-icons icon">logout</p>
        <p class="text">Back</p>

      </a>

    </aside>
    <section class="main">
      <h2>My Orders</h2>


      <?php

      $studentno = $_SESSION['studentno'];

      $sql = "SELECT * FROM product WHERE student_id = '$studentno' ";
      $result = mysqli_query($con, $sql);

      if (!($selectRes = $result)) {
        echo 'Retrieval of data from Database Failed - #' . mysqli_errno($con) . ': ' . mysqli_error($con);
      } else {
      ?>
        <table border="2">
          <thead>
            <ul>
              <li>
                <div>Requested Document/s</div>
                <div>Price</div>
                <div>No. of Copies</div>


              </li>
            </ul>
            </tr>
          </thead>
          <tbody>
            <?php
            if (mysqli_num_rows($selectRes) == 0) {
              echo '<tr><td colspan="4">No Rows Returned</td></tr>';
            } else {
              while ($row = mysqli_fetch_assoc($selectRes)) {
                echo "<ul><li>
                <div>{$row['product_name']}</div>
                <div>{$row['product_price']}</div>
                <div>{$row['product_quantity']}</div>
               </li></ul>";
              }
            }
            ?>
          </tbody>
        </table>
      <?php
      }
      ?>

    </section>
  </div>

  <script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-1b93190375e9ccc259df3a57c1abc0e64599724ae30d7ea4c6877eb615f89387.js"></script>

</body>
<grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration>

</html>