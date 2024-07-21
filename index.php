<?php
include "config.php";

if (isset($_POST['submit'])) {

	$studentno = mysqli_real_escape_string($con, $_POST['studentno']);
	$password = mysqli_real_escape_string($con, $_POST['password']);


	if ($studentno != "" && $password != "") {

		$sql_query = "select count(*) as cntUser from accounts where studentno='" . $studentno . "' and password='" . $password . "'";
		$result = mysqli_query($con, $sql_query);
		$row = mysqli_fetch_array($result);

		$count = $row['cntUser'];

		if ($count > 0) {
			$_SESSION['studentno'] = $studentno;
			echo '
				<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
				<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
				<script type="text/javascript">
				setTimeout(function () {
					swal({
						title: "Login Success!",
						text: "Welcome to eDocx",
						icon: "success",
						button: "Start"
					}).then(function()  {
						window.location = "new-req.php";
				});
				});
			</script>';
		} else {
			echo ' 
                <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <script type="text/javascript">
                setTimeout(function ()  {
                    swal({
                        title: "Login Failed!",
                        text: "Incorrect credentials",
                        icon: "error",
                        button: "Ok",
                    });
                });
            </script>';
		}
	}
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>eDocx - Online Document Request System</title>
	<link rel="stylesheet" href="./style.css">

</head>

<body>

	<!-- Login Page -->
	<!DOCTYPE html>
	<html>

	<head>
		<title>eDocx : Login</title>
		<link rel="stylesheet" type="text/css" href="slide navbar style.css">
		<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
	</head>

	<body>
		<div class="main">
			<input type="checkbox" id="chk" aria-hidden="true">

			<div class="about">
				<form>
					<label for="chk" aria-hidden="true">eDocx</label>
					<div class="eula">eDocx is a web-based system that enables students to electronically request documents from the Office of the Registrar</div>
				</form>
			</div>

			<div class="login">
				<form action="" method="post">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="text" id="studentno" name="studentno" placeholder="Student Number" required="" />
					<input type="password" id="password" name="password" placeholder="Password" required="" />
					<input type="submit" name="submit" value="LOGIN" id="submit" class="libutton" />

				</form>
			</div>
		</div>
	</body>

	</html>
	<!-- Login -->

</body>

</html>

</html>