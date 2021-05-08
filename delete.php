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

	$first = "delete from automobile where model = ?";
	
	$state = $conn->prepare($first);	

	$state->bind_param("s", $model);

	if($state->execute() === TRUE)
		echo("deleted from database");
	else
		echo("failed: please try again");
?>
</body>
</html>
