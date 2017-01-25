<?php
include 'header.php';
?>
<article>
<form method="POST" action="">
	<table>
		<tr>
			<td><input type="search" name="search" value="Search by email"></td>
			<td><input type="submit" name="submit"></td>
		</tr>
	</table>
</form>
</article>
<?php
		$sql = "SELECT * FROM `users`";
		$result = $GLOBALS['connection']->query($sql);
		if ($result->num_rows>0) {
			//$row = $result->fetch_assoc();
			while($row=$result->fetch_array()){
				$user_id = trim($row['user_name']);
				$sql2 = "SELECT * FROM `users_information` WHERE `user_name` = '$user_id'";
				$result2 = $GLOBALS['connection']->query($sql2);
				if ($result2->num_rows==1) {
					$row2 = $result2->fetch_assoc();
					$id = trim($row['user_name']);
					//todo table
					?>
					<article>
					<table border="1">
						<tr>
							<td><img src="../images/<?php echo $row2['image_path'];?>" style="width: 20px;height: 20px"></td>
							<td><?php echo $row2['name'];?></td>
							<td><?php echo $row['user_email'];?></td>
							<td><?php echo $row2['contact_number'];?></td>
							<td><?php echo $row2['date_of_birth'];?></td>
							<td><?php echo $row2['gender'];?></td>
							<td><?php echo $row2['address'];?></td>
							<td><a href="user_profile_view.php?view=<?php echo $id;?>">View Profile</a></td>
							<td><a href="member_list.php?delete=<?php echo $id;?>">DELETE</a></td>
						</tr>
					</table>
					</article>
					<?php
				}
			}
		}
		if (isset($_GET['delete'])) {
			$id2 = $_GET['delete'];
			$sql3 = "DELETE FROM `users` WHERE `user_name`= '$id2'";
			$result3 = $connection->query($sql3);
			if ($result3 == TRUE) {
				header("Location: member_list.php");
			}else{
				//Error
				echo "error";
			}
		}
?>
<?php
include 'footer.php';
?>