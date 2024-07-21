<html>

<head>
    <meta charset="UTF-8">
    <title>eDocx - Online Document Request System</title>
    <link rel="stylesheet" href="./new-req.css">

</head>

</html>

<?php
include 'config.php';

$is_uploading = $_FILES["choosefile"]["error"];
$can_pass = $is_uploading == 0 ? true : false;

if ($can_pass) {
    echo '
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
    setTimeout(function () {
        swal({
            title: "Receipt Uploaded Successfully!",
            text: "Proceed to Review Agreements",
            icon: "success",
            button: "Next"
        }).then(function()  {
            window.location = "new-req.php";
    });
    });
</script>';

    if (isset($_POST['upload'])) {
        $studentno = $_SESSION['studentno'];
        $filename = $_FILES["choosefile"]["name"];

        $tempname = $_FILES["choosefile"]["tmp_name"];

        $folder = "image/" . $filename;

        $sql = "UPDATE orders SET filename = '$filename' WHERE student_id='$studentno'";
        $result = mysqli_query($con, $sql);

        if (move_uploaded_file($tempname, $folder)) {

            $msg = "Image uploaded successfully";
        } else {

            $msg = "Failed to upload image";
        }
    }
} else {
    echo ' 
		<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
			swal({
				title: "File not found!",
				text: "Upload your transaction receipt",
				icon: "error",
				button: "Ok"
			}).then(function()  {
				window.location = "new-req.php";
			});
		});
	</script>';
}
