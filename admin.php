<?php
include "config.php";

if (isset($_POST['submit'])) {

	$username = mysqli_real_escape_string($con, $_POST['username']);
	$password = mysqli_real_escape_string($con, $_POST['password']);


	if ($username != "" && $password != "") {

		$sql_query = "select count(*) as cntUser from manager where username='" . $username . "' and password='" . $password . "'";
		$result = mysqli_query($con, $sql_query);
		$row = mysqli_fetch_array($result);

		$count = $row['cntUser'];

		if ($count > 0) {
			$_SESSION['username'] = $username;
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
						window.location = "dash.php";
				});
				}, 1000);
			</script>';
			//header('Location: dash.php');
		} else {
			echo ' 
                <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <script type="text/javascript">
                $(document).ready(function() {
                    swal({
                        title: "Login Failed!",
                        text: "Incorrect credentials",
                        icon: "error",
                        button: "Ok",
                        timer: 2000
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
	<link rel="stylesheet" href="./adminstyle.css">

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
					<label for="chk" aria-hidden="true">Login&nbsp;<p style="font-size:18px"> (Admin)</p></label>
					<input type="text" id="username" name="username" placeholder="User Name" required="" />
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