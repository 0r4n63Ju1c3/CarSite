 <?php 
	$servername = "localhost";
	$username = "student";
	$password = "CompSci364";
	$db = "cars";
	
	$conn = new mysqli($servername, $username, $password, "cars");
	if(!$conn){
		die("cannot connect");
		echo("no connection");
	}
 ?>
