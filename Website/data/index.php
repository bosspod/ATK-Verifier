<!DOCTYPE html>
<?php
include("condb.php");
?>
<?php
include("../src/asset/main.php");

echo $html5;

echo $head;

?>

<body>
	<?php
	$id = $_GET['id'];
	$sql = mysqli_query($condb, "SELECT * FROM student WHERE student_id='$id'");
	if (mysqli_num_rows($sql) == 0) {
		header('Location: ../cer/error/data_not_found.php');
	} else {
		$row = mysqli_fetch_assoc($sql);
	}
	?>

	<?php echo $header; ?>

	<section class="about-area pt-125 pb-130">
		<div class="container">
			<div class="col-lg-12">
				<h2 class="mt-80 text-center">ATK Verifier System</h2>
				<hr />
				<form class="form-horizontal" action="../cer/" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<h3 class="col-sm-12 control-label text-center mb-3">Student Info</h3>
						<table class="text-center" width="100%">
							<tr>
								<td width="20%">
									<h5>Student ID</h5>
								</td>
								<td width="25%">
									<h5>Name-surname</h5>
								</td>
								<td width="20%">
									<h5>Faculty</h5>
								</td>
								<td width="15%">
									<h5>Department</h5>
								</td>
								<td width="15%">
									<h5>Program</h5>
								</td>
							</tr>
							<tr>
								<td width="20%">
									<h6 class="mt-2"><?php echo $row['student_id'] ?></h6>
								</td>
								<input type="hidden" name="id" class="form-control" value="<?php echo $row['student_id'] ?>" required>
								<td width="25%">
									<h6 class="mt-2"><?php echo $row['student_name'] ?> <?php echo $row['student_surname'] ?></h6>
								</td>
								<input type="hidden" name="name_surname" class="form-control" value="<?php echo $row['student_name'] ?> <?php echo $row['student_surname'] ?>" required>
								<td width="20%">
									<h6 class="mt-2"><?php echo $row['student_faculty'] ?></h6>
								</td>
								<input type="hidden" name="faculty" class="form-control" value="<?php echo $row['student_faculty'] ?>" required>
								<td width="15%">
									<h6 class="mt-2"><?php echo $row['student_department'] ?></h6>
								</td>
								<input type="hidden" name="department" class="form-control" value="<?php echo $row['student_department'] ?>" required>
								<td width="15%">
									<h6 class="mt-2"><?php echo $row['student_program'] ?></h6>
								</td>
								<input type="hidden" name="program" class="form-control" value="<?php echo $row['student_department'] ?>" required>
							</tr>
						</table>
					</div>
					<div class="form-group mt-3">
						<label class="col-sm-12 control-label"><b style="color:#000; font-size:24px;">Status</b></label>
						<div class="col-sm-12">
							<select class="form-control" id="status" name="status" required>
								<option value="" selected="selected">Select Status</option>
								<option value="1">Student (<?php echo $row['student_name'] ?> <?php echo $row['student_surname'] ?>)</option>
								<option value="2">Parents / Relatives / Friends / Others</option>
							</select>
						</div>
					</div>
					<div id="outsite_box" class="form-group mt-3">
						<label class="col-sm-12 control-label"><b style="color:#000; font-size:24px;"> Name-Surname</b></label>
						<div class="col-sm-12">
							<input type="text" name="outsite_name" id="outsite_name" placeholder="Name - Surname (Do not include prefix)" class="form-control">
						</div>
					</div>
					<div class="form-group mt-3">
						<label class="col-sm-12 control-label"><b style="color:#000; font-size:24px;">Date</b> of infection</label>
						<div class="col-sm-12">
							<input type="date" name="date_check" class="form-control" min="<?php $date = date("Y-m-d");
																							$date1 = str_replace('-', '/', $date);
																							$yesterday = date('Y-m-d', strtotime($date1 . "-1 days"));
																							echo $yesterday; ?>" max="<?php echo date("Y-m-d"); ?>" required>
						</div>
					</div>
					<div class="form-group mt-3">
						<label class="col-sm-12 control-label"><b style="color:#000; font-size:24px;">Time</b> of infection</label>
						<div class="col-sm-12">
							<input type="time" name="time_check" class="form-control" required>
						</div>
					</div>
					<div class="form-group mt-3">
						<label class="col-sm-12 control-label"><b style="color:#000; font-size:24px;">Result</b> of infection</label>
						<div class="form-check">
							<div class="col-sm-12">
								<input class="form-check-input" type="radio" name="result_check" value="none" id="result_check_ok" checked>
								<label class="form-check-label" for="result_check_ok">Covid-19 not detected</label>
							</div>
						</div>
						<div class="form-check">
							<div class="col-sm-12">
								<input class="form-check-input" type="radio" name="result_check" id="result_check_covid" value="detected">
								<label class="form-check-label" for="result_check_covid">Covid-19 detected</label>
							</div>
						</div>
					</div>
					<div class="form-group mt-3">
						<label class="col-sm-12 control-label"><b style="color:#000; font-size:24px;">Picture</b> of infection (.jpg | .png)</label>
						<div class="col-sm-12">
							<input type="file" name="picture_check" class="form-control" accept="image/*" required>
						</div>
					</div>
					<div class="form-group mt-5">
						<div class="col-sm-12 text-center">
							<input type="submit" name="submit" class="main-btn" value="Submit">
						</div>
					</div>
				</form>
			</div>
		</div>

	</section>
</body>
<script src="../src/js/jquery-1.12.4.min.js"></script>

<script src="../src/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {

		$("#outsite_box").hide();

		$("#status").change(function() {
			var ddl = $("#status").val();
			if (ddl == "2") {
				$("#outsite_box").show();
				$("#outsite_name").val("").focus();
			} else {
				$("#outsite_box").hide();
			}

		});

	});
</script>
<?php echo $footer; ?>

</html>