<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Results</title>
    <link rel="stylesheet" href="csl-alt.css">
  </head>

<body>
<H1> Thank you! </H1>
<p> Please use the back button to navigate back to the main site </p>
<?php include("connection.php"); ?>


<?php 
	$model = $_POST['model'];
	$price = (int)$_POST['price'];
	$horsepower = (int)$_POST['horsepower'];
	$transmission = $_POST['transmission'];
	$torque = (int)$_POST['torque'];
	$weight = (int)$_POST['weight'];
	$engine = $_POST['engine'];
	$drive_type = $_POST['drive_type'];
	$subsidiary = $_POST['subsidiary'];
	$mpg = (int)$_POST['mpg'];

	$first = "INSERT INTO automobile (model, price, horsepower, transmission, torque, weight, engine, drive_type, subsidiary, mpg) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
	
	$state = $conn->prepare($first);	

	$state->bind_param("ssssssssss", $model, $price, $horsepower, $transmission, $torque, 
$weight, $engine, $drive_type, $subsidiary, $mpg);

	if($state->execute() === TRUE)
		echo("added to database");
	else
		echo("failed: please try again");
?>


</body>
</html>
