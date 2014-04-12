<?php
	//create connection and store the data for later use
	//host, username, password, dbname
	$host = 'localhost'; 
	$user = 'cardinalCodeFest'; 
	$pass = 'test'; 
	
	$db = 'cardinalCodeFest';
	
	$connect = mysqli_connect($host,$user,$pass, $db);
	
	// Check connection
	if (mysqli_connect_errno($connect))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	
	$query = "SELECT * FROM loginData";
	$result = mysqli_query($connect, $query);
	
	while ($row = mysqli_fetch_array($result))
	{
		if ($row['username'] == $_POST['username'])
		{
			if ($row['password'] == $_POST['password'])
			{
				setcookie("uid", $row['uID'], time()+3600);
				
				include 'requestPage.html';
			}
			else
			{
				echo "Incorrect password\n\n";
				
				include 'login.html';
				
				//or make an unsuccessfulLogin.html page to be included instead
			}
		}
	}
	
	
	mysqli_close($connect);
?>

