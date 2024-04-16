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
		<title>Add Product</title>
	</head>
	<body>
		<?php
			if(isset($_GET['product_name'])){
				$product_name 		= $_GET['product_name'];
				$product_category 	= $_GET['product_category'];
				$prdouct_code 		= $_GET['prdouct_code'];
				$prdocut_entry_date = $_GET['prdocut_entry_date'];
				
				$sql =  "INSERT INTO product (product_name, product_category, prdouct_code, prdocut_entry_date) 
						 VALUES ('$product_name', '$product_category', '$prdouct_code', '$prdocut_entry_date')";
						
				if($conn->query($sql) == TRUE){
					echo 'Data Inserted!';
				}else{
					echo 'Data not Inserted!';
				}
				
			}
			
		?>
	
		<?php
			$sql = "SELECT * FROM category";
			$query = $conn->query($sql);
			
		?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
			Product :<br>
			<input type="text" name="product_name"><br><br>
			Product Category :<br>
			<select name="product_category">
				<?php
					while($data = mysqli_fetch_array($query)){
						$category_id = $data['category_id'];
						$category_name = $data['category_name'];
						
						echo "<option value='$category_id'>$category_name</option>";
					}
				?>
			</select><br><br>
			Product Code :<br>
			<input type="text" name="prdouct_code"><br><br>
			Product Entry Date :<br>
			<input type="date" name="prdocut_entry_date"><br><br>
			<input type="submit" value="submit">
		</form>
	</body>
 </html>
 <?php
	}else{
		header('location:login.php');
	}
?>