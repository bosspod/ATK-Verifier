<?php
include("src/asset/main.php");

echo $html5;

echo $head;

?>

<body>

	<?php echo $header; ?>

	<?php
	if (isset($_POST['submit'])) {
		$id = $_POST['id'];

		if ($id != "") {
			Header("Location: data/?id=$id");
		}
	}
	?>
	<section class="about-area pt-125 pb-130">
		<div class="container">
			<div class="col-lg-12">
				<h2 class="mt-80 text-center">ATK Verifier System</h2>
				<hr />
				<form class="form-horizontal" action="" method="post">
					<div class="form-group">
						<label class="col-sm-12 control-label">Student ID [รหัสประจำตัว]</label>
						<div class="col-sm-12">
							<input type="text" name="id" class="form-control" required>
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

	<?php echo $footer; ?>

</body>

</html>