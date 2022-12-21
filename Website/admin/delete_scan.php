<?php session_start(); 
include('../login/condb.php');
 
  $ID = $_SESSION['ID'];
  $name = $_SESSION['name'];
  $level = $_SESSION['level'];
 	if($level!='admin'){
    Header("Location: ../login/logout.php");  
  }  
?>
<?php
include("../data/condb.php");
?>
<?php
$sql = mysqli_query($condb, "SELECT * FROM scan ORDER BY date DESC");
	if(mysqli_num_rows($sql) == 0){
		echo '<tr><td colspan="8">Data not found.</td></tr>';
	}else{
		$no = 1;
		while($row = mysqli_fetch_assoc($sql)){
if(isset($_POST['aksi']) == 'delete'){
	$scan = $_POST['scan'];
	$cek = mysqli_query($condb, "SELECT * FROM scan WHERE scan='$scan'");
	
	if(mysqli_num_rows($cek) == 0){
		echo '<script>alert("Data not found");window.location.replace("scan.php");</script>';
	}else{
		$delete = mysqli_query($condb, "DELETE FROM scan WHERE scan='$scan'");
		if($delete){
			echo '<script>alert("Successful deletion");window.location.replace("scan.php");</script>';
		}else{
			echo '<script>alert("Error deletion");window.location.replace("scan.php");</script>';
		}
				}
			}
		}
	}

			?>