<?php
session_start();
//require_once 'database_connection.php';
include 'database_connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
</head>
<body>
<?php
$msg_email = "";
$msg_user_name = "";
$msg_password = "";
if(isset($_POST['next'])){
	$user_email = trim($_POST['user_email']);
	$user_name = trim($_POST['user_name']);
	$user_password = trim($_POST['user_password']);
	$re_user_password = trim($_POST['re_user_password']);
	if(!empty($user_email)&&!empty($user_name)){
		$sql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
		$result = my_query($sql);
		if ($result->num_rows==1) {
			$msg_email= "E-mail already registrated.";
		}else{
			$sql2 = "SELECT * FROM `users` WHERE user_name = '$user_name'";
			$result2= my_query($sql2);
			if ($result2->num_rows==1) {
			$msg_user_name= "Username already taken.";
			}else{
				if(!empty($user_password)&&!empty($re_user_password)&&$user_password==$re_user_password){
					$sql3 = "INSERT INTO `users`(`user_email`, `user_name`, `user_password`) VALUES ('$user_email','$user_name','$user_password')";
					$result3 = my_query($sql3);
					if ($result3==TRUE) {
						//todo data insert successfull
						//load new page
						//save session
						$_SESSION["user_email"] = $user_email;
						$_SESSION["user_name"] = $user_name;
						$_SESSION["user_password"] = $user_password;
						//echo "Insert";
						jumpto('user_profile.php');
					}else{
						//data insert failed
						echo "failed";
					}
				}else{
					$msg_password= "Password not match.";
				}
			}
		}
	}else{
		$msg_email= "Field cannot be empty.";
		$msg_user_name= "Field cannot be empty.";
	}
}
	function my_query($sql){
	return $GLOBALS['connection']->query($sql);
	}
	function jumpto($url_name){
		header("Location: $url_name");
	}
?>
<form class="registration" autocomplete="on" method="POST" action="">
	<h1>REGINTRATION:</h1>
	<input type="email" name="user_email" value="<?php if(!empty($user_email))echo $user_email;?>" placeholder="E-mail ex. mail@mail.com"><p><?php echo $msg_email;?></p>
	<input type="username" name="user_name" value="<?php if(!empty($user_name)) echo $user_name;?>" placeholder="User Name ex. p4rv3z"><p><?php echo $msg_user_name;?></p>
	<input type="password" name="user_password" placeholder="Password"><p><?php echo $msg_password;?></p>
	<input type="password" name="re_user_password" placeholder="Re-Password"><p><?php echo $msg_password;?></p>
	<input type="submit" name="next" value="Next">
</form>
</body>
</html>
<?php
$GLOBALS['connection']->close();
?>