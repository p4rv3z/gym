<?php
include 'user_header.php';
?>
<?php
$flag = false;
$upload_dir = "images";
$msg_name = "";
$msg_contact_number = "";
$msg_date_of_birth ="";
$msg_address = "";
if (!empty($user_name)) {
		$sql = "SELECT * FROM `users_information` WHERE `user_name`='$user_name'";
		$result = $GLOBALS['connection']->query($sql);
		if ($result->num_rows==1) {
			$row = $result->fetch_assoc();
			$flag = true;
			$name = $row['name'];
			$contact_number = $row['contact_number'];
			$date_of_birth = $row['date_of_birth'];
			$gender = $row['gender'];
			$address = $row['address'];
			$image_path = $row['image_path'];
			}else{
				$flag = false;
				//$name = $row['name'];
				//$image_path = "default.png";
			}
		if(isset($_FILES['fupload'])){
			$file_name = $_FILES['fupload']['name'];
			$file_type = $_FILES['fupload']['type'];
			if(!is_dir ($upload_dir )){
			mkdir($upload_dir);
			}
			if($file_type=="image/jpeg" or $file_type=="image/gif" or $file_type=="image/png" or $file_type=="image/jpg"){
			$copy_to = "$upload_dir/$file_name";
			$t = copy($_FILES['fupload']['tmp_name'], $copy_to) or die("Couldn't copy!");
				if($t){
					$image_path = $file_name;
					//header("refresh: 0;");
				}else{
					echo "db error42";
				}
			}else{
			echo "Images Type Error";
			}
		}
		if (isset($_POST['save'])) {
			$name = $_POST['name'];
			$contact_number = $_POST['contact_number'];
			$date_of_birth = $_POST['date_of_birth'];
			$gender = $_POST['gender'];
			//$image_path = $_POST['image_path'];
			$address = $_POST['address'];
			if ($flag) {
				//update	
				$sql2 = "UPDATE `users_information` SET `name`='$name',`contact_number`='$contact_number',`date_of_birth`='$date_of_birth',`gender`='$gender',`image_path`='$image_path',`address`='$address' WHERE `user_name` = '$user_name'";
			}else{
				//insert
				$sql2 = "INSERT INTO `users_information`(`user_name`, `name`, `contact_number`, `date_of_birth`, `gender`, `image_path`, `address`) VALUES ('$user_name','$name','$contact_number','$date_of_birth','$gender','$image_path','$address')";
			}
			$result2 = $GLOBALS['connection']->query($sql2);
			if ($result2 === TRUE) {
				header("refresh: 0;");
			}else{
				echo "db error512";
			}
		}
}else{
	//goto login page
}
?>
<div>
	<form class="profile" method="POST" action="" enctype="multipart/form-data">
		<table>
			<tr style="background-color: #ededed;">
				<td colspan="2">
				<img src="images/<?php if (!empty($image_path)){echo $image_path;}else{echo 'default.png';}?>" style="width:200px;height:200px;"><br>
				<input type="file" name="fupload"><br>
				<input type="submit" name="submit" value="Upload">
				</td>
			</tr>
			<tr>
				<td colspan="2">
					Name:<br>
					<input type="text" name="name" value="<?php if(!empty($name))echo $name;?>"><p><?php echo $msg_name;?></p>
				</td>	
			</tr>
			<tr>
				<td colspan="2">
					Contact Number:<br>
					<input type="text" name="contact_number" value="<?php if(!empty($contact_number))echo $contact_number;?>"><p><?php echo $msg_contact_number;?></p>
				</td>	
			</tr>
			<tr>
				<td>
					Date of Birth:<br>
					<input type="date" name="date_of_birth" value="<?php if(!empty($date_of_birth))echo $date_of_birth;?>"><p><?php echo $msg_date_of_birth;?></p>
				</td>	
			</tr>
			<tr>
				<td>
					Gender: 
					<input type="radio" name="gender" value="Male" <?php if(empty($gender)||$gender=="Male"){echo "checked";}?> > Male
  					<input type="radio" name="gender" value="Female" <?php if(!empty($gender)&&$gender=="Female"){echo "checked";}?> > Female
  					<input type="radio" name="gender" value="Other" <?php if(!empty($gender)&&$gender=="Other"){echo "checked";}?> > Other
				</td>	
			</tr>
			<tr>
				<td>
					Address:<br>
					<input type="address" name="address" value="<?php if(!empty($address))echo $address;?>"><p><?php echo $msg_address;?></p>
				</td>	
			</tr>
			<tr>
				<td>
					<input type="submit" name="save" value="<?php if($flag==1){echo 'Update';}else{echo 'Save';}?>">
				</td>
			</tr>
		</table>
	</form>
</div>
<?php
include 'user_footer.php';
?>