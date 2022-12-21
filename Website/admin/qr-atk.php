<?php session_start(); 
include('../login/condb.php');
 
  $ID = $_SESSION['ID'];
  $name = $_SESSION['name'];
  $level = $_SESSION['level'];
 	if($level!='admin'){
    Header("Location: ../login/logout.php");  
  }  
   
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $url = 'https://chart.googleapis.com/chart?cht=qr&chs=500x500&chl=' . $id . '';
    $qr = file_get_contents($url);
    file_put_contents('qr/' . $id . '.jpg', $qr);
    header('Location: qr.php');
} else {
    header('Location: ../');
}

