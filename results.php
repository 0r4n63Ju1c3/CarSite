<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Results</title>
    <link rel="stylesheet" href="csl-alt.css">
  </head>

<?php include("connection.php"); ?>
<body>
<H1> Results of non-body search </H1>
<p> Please use the back button to navigate back to the main site </p>
<p> Scroll down to see body-type search </p>
<TABLE BORDER="7"    WIDTH="100%"   CELLPADDING="5" CELLSPACING="3">

<?php 
	$brand = $_POST['brand'];
	$body = $_POST['body'];
	$drivetrain = $_POST['drivetrain'];
	$horsepower = $_POST['horsepower'];
	$torque = $_POST['torque'];
	$price = $_POST['price'];
	$mpg = $_POST['mpg'];
	
	
	if ($horsepower == NULL){
		$horsepower = 5000;
	}
	if ($torque == NULL){
		$torque = 5000;
	}
	if ($price == NULL){
		$price = 100000000;
	}
	if ($mpg == NULL){
		$mpg = 100000000;
	}

	if($brand == NULL && $drivetrain == NULL){
		$first = $conn->prepare("select * from automobile WHERE horsepower <= ? AND price <= ? AND torque <= ? AND mpg <= ?");
		$first->bind_param("iiii", $horsepower, $price, $torque, $mpg);
	}

	if($brand == !NULL && $drivetrain == !NULL){
		$first = $conn->prepare("select * from automobile WHERE horsepower <= ? AND price <= ? AND torque <= ? 	AND mpg <= ? AND lower(subsidiary) like ? AND lower(drive_type) = ?");
		$first->bind_param("iiiiss", $horsepower, $price, $torque, $mpg, $brand, $drivetrain);
	}
	
	if($brand == !NULL && $drivetrain == NULL){
		$first = $conn->prepare("select * from automobile WHERE horsepower <= ? AND price <= ? AND torque <= ? 			AND mpg <= ? AND lower(subsidiary) like ?");
		$first->bind_param("iiiis", $horsepower, $price, $torque, $mpg, $brand);
	}

	if($brand == NULL && $drivetrain == !NULL){
		$first = $conn->prepare("select * from automobile WHERE horsepower <= ? AND price <= ? AND torque <= ? 			AND mpg <= ? AND lower(drive_type) = ?");
		$first->bind_param("iiiis", $horsepower, $price, $torque, $mpg, $drivetrain);
	}
	
	if($body != NULL){
		$second = $conn->prepare("select * from wagon");
		if($body == 'compact')
			$second = $conn->prepare("select * from compact");
		if($body == 'sedan')
			$second = $conn->prepare("select * from sedan");
		if($body == 'suv')
			$second = $conn->prepare("select * from suv");
		if($body == 'wagon')
			$second = $conn->prepare("select * from wagon");
		$second->execute();
		$resultT = $second->get_result();
	}
	
	$first->execute();
	$result = $first->get_result();

?>

<?php while($row = $result->fetch_assoc()) {?>
	<TR ALIGN = "CENTER"> 
		<td> <?php echo htmlspecialchars($row['subsidiary']); ?> </td>
		<td> <?php echo $row['model']; ?> </td>
		<td> <?php echo $row['horsepower']; ?> horses </td>
		<td> $ <?php echo $row['price']; ?> </td>
		<td> <?php echo $row['torque']; ?> ft - lbs </td>  
		<td> <?php echo $row['transmission']; ?> </td> 
		<td> <?php echo $row['weight']; ?> lbs </td> 
		<td> <?php echo $row['engine']; ?> </td>
		<td> <?php echo $row['drive_type']; ?> wheel-drive</td>
		<td> <?php echo $row['mpg']; ?> mpg </td>      
	</TR>
<?php } ?>
   
</TABLE>

<H1> Results of your body search </H1>
<TABLE BORDER="7" WIDTH="100%" CELLPADDING="5" CELLSPACING="3">
	<?php if($body == 'compact'){   ?>
		<?php while($row = $resultT->fetch_assoc()) {?>
	<TR ALIGN = "CENTER"> 
		<td> <?php echo $row['model']; ?> </td>
		<td> occupancy: <?php echo $row['occupancy']; ?> </td>
		<td> type: <?php echo $row['type']; ?> </td>    
	</TR>
		<?php } ?>
	<?php } ?>

	<?php if($body == 'sedan'){   ?>
		<?php while($row = $resultT->fetch_assoc()) {?>
	<TR ALIGN = "CENTER"> 
		<td> <?php echo $row['model']; ?> </td>
		<td> occupancy: <?php echo $row['occupancy']; ?> </td>
		<td> doors: <?php echo $row['numberDoors']; ?> </td>
		<td> trunk size: <?php echo $row['trunkSize']; ?> </td>        
	</TR>
		<?php } ?>

	<?php } ?>

	<?php if($body == 'wagon'){   ?>

		<?php while($row = $resultT->fetch_assoc()) {?>
	<TR ALIGN = "CENTER"> 
		<td> <?php echo $row['model']; ?> </td>
		<td> occupancy: <?php echo $row['occupancy']; ?> </td>
		<td> doors: <?php echo $row['InteriorSpace']; ?>  </td>

	</TR>
		<?php } ?>

	<?php } ?>

	<?php if($body == 'suv'){   ?>
	
	<?php while($row = $resultT->fetch_assoc()) {?>
	<TR ALIGN = "CENTER"> 
		<td> <?php echo $row['model']; ?> </td>
		<td> height: <?php echo $row['rideHeight']; ?> </td>
		<td> tow - lbs: <?php echo $row['TowCapacity']; ?>  </td>

	</TR>
		<?php } ?>
	
	<?php } ?>


</TABLE>

</body>
</html>
