<?php
include "config.php";

// Check user login or not
if (!isset($_SESSION['studentno'])) {
  header('Location: index.php');
}

// logout
if (isset($_POST['logout'])) {
  session_destroy();
  header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<link rel="stylesheet" href="new-req.css" />
<script src="script.js" defer></script>
<script src="req.js" defer></script>
<script src="form.js" defer></script>
<script src="upload.js" defer></script>
<title>eDocx</title>

<head>


</head>

<body>
  <?php include "header.php" ?>
  <div class="form">
    <div class="content">
      <!-- Progress bar -->
      <div class="progressbar">
        <div class="progress" id="progress"></div>

        <div class="progress-step progress-step-active" data-title="Welcome"></div>
        <div class="progress-step" data-title="Request Details"></div>
        <div class="progress-step" data-title="Pay Documents"></div>
        <div class="progress-step" data-title="Agreements"></div>
      </div>

      <!-- STEP 1 : WELCOME -->
      <div class="form-step form-step-active">
        <div class="input-group">
          <?php
          $studentno = $_SESSION['studentno'];
          $sqln = "SELECT CONCAT(firstname,' ',lastname) AS sname FROM `accounts` WHERE studentno = '$studentno' ";
          $resultn = mysqli_query($con, $sqln);

          if (!($selectRes = $resultn)) {
            echo 'Retrieval of data from Database Failed - #' . mysqli_errno($con) . ': ' . mysqli_error($con);
          } else {
            if (mysqli_num_rows($selectRes) == 0) {
              echo '<tr><td colspan="4">No Rows Returned</td></tr>';
            } else {
              while ($row = mysqli_fetch_assoc($selectRes)) {
                echo "<label for='username'>Step 1 : WELCOME &nbsp; <b style='color:green; text-transform:uppercase'>{$row['sname']}</b></label><br>";
              }
            }
          }

          ?>

          <div class="pad"><i class="fa fa-clock-o" style="font-size:20px;color:gray"></i>&ensp; Office Hours
            <hr>
            <p style="font-size:large; font-family:Verdana, Geneva, Tahoma, sans-serif; color:red;">
              &emsp; Monday to Friday<br>
              &emsp; 8:00 am to 5:00 pm<br>
            </p>
            <p style="font-size:xx-small;color:gray">&emsp; *Note: Document request is open only during office hours</p>
          </div>
        </div>
        <div class="input-group">
          <label for="position"></label>
          <div class="wew"><i class="fa fa-bell" style="font-size:20px;color:gray"></i>&ensp; Reminders
            <hr><br>
            <div class="ins">
              <i class="fa fa-check" style="font-size:24px"></i> REMINDERS BEFORE YOU REQUEST FOR DOCUMENTS
            </div>
            <ul style="line-height: 1.5;font-family:Arial, Helvetica, sans-serif">
              <li><b>Clear any financial or academic hold</b> on your records.<br>
                Current students may view the clearance via this link <a href="https://ilearnu.lu.edu.ph/student/ledger" style="color:green; text-decoration:none">https://ilearnu.lu.edu.ph/student/ledger</a> </li>
              <br>
              <li><b>Check if grades have been posted</b> (for recently-awarded grades only)<br>
                One week after grade consultation day, only grades posted in <a href="https://ilearnu.lu.edu.ph/student/grades/academic-performance" style="color:green; text-decoration:none">https://ilearnu.lu.edu.ph/student/grades/academic-performance</a> will appear on your Transcript of Records</li>
              <br>
              <li><b>Check the schedule</b> for requesting Transcript of Records with Date of Graduation <br> (for graduating students only)<br>
                Please check the schedule via this link <a href="http://lu.edu.ph/events-calendar" style="color:green; text-decoration:none"> http://lu.edu.ph/events-calendar </a> </li>
            </ul>

          </div>

        </div>
        <div class="input-group">
          <label for="username"></label>
          <div class="wew">
            <div class="ins">
              <i class="fa fa-check" style="font-size:24px" /></i> PAYMENT REMINDER
            </div><br>
            <font style="line-height: 1.5;font-family:Arial, Helvetica, sans-serif">
              A <font style="color:red;"><b><u>No Refund Policy</u></b></font> is strictly implemented due to the automated payment feature of this facility. Cancellation,<br>
              subtitution, or refund requests...
              <br>
              <br>
              due to (1) requester error, (2) change of mind or (3) pending clearances <b><u> will not </u></b> be accommodated.<br><br><br>
              <center>By clicking <font style="color:green;"><b>Next</b></font>, the requester understands and agrees to the <font style="color:red;"><b><u>No Refund Policy</u></b></font> and to the <br>
                <font style="color:red;"><b><u>Data Privacy Policy</u></b></font> of the LU Office of the University Registrar.
              </center>
            </font>
          </div>
        </div>

        <div class="btn-group">
          <a href="#" class="btn btn-next" style="float:right">Next &raquo;</a>
        </div>
      </div>

      <!-- STEP 2 : REQUEST DETAILS -->
      <div class="form-step">
        <div class="input-group">
          <label for="phone">Step 2 : REQUEST DETAILS</label>

          * Choose the document/s to be requested and enter the number of copies you intend to have. <br> <br>

          <form action="checkbox-db.php" method="POST" enctype="multipart/form-data">
            <center>
              <table>
                <thead>
                  <tr>
                    <th></th>
                    <th>Copies</th>
                    <th>AVAILABLE DOCUMENTS</th>
                    <th>UNIT COST (in Php)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><label class="container">
                        <input type="checkbox" name="prodid[]" value="True Copy of Grades (TCG)">
                        <span class="checkmark"></span>
                      </label></td>
                    <td><label for="quantity"></label>
                      <input type="number" name="prod_qty[]" value="1" min="1" style="width:5em; height:2.5em">
                      <input type="hidden" name="prodname[]" value="True Copy of Grades (TCG)">
                      <input type="hidden" name="prod_price[]" value="100.00">
                    </td>
                    <td>True Copy of Grades (TCG)</td>
                    <td>100.00</td>
                  </tr>
                  <tr>
                    <td><label class="container">
                        <input type="checkbox" name="prodid[]" value="Certificate of Units Earned">
                        <span class="checkmark"></span>
                      </label></td>
                    <td><label for="quantity"></label>
                      <input type="number" name="prod_qty[]" value="1" min="1" style="width:5em; height:2.5em">
                      <input type="hidden" name="prodname[]" value="Certificate of Units Earned">
                      <input type="hidden" name="prod_price[]" value="50.00">
                    </td>
                    <td>Certificate of Units Earned</td>
                    <td>50.00</td>
                  </tr>
                  <tr>
                    <td><label class="container">
                        <input type="checkbox" name="prodid[]" value="Good Moral Character">
                        <span class="checkmark"></span>
                      </label></td>
                    <td><label for="quantity"></label>
                      <input type="number" name="prod_qty[]" value="1" min="1" style="width:5em; height:2.5em">
                      <input type="hidden" name="prodname[]" value="Good Moral Character">
                      <input type="hidden" name="prod_price[]" value="100.00">
                    </td>
                    <td>Good Moral Character</td>
                    <td>100.00</td>
                  </tr>
                  <tr>
                    <td><label class="container">
                        <input type="checkbox" name="prodid[]" value="Permit to Transfer">
                        <span class="checkmark"></span>
                      </label></td>
                    <td><label for="quantity"></label>
                      <input type="number" name="prod_qty[]" value="1" min="1" style="width:5em; height:2.5em">
                      <input type="hidden" name="prodname[]" value="Permit to Transfer">
                      <input type="hidden" name="prod_price[]" value="100.00">
                    </td>
                    <td>Permit to Transfer</td>
                    <td>100.00</td>
                  </tr>
                  <tr>
                    <td><label class="container">
                        <input type="checkbox" name="prodid[]" value="Letter of Request for the Release of TOR from Previous School">
                        <span class="checkmark"></span>
                      </label></td>
                    <td><label for="quantity"></label>
                      <input type="number" name="prod_qty[]" value="1" min="1" style="width:5em; height:2.5em">
                      <input type="hidden" name="prodname[]" value="Letter of Request for the Release of TOR from Previous School">
                      <input type="hidden" name="prod_price[]" value="50.00">

                    </td>
                    <td>Letter of Request for the Release of TOR from Previous School</td>
                    <td>50.00</td>
                  </tr>

                  <tr>
                    <td><label class="container">
                        <input type="checkbox" name="prodid[]" value="Certified True Copy of TCG (applicable if with request for TCG)">
                        <span class="checkmark"></span>
                      </label></td>
                    <td><label for="quantity"></label>
                      <input type="number" name="prod_qty[]" value="1" min="1" style="width:5em; height:2.5em">
                      <input type="hidden" name="prodname[]" value="Certified True Copy of TCG (applicable if with request for TCG)">
                      <input type="hidden" name="prod_price[]" value="100.00">
                    </td>
                    <td>Certified True Copy of TCG (applicable if with request for TCG)</td>
                    <td>100.00</td>
                  </tr>
                  <tr>
                    <td><label class="container">
                        <input type="checkbox" name="prodid[]" value="Certified True Copy of Registration Form">
                        <span class="checkmark"></span>
                      </label></td>
                    <td><label for="quantity"></label>
                      <input type="number" name="prod_qty[]" value="1" min="1" style="width:5em; height:2.5em">
                      <input type="hidden" name="prodname[]" value="Certified True Copy of Registration Form">
                      <input type="hidden" name="prod_price[]" value="100.00">
                    </td>
                    <td>Certified True Copy of Registration Form</td>
                    <td>100.00</td>
                  </tr>

                  <tr>
                    <td><label class="container">
                        <input type="checkbox" name="prodid[]" value="Certificate of General Weighted Average (GWA)">
                        <span class="checkmark"></span>
                      </label></td>
                    <td><label for="quantity"></label>
                      <input type="number" name="prod_qty[]" value="1" min="1" style="width:5em; height:2.5em">
                      <input type="hidden" name="prodname[]" value="Certificate of General Weighted Average (GWA)">
                      <input type="hidden" name="prod_price[]" value="50.00">
                    </td>
                    <td>Certificate of General Weighted Average (GWA)</td>
                    <td>50.00</td>
                  </tr>
                  <tr>
                    <td><label class="container">
                        <input type="checkbox" name="prodid[]" value="Certificate of Grading System">
                        <span class="checkmark"></span>
                      </label></td>
                    <td><label for="quantity"></label>
                      <input type="number" name="prod_qty[]" value="1" min="1" style="width:5em; height:2.5em">
                      <input type="hidden" name="prodname[]" value="Certificate of Grading System">
                      <input type="hidden" name="prod_price[]" value="50.00">
                    </td>
                    <td>Certificate of Grading System</td>
                    <td>50.00</td>
                  </tr>
                  <tr>
                    <td><label class="container">
                        <input type="checkbox" name="prodid[]" value="Certificate of Year Standing">
                        <span class="checkmark"></span>
                      </label></td>
                    <td><label for="quantity"></label>
                      <input type="number" name="prod_qty[]" value="1" min="1" style="width:5em; height:2.5em">
                      <input type="hidden" name="prodname[]" value="Certificate of Year Standing">
                      <input type="hidden" name="prod_price[]" value="50.00">
                    </td>
                    <td>Certificate of Year Standing</td>
                    <td>50.00</td>
                  </tr>
                  <tr>
                    <td><label class="container">
                        <input type="checkbox" name="prodid[]" value="Verification of Student Records">
                        <span class="checkmark"></span>
                      </label></td>
                    <td><label for="quantity"></label>
                      <input type="number" name="prod_qty[]" value="1" min="1" style="width:5em; height:2.5em">
                      <input type="hidden" name="prodname[]" value="Verification of Student Records">
                      <input type="hidden" name="prod_price[]" value="50.00">
                    </td>
                    <td>Verification of Student Records</td>
                    <td>50.00</td>
                  </tr>
                </tbody>
              </table>
              <br>
              <input type="submit" name="submits" class="subton" value="Click Me">
              <p class="clickme">...if you are certain of the details for it cannot be modified or amended. </p>
            </center>
        </div>
        </form>
        <div class="btns-group">
          <a href="#" class="btn btn-prev">&laquo; Previous</a>
          <a href="#" class="btn btn-next">Next &raquo;</a>
        </div>
      </div>

      <!-- STEP 3 : PAY DOCUMENTS -->
      <div class="form-step">
        <div class="input-group">
          <label for="dob">Step 3 : PAY DOCUMENTS</label>
          <hr>
          <center>
            <?php
            $studentno = $_SESSION['studentno'];
            $sql = "SELECT * FROM `product` WHERE student_id = '$studentno' ";
            $result = mysqli_query($con, $sql);

            if (!($selectRes = $result)) {
              echo 'Retrieval of data from Database Failed - #' . mysqli_errno($con) . ': ' . mysqli_error($con);
            } else {
            ?>
              <table border="2" cellspacing="10" cellpadding="10">
                <thead>
                  <tr>
                    <th>Requested Document/s</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (mysqli_num_rows($selectRes) == 0) {
                    echo '<tr><td colspan="4">No Rows Returned</td></tr>';
                  } else {
                    while ($row = mysqli_fetch_assoc($selectRes)) {


                      echo "<tr><td>{$row['product_name']}</td><td>{$row['product_price']}</td><td>{$row['product_quantity']}</td><td>{$row['total']}</td></tr>\n";
                    }
                  }


                  ?>
                </tbody>
              </table>
            <?php
            }
            ?>
            <?php
            $studentno = $_SESSION['studentno'];
            $sql2 = "SELECT * FROM `orders` WHERE student_id = '$studentno' AND grand_total >= 50.00";
            $result1 = mysqli_query($con, $sql2);
            if (!($selectRes = $result1)) {
              echo 'Retrieval of data from Database Failed - #' . mysqli_errno($con) . ': ' . mysqli_error($con);
            } else {
            ?>
              <hr>
              <table border="2" cellspacing="0" cellpadding="10">

                <tbody>
                  <?php
                  if (mysqli_num_rows($selectRes) == 0) {
                    echo '<tr><td colspan="4"></td></tr>';
                  } else {
                    while ($row = mysqli_fetch_assoc($selectRes)) {

                      echo "<tr><td>Total Amount to Pay:</td><td style='font-size:25px; color:green'><strong>Php {$row['grand_total']}.00</strong></td></tr>";
                    }
                  }


                  ?>
                  </tr>
                </tbody>
              </table>

          </center>
        <?php
            }
        ?>

        <hr>
        <center><br> PAY VIA:<br><img src="assets/qrcode.png" alt="Trulli" width="200" height="200"></center>
        <br><br>
        <center> UPLOAD RECEIPT:<br></center>

        <form action="uploadpic.php" method="POST" enctype="multipart/form-data">
          <label for="input" id="label" class="upload">
            <ion-icon name="cloud-upload-outline" class="upion"></ion-icon>
            <span id="span" class="upspan">Upload your file here</span>
            <input id="input" type="file" name="choosefile" value="" class="upinput">
          </label>

          <button type="submit" name="upload" class="upbutton">
            UPLOAD
          </button>
        </form>
        </div>


        <div class="btns-group">
          <a href="#" class="btn btn-prev">&laquo; Previous</a>
          <a href="#" class="btn btn-next">Next &raquo;</a>
        </div>
      </div>

      <!-- STEP 4 : REVIEW AGREEMENTS -->
      <div class="form-step">
        <div class="input-group">
          <label for="password">Step 4 : REVIEW AGREEMENTS</label><br><br>
          <form action="submit.php" medthod="POST">
            <div class="checkboxs-wrapper">
              Important Notes:<br><br>
              <label class="checkbox-inline" value="">
                <input type="checkbox" name="option[]" id="radio-for-checkboxes1" required />
                &nbsp;I agree to the No Refund Policy. Cancellation, substitution, or refund requests due to (1) requestor error, <br>&nbsp;(2) change of mind or (3) pending clearances will not be accommodated.
              </label><br>
              <label class="checkbox-inline" value="">
                <input type="checkbox" name="option[]" id="radio-for-checkboxes2" required />
                &nbsp;I agree that the requested document/s not claimed after sixty (60) calendar days will be destroyed.
              </label><br>
              <label class="checkbox-inline" value="">
                <input type="checkbox" name="option[]" id="radio-for-checkboxes3" required />
                &nbsp;I read and understood the important notes above and agreed to its terms.
              </label><br><br><br>
            </div>
            <div class="btns-group">
              <a href="#" class="btn btn-prev">&laquo; Previous</a>
              <input type="submit" class="btn btn-success" name="submit" value="SUBMIT">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>