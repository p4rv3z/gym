<?php
session_start();
//require_once 'database_connection.php';
include 'database_connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
</head>
<body>
<h1>User Log in page.</h1>
<!--Session data-->
<?php
	if(!empty($_SESSION["user_name"])&&!empty($_SESSION["user_password"])){
			$user_name = $_SESSION["user_name"];
			$user_password = $_SESSION["user_password"];
		checkwithdatabase($user_name,$user_password);
	}else{
		//create session and log in form	
	}
	function checkwithdatabase($user_name,$user_password){
		//check with admin table data
		$sql = "SELECT `user_email`, `user_name`, `user_password` FROM `users` WHERE user_name = '$user_name'";
		$result = $GLOBALS['connection']->query($sql);
		if ($result->num_rows==1) {
			//data found
			//check with session
			$row = $result->fetch_assoc();//convert to array
			if($user_password==$row['user_password']){
				//jump to admin panel
				//save session
				$_SESSION["user_name"] = $user_name;
				$_SESSION["user_password"] = $user_password;
				jumpto("user_activity.php");
			}else{
				//data found but password not match
				//todo
			}
		}else{
			//data not found 
			//user name not match
			//todo
			jumpto("user_activity.php");
		}
	}
	function jumpto($url_name){
		header("Location: $url_name");
	}
if(isset($_POST['login'])){
	$user_name = trim($_POST['user_name']);
	$user_password = trim($_POST['user_password']);
	if(!empty(trim($user_name))&&!empty($user_password)){
		checkwithdatabase($user_name,$user_password);
	}
}
?>
<form class="login" autocomplete="on" method="POST" action="">
	<h1>Log In Form:</h1>
	<input type="text" name="user_name" placeholder="User Name ex. p4rv3z"><p></p>
	<input type="password" name="user_password" placeholder="Password"><p></p>
	<input type="submit" name="login" value="Log In">
</form>
</body>
</html>

<?php
$GLOBALS['connection']->close();
?>