<?php
session_start();
include 'database_connection.php';
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="admin/css/style.css">
</head>
<body>
<?php
  $user_email = "";
  //$user_name = "";
	if(!empty($_SESSION["user_name"])&&!empty($_SESSION["user_password"])){
			$user_name = $_SESSION["user_name"];
			$user_password = $_SESSION["user_password"];
		checkwithdatabase($user_name,$user_password);
	}else{
		jumpto("index.php");
	}
	function checkwithdatabase($user_name,$user_password){
		//check with admin table data
		$sql = "SELECT * FROM `users` WHERE user_name = '$user_name'";
		$result = $GLOBALS['connection']->query($sql);
		if ($result->num_rows==1) {
			//data found
			//check with session
			$row = $result->fetch_assoc();//convert to array
			if($user_password==$row['user_password']){
				//ok returns
				$GLOBALS['user_email'] = $row['user_email'];
				
			}else{
				jumpto("index.php");
			}
		}else{
			jumpto("index.php");
		}
		
	}
	function jumpto($url_name){
		header("Location: $url_name");
	}
	if (isset($_GET['logout'])) {
	unset($_SESSION['user_name']);
	unset($_SESSION['user_password']);
	jumpto("index.php");
	exit;
 }
?>

<div class="container">

<header>
   <h1>USER PANEL</h1>
   <p style="color:white;text-align:right;"><?php echo $user_email;?></p>
   <ul style="list-style-type:none;color:white;text-align:right;"><li><a  href="user_header.php?logout">Logout</a></li></ul>
   
</header>
<nav>
  <ul>
    <li><a href="#">Profile</a></li>
    <li><a href="#">Activity</a></li>
    <li><a href="#">Payment</a></li>
    <li><a href="#">Message</a></li>
  </ul>
</nav>
