<?php
$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "blogger";
	// Create connection
	$connection = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($connection->connect_error) {
		die("Connection failed: " . $connection->connect_error);
	} 
if(isset($_POST['likec']) ){

    $query = "UPDATE blog
              SET likes   ='". $_POST['likec'] . "'
             WHERE
                 blogid = '". $_POST['blogid'] . "'";
				 echo $query;

    $result = $connection->query($query) or die($connection->error);
    exit(json_encode($_POST)); 
    }



	?>