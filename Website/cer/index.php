<?php
include('../data/condb.php');

if (isset($_POST['id'])) {
	$id = $_POST['id'];
} else {
	header('Location: ../');
}
if ($_POST['result_check']=="detected") {

	$name_surname = $_POST['name_surname'];
	$faculty = $_POST['faculty'];
	$department = $_POST['department'];
	$program = $_POST['program'];
	$date_check = $_POST['date_check'];
	$time_check = $_POST['time_check'];
	$result = $_POST['result_check'];
	if($_POST['status']=="2"){
		$outsite_name = $_POST['outsite_name'];
	}else{
		$outsite_name = "Student";
	}
	
	$date_time = date("d/m/Y h:i:s A"); 
	$date_time_file = date("d-m-Y-h-i-s-A"); 
	
	$qr_link = "none";
	$filename = $date_time_file.'-'.$id;
	$verify = "none";
	$hostname = "http://102.129.138.164/project/";
	$ai_filename = $hostname.'cer/atk/'.$filename.'.jpg';
	$qr_ver = "none";

	$picture_check = $_FILES['picture_check'];
	if($picture_check != '') {
	
		$path="atk/";
		
		$type = strrchr($_FILES['picture_check']['name'],".");
		
		$newname = $filename.'.jpg';
		$path_copy=$path.$newname;
		$path_link="atk/".$newname;
		if($_FILES["picture_check"]["type"]=='image/png' || $_FILES["picture_check"]["type"]=='image/jpeg'){
			move_uploaded_file($_FILES['picture_check']['tmp_name'],$path_copy);

			$insert = mysqli_query($condb, "INSERT INTO result(timestamp, student_id, student_name, outside_name, covid, qr_data, file_name) VALUES('$date_time','$id','$name_surname','$outsite_name','$result','$qr_link','$filename')") or die(mysqli_error());
			$insert_ai = mysqli_query($condb, "INSERT INTO ai(result,student_id,filename,verify,qr) VALUES('$result','$id','$ai_filename','$verify','$qr_ver')") or die(mysqli_error());
		}
	}



	header('Location: error/contact_teacher.php');
}else{


header('Content-type: image/jpeg');

$font = realpath('source/PrintAble4U.ttf');
$image = imagecreatefromjpeg("source/format.jpg");
$color = imagecolorallocate($image, 255, 255, 255);

$name_surname = $_POST['name_surname'];
$faculty = $_POST['faculty'];
$department = $_POST['department'];
$program = $_POST['program'];
$date_check = $_POST['date_check'];
$time_check = $_POST['time_check'];
$result = $_POST['result_check'];
if($_POST['status']=="2"){
	$outsite_name = $_POST['outsite_name'];
}else{
	$outsite_name = "Student";
}

$date_time = date("d/m/Y h:i:s A"); 
$date_time_file = date("d-m-Y-h-i-s-A"); 

$qr_link = $date_time_file.'_'.$id.'_'.$date_check.'-'.$time_check.'_'.$result;
$filename = $date_time_file.'-'.$id;
$verify = "none";
$hostname = "http://102.129.138.164/project/";
$ai_filename = $hostname.'cer/atk/'.$filename.'.jpg';
$qr_ver = "none";

$picture_check = $_FILES['picture_check'];
if($picture_check != '') {

	$path="atk/";
	
	$type = strrchr($_FILES['picture_check']['name'],".");
	
	$newname = $filename.'.jpg';
	$path_copy=$path.$newname;
	$path_link="atk/".$newname;
	if($_FILES["picture_check"]["type"]=='image/png' || $_FILES["picture_check"]["type"]=='image/jpeg'){
		move_uploaded_file($_FILES['picture_check']['tmp_name'],$path_copy);
		
		$url = 'https://chart.googleapis.com/chart?cht=qr&chs=500x500&chl='.$qr_link.'';
		$qr = file_get_contents($url);
		file_put_contents('qr/'.$filename.'.jpg',$qr);
		
		$insert = mysqli_query($condb, "INSERT INTO result(timestamp, student_id, student_name, outside_name, covid, qr_data, file_name) VALUES('$date_time','$id','$name_surname','$outsite_name','$result','$qr_link','$filename')") or die(mysqli_error());
		$insert_ai = mysqli_query($condb, "INSERT INTO ai(result,student_id,filename,verify,qr) VALUES('$result','$id','$ai_filename','$verify','$qr_ver')") or die(mysqli_error());
		
		
		$bbox_0 = imageftbbox(90, 0, $font, $id);
		$x_0 = $bbox_0[0] + (imagesx($image) / 2) - (($bbox_0[2] - $bbox_0[0]) / 2) - 5;
		imagettftext($image,90, 0, (int)$x_0, 440, $color, $font, $id);

		$bbox_1 = imageftbbox(65, 0, $font, $name_surname);
		$x_1 = $bbox_1[0] + (imagesx($image) / 2) - (($bbox_1[2] - $bbox_1[0]) / 2) - 5;
		imagettftext($image, 65, 0, (int)$x_1, 580, $color, $font, $name_surname);

		$bbox_2 = imageftbbox(55, 0, $font, $department);
		$x_2 = $bbox_2[0] + (imagesx($image) / 2) - (($bbox_2[2] - $bbox_2[0]) / 2) - 5;
		imagettftext($image, 55, 0, (int)$x_2, 650, $color, $font, $department);
		
		$bbox_3 = imageftbbox(40, 0, $font, $outsite_name);
		$x_3 = $bbox_3[0] + (imagesx($image) / 2) - (($bbox_3[2] - $bbox_3[0]) / 2) - 5;
		imagettftext($image, 40, 0, (int)$x_3, 750, $color, $font, $outsite_name);
		
		imagettftext($image, 20, 0, 800, 40, $color, $font, $date_time);

		$frame = imagecreatefromstring(file_get_contents('qr/'.$filename.'.jpg'));
		imagecopymerge($image, $frame, 290, 1210, 0, 0, 500, 500, 100);
		imagejpeg($image,'cer/'.$filename.'.jpg');
		//imagejpeg($image);
		imagedestroy($image);

		header('Location: success.php');
	}else{
		header('Location: error/file_not_support.php');
	}
}
}
