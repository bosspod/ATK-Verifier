<?php
include("condb.php");
?>
<?php	
	$username = $_POST["username"];
	$old = $_POST["oldpassword"];
	$base64_1 = base64_encode($old);
    $sha1_1 = sha1($base64_1);
	$oldpassword = md5($sha1_1);
	$password = $_POST["password"];
	$repassword = $_POST["repassword"];
	echo $oldpassword;

	$sql = "select username from login where username='$username' and password='$oldpassword'";
	$result = mysqli_query($koneksi,$sql);

	$num = mysqli_num_rows($result);
		
	if ($num==0)
		die("<script>
				alert('Old password incorrect');
				window.location='../';
			 </script>");

	if ($password != $repassword)
		die("<script>
				alert('Password is not same');
				window.location='../';
			 </script>");

	$pass = $_POST["password"];
	$base64 = base64_encode($pass);
    $sha1 = sha1($base64);
	$password = md5($sha1);
	
	$sql = "update login set
			password='$password'
			where username='$username'
			";
	$result = mysqli_query($koneksi,$sql) or die("Err : $sql");
	
	echo "<script>
			alert('Update Password');
			window.location='../';
		  </script>";
?>