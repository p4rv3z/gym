<?php
session_start();
include 'database_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>GYM</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
  $name = "";
  $user_name = "";
  $user_image_path = "";
  $flag = FALSE;
	if(!empty($_SESSION["user_name"])&&!empty($_SESSION["user_password"])){
			$user_name = $_SESSION["user_name"];
			$user_password = $_SESSION["user_password"];
			checkwithdatabase($user_name,$user_password);
	}else{
		//jumpto("index.php");	
	}
	function checkwithdatabase($user_name,$user_password){
		//check with admin table data
		$sql = "SELECT `user_name`, `user_password` FROM `users` WHERE user_name = '$user_name'";
		$result = $GLOBALS['connection']->query($sql);
		if ($result->num_rows==1) {
			//data found
			//check with session
			$row = $result->fetch_assoc();//convert to array
			if($user_password==$row['user_password']){
				//ok returns
				getuserinfo($user_name);
			}else{
				$GLOBALS['flag']=FALSE;
				//jumpto("index.php");
			}
		}else{
			$GLOBALS['flag']=FALSE;
			//jumpto("index.php");
		}
		
	}
	function getuserinfo($user_name){
		$sql2 = "SELECT * FROM `users_information` WHERE user_name = '$user_name'";
		$result2 = $GLOBALS['connection']->query($sql2);
		if ($result2->num_rows==1) {
			$row2 = $result2->fetch_assoc();
			$GLOBALS['name'] = $row2['name'];
			$GLOBALS['user_name'] = $row2['user_name'];
			$GLOBALS['user_image_path'] = $row2['image_path'];
			$GLOBALS['flag']=TRUE;
		}else{
			$row2 = $result2->fetch_assoc();
			$GLOBALS['name'] = "Mr. X";
			$GLOBALS['user_name'] = $user_name;
			$GLOBALS['user_image_path'] = "default.png";
			$GLOBALS['flag']=TRUE;
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
 //echo $name.$user_name.$user_image_path;
?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Bangladesh GYM</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
	  <li><a href="#">Gallery</a></li>
	  <li><a href="#">About</a></li>
	  <li><a href="#">Contact Us</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
	<?php
	if(!$flag){
		?>
      <li><a href="registration.php"><span class="glyphicon glyphicon-user"></span> Online Registration</a></li>
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
	  <?php
	}else{
	  ?>
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php  echo $name;?><img src="images/<?php echo $user_image_path;?>" style="width:25px;height:25px; padding:5px"><span class="caret"></span></a>
        <ul class="dropdown-menu" style="text-align:right;">
          <li style="background-color:red;text-align:center;"><img src="images/<?php echo $user_image_path;?>" style="width:100px;height:100px; padding:5px" class="img-circle"><br><?php echo $user_name;?></li>
          <li><a href="#">Activities</a></li>
          <li><a href="user_profile.php">Profile</a></li>
          <li><a href="index.php?logout">Logout</a></li>
        </ul>
      </li>
	<?php }?>
    </ul>
  </div>
</nav>