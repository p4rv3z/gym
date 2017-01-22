<?php
session_start();
//require_once 'database_connection.php';
include '../database_connection.php';
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
  $admin_name = "";
	if(!empty($_SESSION["admin_user_name"])&&!empty($_SESSION["admin_password"])){
			$admin_user_name = $_SESSION["admin_user_name"];
			$admin_password = $_SESSION["admin_password"];
		checkwithdatabase($admin_user_name,$admin_password);
	}else{
		jumpto("index.php");	
	}
	function checkwithdatabase($admin_user_name,$admin_password){
		//check with admin table data
		$sql = "SELECT `admin_name`, `admin_email`, `admin_password` FROM `admin` WHERE admin_user_name = '$admin_user_name'";
		$result = $GLOBALS['connection']->query($sql);
		if ($result->num_rows==1) {
			//data found
			//check with session
			$row = $result->fetch_assoc();//convert to array
			if($admin_password==$row['admin_password']){
				//ok returns
				$GLOBALS['admin_name'] = $row['admin_name'];
				
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
	session_unset();
	session_destroy();
	jumpto("index.php");
	exit;
 }
?>

<div class="container">

<header>
   <h1>ADMIN PANEL</h1>
   <p style="color:white;text-align:right;"><?php echo $admin_name;?></p>
   <ul style="list-style-type:none;color:white;text-align:right;"><li><a  href="admin.php?logout">Logout</a></li></ul>
   
</header>
<nav>
  <ul>
    <li><a href="member_list.php">Member List</a></li>
    <li><a href="trainer_list.php">Trainer List</a></li>
    <li><a href="account.php">Account</a></li>
    <li><a href="message.php">Message</a></li>
  </ul>
</nav>
