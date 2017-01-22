<?php
session_start();
//require_once 'database_connection.php';
include '../database_connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
</head>
<body>
<h1>Admin Log in page.</h1>
<!--Session data-->
<?php
	if(!empty($_SESSION["admin_user_name"])&&!empty($_SESSION["admin_password"])){
			$admin_user_name = $_SESSION["admin_user_name"];
			$admin_password = $_SESSION["admin_password"];
		checkwithdatabase($admin_user_name,$admin_password);
	}else{
		//create session and log in form	
	}
	function checkwithdatabase($admin_user_name,$admin_password){
		//check with admin table data
		$sql = "SELECT `admin_email`, `admin_password` FROM `admin` WHERE admin_user_name = '$admin_user_name'";
		$result = $GLOBALS['connection']->query($sql);
		if ($result->num_rows==1) {
			//data found
			//check with session
			$row = $result->fetch_assoc();//convert to array
			if($admin_password==$row['admin_password']){
				//jump to admin panel
				//save session
				$_SESSION["admin_user_name"] = $admin_user_name;
				$_SESSION["admin_password"] = $admin_password;
				jumpto("admin.php");
			}else{
				//data found but password not match
				//todo
			}
		}else{
			//data not found 
			//user name not match
			//todo
			//jumpto("admin.php");
		}
	}
	function jumpto($url_name){
		header("Location: $url_name");
	}
if(isset($_POST['login'])){
	$admin_user_name = trim($_POST['admin_user_name']);
	$admin_password = trim($_POST['admin_password']);
	if(!empty(trim($admin_user_name))&&!empty($admin_password)){
		checkwithdatabase($admin_user_name,$admin_password);
	}
}
?>
<form class="login" autocomplete="on" method="POST" action="">
	<h1>Log In Form:</h1>
	<input type="text" name="admin_user_name" placeholder="User Name ex. p4rv3z"><p></p>
	<input type="password" name="admin_password" placeholder="Password"><p></p>
	<input type="submit" name="login" value="Log In">
</form>
</body>
</html>

<?php
$GLOBALS['connection']->close();
?>