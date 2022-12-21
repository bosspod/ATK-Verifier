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
				<a class="btn btn-dark" href="scan.php">Scaned Certificate</a>
				<a class="btn btn-outline-dark" href="qr.php">QR Users ATK</a>
			</div>
			<div class="col-lg-11">
				<h2 class="mt-80">Scaned Certificate</h2>
				<hr />

				<div class="table-responsive">
					<table class="table table-striped table-hover text-center">
						<tr>
							<th>No.</th>
							<th>Student ID</th>
							<th>Name-Surname</th>
							<th>Faculty</th>
							<th>Department</th>
							<th>Program</th>
							<th>ATK QR</th>
						</tr>
						<?php
						$sql = mysqli_query($condb, "SELECT * FROM student ORDER BY id DESC");
						if (mysqli_num_rows($sql) == 0) {
							echo '<tr><td colspan="7">Data not found.</td></tr>';
						} else {
							$no = 1;
							while ($row = mysqli_fetch_assoc($sql)) {
								echo '
							<tr>
							<td>' . $no . '</td>
							<td>' . $row['student_id'] . '</td>
							<td>' . $row['student_name'] . ' ' . $row['student_surname'] . '</td>
							<td>' . $row['student_faculty'] . '</td>
							<td>' . $row['student_department'] . '</td>
							<td>' . $row['student_program'] . '</td>
							';
							if(!file_exists('qr/' . $row['student_id'] . '.jpg')){
								echo '
								<td>
								<form action="qr-atk.php" method="post">
									<input type="hidden" name="id" value="' . $row['student_id'] . '">
									<button class="btn btn-primary btn-sm mt-1" name="gen" title="Generate QR"><span class="lni-printer" aria-hidden="true"></span></button>
								</form>
								</td>							
								';
							}else{
								echo '							
								<td> 
								<img src="qr/' . $row['student_id'] . '.jpg" width="100px" height="100px"> 
								</td>';
							}
							echo '							
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