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
include("../src/asset/main.php");

echo $html5;

echo $head;

?>

<body>

	<?php echo $header; ?>

	<section class="about-area pt-125 pb-130">
		<center>
			<div class="mt-80">
				<h3 class="mb-10">Admin Menu</h3>
				<a class="btn btn-dark" href="index.php">Covid Certificate</a>
				<a class="btn btn-outline-dark" href="scan.php">Scaned Certificate</a>
				<a class="btn btn-dark" href="qr.php">QR Users ATK</a>
			</div>
			<div class="col-lg-11">
				<h2 class="mt-80">Scaned Certificate</h2>
				<hr />

				<div class="table-responsive">
					<table class="table table-striped table-hover text-center">
						<tr>
							<th>No.</th>
							<th>Info</th>
							<th>Time</th>
							<th>Delete</th>
						</tr>
						<?php
						$sql = mysqli_query($condb, "SELECT * FROM scan ORDER BY date DESC");
						if (mysqli_num_rows($sql) == 0) {
							echo '<tr><td colspan="4">Data not found.</td></tr>';
						} else {
							$no = 1;
							while ($row = mysqli_fetch_assoc($sql)) {
								echo '
						<tr>
							<td>' . $no . '</td>
							<td>' . $row['scan'] . '</td>
                            <td>' . $row['date'] . '</td>
							<td>
								<form action="delete_scan.php" method="post">
									<input type="hidden" name="scan" value="' . $row['scan'] . '">
									<button class="btn btn-danger btn-sm mt-1" name="aksi" title="Delete Data" onclick="return confirm(\'Are you sure to delete data. ' . $row['scan'] . '?\')" value="delete"><span class="lni-trash" aria-hidden="true"></span></button>
								</form>
							</td>
							</tr>';
								$no++;
							}
						}
						?>
					</table>
				</div>
			</div>
		</center>
	</section>

	<?php echo $footer; ?>

</body>

</html>