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
				<a class="btn btn-outline-dark" href="index.php">Covid Certificate</a>
				<a class="btn btn-dark" href="scan.php">Scaned Certificate</a>
				<a class="btn btn-dark" href="qr.php">QR Users ATK</a>
			</div>
			<div class="col-lg-11">
				<h2 class="mt-80">ATK Certificate</h2>
				<hr />
				<h2 class="mt-80 mb-20">Covid Detected</h2>
				<div class="table-responsive">
					<table class="table table-striped table-hover text-center">
						<tr>
							<th>No.</th>
							<th>Student ID</th>
							<th>Name-Surname</th>
							<th>Outside Name</th>
							<th>ATK Picture</th>
							<th>Result Verify</th>
							<th>ATK Verify</th>
							<th>Delete</th>
						</tr>
						<?php
						$sql = mysqli_query($condb, "SELECT * FROM result WHERE covid='detected' ORDER BY no DESC");

						if (mysqli_num_rows($sql) == 0) {
							echo '<tr><td colspan="8">Data not found.</td></tr>';
						} else {
							$no = 1;
							while ($row = mysqli_fetch_assoc($sql)) {
								$hostname = "http://102.129.138.164/project/";
								$ai_filename = $hostname . 'cer/atk/' . $row['file_name'] . '.jpg';
								$sql_ai = mysqli_query($condb, "SELECT * FROM ai WHERE filename='$ai_filename'");
								while ($row_ai = mysqli_fetch_assoc($sql_ai)) {
									if ($row_ai['result'] == "none" && $row_ai['verify'] == "Negative") {
										$result = '<a style="background-color: #9ef799;">N (User)| N (AI)</a>';
									} else if ($row_ai['result'] == "detected" && $row_ai['verify'] == "Positive") {
										$result = '<a style="background-color: #db4467;">P (User)| P (AI)</a>';
									} else if ($row_ai['result'] == "detected" && $row_ai['verify'] == "Negative") {
										$result = '<a style="background-color: #db8644;">P (User)| N (AI)</a>';
									} else if ($row_ai['result'] == "none" && $row_ai['verify'] == "Positive") {
										$result = '<a style="background-color: #db8644;">N (User)| P (AI)</a>';
									} else if ($row_ai['verify'] == "NotATK") {
										$result = '<a style="background-color: #d67dfa;">Not a ATK</a>';
									} else if ($row_ai['verify'] == "none") {
										$result = '<a style="background-color: #cfcaca;">Waiting for AI</a>';
									} else {
										$result = '<a style="background-color: #f5e856;">Not Sure !!</a>';
									}

									echo '
						<tr>
							<td>' . $no . '</td>
							<td>' . $row['student_id'] . '</td>
                            <td>' . $row['student_name'] . '</td>
                            <td>' . $row['outside_name'] . '</td>
							<td> 
								<img src="../cer/atk/' . $row['file_name'] . '.jpg" width="100px" height="100px"> 
							</td>
							<td>' . $result . '
							<form action="change.php" method="post">
							<input type="hidden" name="filename" value="' . $row_ai['filename'] . '">
							<button class="btn btn-primary btn-sm mt-1" name="change" value="N" onclick="return confirm(\'Are you sure to change result and verify to Negative. ' . $row['file_name'] . '?\')">N</button>
							<button class="btn btn-danger btn-sm mt-1" name="change" value="P" onclick="return confirm(\'Are you sureto change result and verify to Positive. ' . $row['file_name'] . '?\')">P</button>
							<button class="btn btn-warning btn-sm mt-1" name="change" value="A" onclick="return confirm(\'Are you sure to change verify to NotATK. ' . $row['file_name'] . '?\')">-</button>
							<button class="btn btn-secondary btn-sm mt-1" name="change" value="B" onclick="return confirm(\'Are you sure to change verify to none. ' . $row['file_name'] . '?\')">AI</button>
							</form>						
							</td>
							<td>' . $row_ai['qr'] . '
							<form action="change_qr.php" method="post">
							<input type="hidden" name="filename" value="' . $row_ai['filename'] . '">
							<button class="btn btn-primary btn-sm mt-1" name="change_qr" value="M" onclick="return confirm(\'Are you sure to change result and verify to Match. ' . $row['file_name'] . '?\')">M</button>
							<button class="btn btn-danger btn-sm mt-1" name="change_qr" value="N" onclick="return confirm(\'Are you sureto change result and verify to Not Match. ' . $row['file_name'] . '?\')">N</button>
							</form>								
							</td>
							<td>
								<form action="delete.php" method="post">
									<input type="hidden" name="no" value="' . $row['no'] . '">
									<button class="btn btn-danger btn-sm mt-1" name="aksi" title="Delete Data" onclick="return confirm(\'Are you sure to delete data. ' . $row['file_name'] . '?\')" value="delete"><span class="lni-trash" aria-hidden="true"></span></button>
								</form>
							</td>
							</tr>';
									$no++;
								}
							}
						}
						?>
					</table>
				</div>
				<h2 class="mt-80 mb-20">Covid Not Detected</h2>
				<div class="table-responsive">
					<table class="table table-striped table-hover text-center">
						<tr>
							<th>No.</th>
							<th>Student ID</th>
							<th>Name-Surname</th>
							<th>Outside Name</th>
							<th>Info</th>
							<th>ATK Picture</th>
							<th>Certificate Picture</th>
							<th>QRCODE Picture</th>
							<th>Result Verify</th>
							<th>ATK Verify</th>
							<th>Delete</th>
						</tr>
						<?php
						$sql = mysqli_query($condb, "SELECT * FROM result WHERE covid='none' ORDER BY no DESC");
						if (mysqli_num_rows($sql) == 0) {
							echo '<tr><td colspan="10">Data not found.</td></tr>';
						} else {
							$no = 1;
							while ($row = mysqli_fetch_assoc($sql)) {
								$hostname = "http://102.129.138.164/project/";
								$ai_filename = $hostname . 'cer/atk/' . $row['file_name'] . '.jpg';
								$sql_ai = mysqli_query($condb, "SELECT * FROM ai WHERE filename='$ai_filename'");
								while ($row_ai = mysqli_fetch_assoc($sql_ai)) {
									if ($row_ai['result'] == "none" && $row_ai['verify'] == "Negative") {
										$result = '<a style="background-color: #9ef799;">N (User)| N (AI)</a>';
									} else if ($row_ai['result'] == "detected" && $row_ai['verify'] == "Positive") {
										$result = '<a style="background-color: #db4467;">P (User)| P (AI)</a>';
									} else if ($row_ai['result'] == "detected" && $row_ai['verify'] == "Negative") {
										$result = '<a style="background-color: #db8644;">P (User)| N (AI)</a>';
									} else if ($row_ai['result'] == "none" && $row_ai['verify'] == "Positive") {
										$result = '<a style="background-color: #db8644;">N (User)| P (AI)</a>';
									} else if ($row_ai['verify'] == "NotATK") {
										$result = '<a style="background-color: #d67dfa;">Not a ATK</a>';
									} else if ($row_ai['verify'] == "none") {
										$result = '<a style="background-color: #cfcaca;">Waiting for AI</a>';
									} else {
										$result = '<a style="background-color: #f5e856;">Not Sure !!</a>';
									}

									echo '
						<tr>
							<td  width="3%">' . $no . '</td>
							<td width="10%">' . $row['student_id'] . '</td>
                            <td width="10%">' . $row['student_name'] . '</td>
                            <td width="7%">' . $row['outside_name'] . '</td>
                            <td  width="15%">' . $row['qr_data'] . '</td>
							<td> 
							<img src="../cer/atk/' . $row['file_name'] . '.jpg" width="100px" height="100px"> 
							</td>
							<td> 
							<img src="../cer/cer/' . $row['file_name'] . '.jpg" width="100px" height="100px"> 
							</td>
							<td> 
							<img src="../cer/qr/' . $row['file_name'] . '.jpg" width="100px" height="100px"> 
							</td>
							<td>' . $result . '
							<form action="change.php" method="post">
							<input type="hidden" name="filename" value="' . $row_ai['filename'] . '">
							<button class="btn btn-primary btn-sm mt-1" name="change" value="N" onclick="return confirm(\'Are you sure to change result and verify to Negative. ' . $row['file_name'] . '?\')">N</button>
							<button class="btn btn-danger btn-sm mt-1" name="change" value="P" onclick="return confirm(\'Are you sureto change result and verify to Positive. ' . $row['file_name'] . '?\')">P</button>
							<button class="btn btn-warning btn-sm mt-1" name="change" value="A" onclick="return confirm(\'Are you sure to change verify to NotATK. ' . $row['file_name'] . '?\')">-</button>
							<button class="btn btn-secondary btn-sm mt-1" name="change" value="B" onclick="return confirm(\'Are you sure to change verify to none. ' . $row['file_name'] . '?\')">AI</button>
							</form>
							</td>
							<td>' . $row_ai['qr'] . '
							<form action="change_qr.php" method="post">
							<input type="hidden" name="filename" value="' . $row_ai['filename'] . '">
							<button class="btn btn-primary btn-sm mt-1" name="change_qr" value="M" onclick="return confirm(\'Are you sure to change result and verify to Match. ' . $row['file_name'] . '?\')">M</button>
							<button class="btn btn-danger btn-sm mt-1" name="change_qr" value="N" onclick="return confirm(\'Are you sureto change result and verify to Not Match. ' . $row['file_name'] . '?\')">N</button>
							</form>							
							</td>
							<td>
								<form action="delete.php" method="post">
									<input type="hidden" name="no" value="' . $row['no'] . '">
									<button class="btn btn-danger btn-sm mt-1" name="aksi" title="Delete Data" onclick="return confirm(\'Are you sure to delete data. ' . $row['file_name'] . '?\')" value="delete"><span class="lni-trash" aria-hidden="true"></span></button>
								</form>
							</td>
							</tr>';
									$no++;
								}
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