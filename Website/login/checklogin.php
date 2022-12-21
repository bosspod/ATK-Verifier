<?php
function get_browser_name($user_agent)
{
    if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
    elseif (strpos($user_agent, 'Edge')|| strpos($user_agent, 'Edg/')) return 'Edge';
    elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
    elseif (strpos($user_agent, 'boss-login-agent/1.0')) return 'Boss';
    elseif (strpos($user_agent, 'Safari')) return 'Safari';
    elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
    elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
	
    
    return 'Unknown';
}
$browserAgent = $_SERVER['HTTP_USER_AGENT'];
?>
<?php
$ip = getenv('HTTP_CLIENT_IP')?:
getenv('HTTP_X_FORWARDED_FOR')?:
getenv('HTTP_X_FORWARDED')?:
getenv('HTTP_FORWARDED_FOR')?:
getenv('HTTP_FORWARDED')?:
getenv('REMOTE_ADDR');
  $country_code = file_get_contents("https://ipinfo.io/$ip/json");
  $arrData = json_decode($country_code,true);
  $loc = $arrData["city"]."/".$arrData["country"];
  $isp = $arrData["org"];
?>
<?php 
session_start();
        if(isset($_POST['username'])){
                  include("condb.php");
                  $username = mysqli_real_escape_string($con,$_POST['username']);
                  $pass = mysqli_real_escape_string($con,$_POST['password']);
                  $base64 = base64_encode($pass);
                  $sha1 = sha1($base64);
				  $password = md5($sha1);
				  $header = "Admin login";

                  $sql="SELECT * FROM login  WHERE  username='".$username."' AND  password='".$password."' ";
                  //$sql="SELECT * FROM login  WHERE  username=admin AND  password='1' or '1' = '1' ";
                  $result = mysqli_query($con,$sql);
				
                  if(mysqli_num_rows($result)==1){
                      $row = mysqli_fetch_array($result);
 
                      $_SESSION["ID"] = $row["ID"];
					  $_SESSION["username"] = $row["username"];
                      $_SESSION["name"] = $row["name"];
                      $_SESSION["level"] = $row["level"];
					  
 
                      if($_SESSION["level"]=="admin"){
						$message = $header. "\n". "Admin " . $username . " is login.\nIP | " . $ip . "\nBrowser | " . get_browser_name($_SERVER['HTTP_USER_AGENT']) ."\nFULL | " .$browserAgent."\nLocation | ".$loc."\nISP | ".$isp."\nCom_Name | " . gethostbyaddr($_SERVER['REMOTE_ADDR']);
						sendlinemesg();
						$res = notify_message($message);
                        Header("Location: ../admin/");
                      }else if($_SESSION["level"]=="user"){
						$message = $header. "\n". "User " . $username . " is login.\nIP | " . $ip . "\nBrowser | " . get_browser_name($_SERVER['HTTP_USER_AGENT']) ."\nFULL | " .$browserAgent."\nLocation | ".$loc."\nISP | ".$isp."\nCom_Name | " . gethostbyaddr($_SERVER['REMOTE_ADDR']);
						sendlinemesg();
						$res = notify_message($message);
                        Header("Location: ../admin/user.php");
                      }else{
						$message = $header. "\n". "Someone is trying login to admin page.\nUser | " . $username . "\nIP | ". $ip . "\nBrowser | " . get_browser_name($_SERVER['HTTP_USER_AGENT']) ."\nFULL | " .$browserAgent."\nLocation | ".$loc."\nISP | ".$isp."\nCom_Name | " . gethostbyaddr($_SERVER['REMOTE_ADDR']);
						sendlinemesg();
						$res = notify_message($message);
						Header("Location: error.php");
                  }
        }else{
 
             Header("Location: error.php"); 
 
        }
    }
?>
<?php 
    function sendlinemesg() {
        define('LINE_API',"https://notify-api.line.me/api/notify");
        define('LINE_TOKEN',"zZ3oziKm3RAri0WU3k65I93GxOnSMfjhGxbsQ4scxbr");

        function notify_message($message) {
            $queryData = array('message' => $message);
            $queryData = http_build_query($queryData,'','&');
            $headerOptions = array(
                'http' => array(
                    'method' => 'POST',
                    'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                                ."Authorization: Bearer ".LINE_TOKEN."\r\n"
                                ."Content-Length: ".strlen($queryData)."\r\n",
                    'content' => $queryData
                )
            );
            $context = stream_context_create($headerOptions);
            $result = file_get_contents(LINE_API, FALSE, $context);
            $res = json_decode($result);
            return $res;
        }
    }
?>