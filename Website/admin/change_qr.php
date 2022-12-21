<?php session_start(); 
include('../login/condb.php');
 
  $ID = $_SESSION['ID'];
  $name = $_SESSION['name'];
  $level = $_SESSION['level'];
 	if($level!='admin'){
    Header("Location: ../login/logout.php");  
  }  

include("../data/condb.php");

if(isset($_POST['filename'])){
    $filename = $_POST['filename'];
    
    $value = $_POST['change_qr'];

    if($value == "M"){
        $result = "match";
        $update = mysqli_query($condb, "UPDATE ai SET qr='$result' WHERE filename='$filename' " ) or die(mysqli_error($condb));
        if($update){
            echo '<script>alert("Change Value Completed");window.location.replace("index.php");</script>';
        }else{
            echo '<script>alert("Change Value Not Completed");window.location.replace("index.php");</script>';
        }
    }else if($value == "N"){
        $result = "not match";
        $update = mysqli_query($condb, "UPDATE ai SET qr='$result' WHERE filename='$filename' " ) or die(mysqli_error($condb));
        if($update){
            echo '<script>alert("Change Value Completed");window.location.replace("index.php");</script>';
        }else{
            echo '<script>alert("Change Value Not Completed");window.location.replace("index.php");</script>';
        }
    }else{
        echo '<script>alert("Value Incorrect");window.location.replace("index.php");</script>';
    }   
}else{
    echo '<script>alert("Data not found");window.location.replace("index.php");</script>';
   
}
