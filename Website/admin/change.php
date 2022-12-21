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
    
    $value = $_POST['change'];

    if($value == "P"){
        $result = "detected";
        $verify = "Positive";
        $update = mysqli_query($condb, "UPDATE ai SET result='$result', verify='$verify' WHERE filename='$filename' " ) or die(mysqli_error($condb));
        if($update){
            echo '<script>alert("Change Value Completed");window.location.replace("index.php");</script>';
        }else{
            echo '<script>alert("Change Value Not Completed");window.location.replace("index.php");</script>';
        }
    }else if($value == "N"){
        $result = "none";
        $verify = "Negative";
        $update = mysqli_query($condb, "UPDATE ai SET result='$result', verify='$verify' WHERE filename='$filename' " ) or die(mysqli_error($condb));
        if($update){
            echo '<script>alert("Change Value Completed");window.location.replace("index.php");</script>';
        }else{
            echo '<script>alert("Change Value Not Completed");window.location.replace("index.php");</script>';
        }
    }else if($value == "A"){
        $verify = "NotATK";
        $update = mysqli_query($condb, "UPDATE ai SET verify='$verify' WHERE filename='$filename' " ) or die(mysqli_error($condb));
        if($update){
            echo '<script>alert("Change Value Completed");window.location.replace("index.php");</script>';
        }else{
            echo '<script>alert("Change Value Not Completed");window.location.replace("index.php");</script>';
        }
    }else if($value == "B"){
        $verify = "none";
        $update = mysqli_query($condb, "UPDATE ai SET verify='$verify' WHERE filename='$filename' " ) or die(mysqli_error($condb));
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
