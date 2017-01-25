<?php
include 'header.php';
?>
<?php
	if (isset($_GET['view'])) {
			$user_id = trim($_GET['view']);
			$sql = "SELECT * FROM `users_information` WHERE `user_name` = '$user_id'";
				$result = $GLOBALS['connection']->query($sql);
				if ($result->num_rows==1) {
					$row = $result->fetch_assoc();
					?>
					<article>
						<table>
							<tr>
								<td><img src="../images/<?php echo $row['image_path'];?>" style="width: 200px;height: 200px;"></td>
							</tr>
							<tr>
								<td>Name:<br><?php echo $row['name'];?></td>
							</tr>
							<tr>
								<td><?php echo $row['contact_number'];?></td>
							</tr>
							<tr>
							<td><?php echo $row['date_of_birth'];?></td>
							</tr>
							<tr>
							<td><?php echo $row['gender'];?></td>
							</tr>
							<tr>
							<td><?php echo $row['address'];?></td>
							</tr>
						</table>
					</article>
					<?php
				}else{
					echo "Data not Found.";
				}

	}
?>

<?php
include 'footer.php';
?>