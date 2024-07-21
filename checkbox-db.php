<html>

<head>
	<meta charset="UTF-8">
	<title>eDocx - Online Document Request System</title>
	<link rel="stylesheet" href="./new-req.css">

</head>

</html>

<?php
include 'config.php';
if (!empty($_POST['prodid'])) {
	echo '
				<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
				<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
				<script type="text/javascript">
				setTimeout(function () {
					swal({
						title: "Details Sent!",
						text: "Proceed to Pay Documents",
						icon: "success",
						button: "Next"
					}).then(function()  {
						window.location = "new-req.php";
				});
				});
			</script>';
	if (isset($_POST['submits'])) {
		$checked_array = $_POST['prodid'];
		$studentno = $_SESSION['studentno'];
		$totalSum = 0;

		foreach ($_POST['prodname'] as $key => $value) {
			if (in_array($_POST['prodname'][$key], $checked_array)) {
				$prodname = $_POST['prodname'][$key];
				$prod_price = $_POST['prod_price'][$key];
				$prod_qty = $_POST['prod_qty'][$key];
				$total = $prod_price * $prod_qty;
				$totalSum += $total;


				$insertqry = "INSERT INTO `product`( `student_id`, `product_name`, `product_price`, `product_quantity`,`total`) VALUES ('$studentno','$prodname','$prod_price','$prod_qty','$total')";
				$insertqry = mysqli_query($con, $insertqry);
			}
		}


		$qry = "SELECT SUM(total) AS count FROM product WHERE student_id='$studentno'";
		$res = $con->query($qry);

		$gtotal = 0;
		$rec = $row = $res->fetch_assoc();
		$gtotal = $rec['count'];
		$status = 'Pending';

		$insertqry = "INSERT INTO `orders`( `student_id`, `grand_total`, `status`) VALUES ('$studentno','$gtotal','$status')";
		$insertqry = mysqli_query($con, $insertqry);
	}
} else {
	echo ' 
		<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
			swal({
				title: "Failed!",
				text: "Select a document to request",
				icon: "error",
				button: "Ok"
			}).then(function()  {
				window.location = "new-req.php";
			});
		});
	</script>';
}
//header('Location: new-req.php');
