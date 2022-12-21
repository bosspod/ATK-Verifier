<?php session_start();
include('../login/condb.php');

$ID = $_SESSION['ID'];
$name = $_SESSION['name'];
$level = $_SESSION['level'];
if ($level != 'admin') {
	Header("Location: ../login/logout.php");
}
?>
<?php
include("../data/condb.php");
?>
<?php
$sql = mysqli_query($condb, "SELECT * FROM result ORDER BY no DESC");
if (mysqli_num_rows($sql) == 0) {
	echo '<tr><td colspan="8">Data not found.</td></tr>';
} else {
	$no = 1;
	while ($row = mysqli_fetch_assoc($sql)) {
		if (isset($_POST['aksi']) == 'delete') {
			$no = $_POST['no'];
			$cek = mysqli_query($condb, "SELECT * FROM result WHERE no='$no'");

			if (mysqli_num_rows($cek) == 0) {
				echo '<script>alert("Data not found");window.location.replace("index.php");</script>';
			} else {
				$delete = mysqli_query($condb, "DELETE FROM result WHERE no='$no'");
				$hostname = "http://102.129.138.164/project/";
				$ai_filename = $hostname . 'cer/atk/' . $row['file_name'] . '.jpg';
				$delete_ai = mysqli_query($condb, "DELETE FROM ai WHERE filename='$ai_filename'");
				$delete_atk = '../cer/atk/' . $row['file_name'] . '.jpg';
				$delete_cer = '../cer/cer/' . $row['file_name'] . '.jpg';
				$delete_qr = '../cer/qr/' . $row['file_name'] . '.jpg';
				@unlink($delete_atk);
				@unlink($delete_cer);
				@unlink($delete_qr);
				if ($delete) {
					echo '<script>alert("Successful deletion");window.location.replace("index.php");</script>';
				} else {
					echo '<script>alert("Error deletion");window.location.replace("index.php");</script>';
				}
			}
		}
	}
}

?>