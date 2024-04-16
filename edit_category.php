<?php
	require('connection.php');
	
	session_start();
	
	$user_first_name = $_SESSION['user_first_name'];
	$user_last_name = $_SESSION['user_last_name'];
	
	if(!empty($user_first_name) && !empty($user_last_name) ){
?>

 <!DOCTYPE html>
 
 <html>
	<head>
		<title>Edit Category</title>
	</head>
	<body>
		<?php
			if(isset($_GET['id'])){
				$getid = $_GET['id'];
				
				$sql = "SELECT * FROM category WHERE category_id=$getid";
				
				$query = $conn->query($sql);
				
				$data = mysqli_fetch_assoc($query);
				
				$category_id 		= $data['category_id'];
				$category_name 		= $data['category_name'];
				$category_entrydate = $data['category_entrydate'];
			}
			
			if(isset($_GET['category_name'])){
				$new_category_name 		= $_GET['category_name'];
				$new_category_entrydate = $_GET['category_entrydate'];
				$new_category_id 		= $_GET['category_id'];
				
				$sql1 = "UPDATE category SET 
						category_name='$new_category_name', 
						category_entrydate='$new_category_entrydate' WHERE category_id=$new_category_id";
						
				if($conn->query($sql1) == TRUE){
					echo 'Update Successful!';
				}else{
					echo 'Not Update';
				}

			}
			
			
		?>
	
		<form action="edit_category.php" method="GET">
			Category :<br>
			<input type="text" name="category_name" value="<?php echo $category_name ?>"><br><br>
			Category Entry Date :<br>
			<input type="date" name="category_entrydate" value="<?php echo $category_entrydate ?>"><br><br>
			<input type="text" name="category_id" value="<?php echo $category_id ?>" hidden>
			<input type="submit" value="Update">
		</form>
	</body>
 </html>
 <?php
	}else{
		header('location:login.php');
	}
?>