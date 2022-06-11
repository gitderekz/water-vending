<!DOCTYPE html>
<html>
<head>
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<meta charset="utf-8">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
	<title>WATER VENDING</title>
</head>
<body>
	<?php require_once 'process.php'; ?>

	<?php 

	if(isset($_SESSION['message'])): ?>
		<div class="alert alert-<?=$_SESSION['msg_type']?>">
			<?php
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			?>
		</div>
	<?php endif; ?>
	


	<div class="container">

		<?php 
			$mysqli = new mysqli('localhost', 'root', '', 'water_vending') or die(mysqli_error($mysqli));

			$result = $mysqli->query("SELECT * FROM clients") or die($mysqli->error);
			// pre_r($result); 
		?>
		
		<div class="row justify-content-center">
			<table class="table table-striped table-dark ">
				<thead>
					<tr>
						<th>No</th>
						<th>Name</th>
						<th>Card</th>
						<th>Balance</th>
						<th>Action</th>
						<th><a href="index.php" class="btn btn-info">Sales</a></th>
					</tr>
				</thead>
				<?php 
					while ($row = $result->fetch_assoc()): ?>
						<tr>
							<td><?php echo $row['id'] ?></td>
							<td><?php echo $row['name'] ?></td>
							<td><?php echo $row['card'] ?></td>
							<td><?php echo $row['balance'] ?></td>
							<td>
								<a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">EDIT</a>
								<a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">DELETE</a>
							</td>
						</tr>
					<?php endwhile; ?>
			</table>

			<!-- pre_r($result->fetch_assoc()); -->
		</div>	

			
		<?php	

			function pre_r($array){
				echo "<pre>";
				print_r($array);
				echo "</pre>";
			}
		?>


		<div class="row justify-content-center">
			<form action="process.php" method="POST">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<div class="form-group">
					<label>Name</label>
					<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Name" >
				</div>
				<div class="form-group">
					<label>Card Number</label>
					<input type="text" name="card" class="form-control" value="<?php echo $card; ?>"placeholder="Card">
				</div>
				<div class="form-group">
					<label>Balance</label>
					<input type="text" name="balance" class="form-control" value="<?php echo $balance; ?>" placeholder="Balance">
				</div>						
									
				<div class="form-group">
					<?php
					if($update == true):
					?>
						<button type="submit" class="btn btn-info" name="update"> Update</button>
					<?php else: ?>
						<button type="submit" name="save" class="btn btn-primary">Save</button>
					<?php endif; ?>
				</div>
			</form>
		</div>
	</div>
</body>
</html>