<?php session_start(); 
include('../../login/condb.php');
 
  $ID = $_SESSION['ID'];
  $name = $_SESSION['name'];
  $level = $_SESSION['level'];
 	if($level!='admin'){
    Header("Location: ../../login/logout.php");  
  }  
?>
<?php
include("condb.php");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Admin | Add</title>

    <link rel="shortcut icon" href="../../img/Logo.png" type="image/png">

    <link rel="stylesheet" href="../../css/bootstrap.min.css">

	<link rel="stylesheet" href="../../css/popup.css">
	
    <link rel="stylesheet" href="../../css/default.css">

    <link rel="stylesheet" href="../../css/style.css">
	
    <link rel="stylesheet" href="../../css/LineIcons.css">
	
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	
</head>

<body>
<div id="main-content">
    <header id="home" class="header-area">
        <div class="navigation fixed-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="">
                                <img src="../../img/Logo.png" width = " 50px" alt="Logo" onerror="Error()">
                            </a>
                            <div class="collapse navbar-collapse"></div>
				            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item"><a class="page-scroll" href="home">Main Data</a></li>	
                                    <li class="nav-item active"><a class="page-scroll" href="">Add data</a></li>
                                    <li class="nav-item"><a class="page-scroll" href="ban">Ban</a></li>
                                									
                                </ul>
                            </div>
				<div class="dropdown ml-25">
				<button class="btn dropdown-toggle" type="button" id="language" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="lni-user"></i>
				</button>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="language">
				<a class="dropdown-item" href="../../">Home Page</a>
				<a class="dropdown-item" href="../../admin/">Admin Page</a>
				<hr>
				<form class="form-inline ml-auto my-2 my-lg-0" action="../../login/logout.php">
				<input class="dropdown-item" type="submit" value="Logout"/>
				</form>
				</div>
				</div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>  
<section class="about-area pt-125 pb-130">
<div class="container">
		<div class="col-lg-12">
			<h2 class="mt-80">Add Data</h2>
			<hr />

			<?php
			if(isset($_POST['add'])){
				$username = $_POST['username'];
				$pass = $_POST['password'];
                $base64 = base64_encode($pass);
                $sha1 = sha1($base64);
				$password = md5($sha1);
				$name = $_POST['name'];
				$level = $_POST['level'];
				$check = "SELECT * FROM login  WHERE  username = '$username'";
				$result = mysqli_query($koneksi,$check) or die(mysql_error());
				$num=mysqli_num_rows($result);
					if($num > 0){
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Oops, This data already exists!</div>';
					}else{
						$insert = mysqli_query($koneksi, "INSERT INTO login(username, password, name, level) VALUES('$username','$password','$name','$level')") or die(mysqli_error());
						if($insert){
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Saved Successfully.</div>';
						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Oops, Data failed to save!</div>';
						}
					}
					
			}
			?>
</br><font size="4"><br>


			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">Username</label>
					<div class="col-sm-12">
						<input type="text" name="username" class="form-control" placeholder="Username" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Password</label>
					<div class="col-sm-12">
						<input type="password" name="password" class="form-control" placeholder="Password" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Name</label>
					<div class="col-sm-12">
						<input type="text" name="name" class="form-control" placeholder="Name" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Level</label>
					<div class="col-sm-12">
						<select name="level" class="form-control" required>
							<option value="">Select level</option>
							<option value="admin">Admin</option>
							<option value="user">User</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Save">
						<a href="home" class="btn btn-sm btn-danger">Cancel</a>
					</div>
				</div>
			</form>
			</font>
		</div>
	</div>
    </section>
	</body>
</html>							

    <footer id="footer" class="footer-area">
        <div class="footer-widget pt-60 pb-60 gray-bg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="footer-content text-center">
                            <a href="">
                                <img src="../../img/Logo.png" width = "75px" alt="Logo">
                            </a>
                            <p class="mt-">     </p>
                            <ul>
									<li><a target="_blank" href="https://line.me/ti/p/Cg4pt0yWRj"><i class="lni-line"></i></a></li>
									<li><a target="_blank" href="https://www.facebook.com/Podsawee.Wanatham"><i class="lni-facebook-filled"></i></a></li>
									<li><a target="_blank" href="https://www.instagram.com/boss_pod/"><i class="lni-instagram-original"></i></a></li>
									<li><a target="_blank" href="https://twitter.com/Boss__pod"><i class="lni-twitter-original"></i></a></li>
                            </ul>
                        </div> 
                    </div>
                </div> 
            </div> 
        </div> 
        <div class="footer-copyright pb-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-text text-center pt-20">
                            <p>Copyright © 2020. Podsawee Wanatham</p>
                        </div> 
                    </div>
                </div> 
            </div> 
        </div> 
        </div> 
    </footer>

    <a href="#" class="back-to-top"><i class="lni-chevron-up"></i></a>
    <script src="../../js/jquery-1.12.4.min.js"></script>

    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/popper.min.js"></script>

    <script src="../../js/jquery.magnific-popup.min.js"></script>

    <script src="../../js/parallax.min.js"></script>

    <script src="../../js/waypoints.min.js"></script>
    <script src="../../js/jquery.counterup.min.js"></script>

    <script src="../../js/jquery.appear.min.js"></script>

    <script src="../../js/scrolling-nav.js"></script>
    <script src="../../js/jquery.easing.min.js"></script>

    <script src="../../js/main.js"></script>
	
	<script src="../../js/required-en.js"></script>
	
</body>

</html>
