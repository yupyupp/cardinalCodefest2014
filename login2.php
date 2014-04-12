//stuff lol comments
<?php
	//create connection and store the data for later use
	//host, username, password, dbname
	$host = '127.0.0.1'; 
	$user = 'root'; 
	$pass = 'password1'; 
	
	$db = 'test';
	
	$connect = mysqli_connect($host,$user,$pass, $db);
	
	// Check connection
	if (mysqli_connect_errno($connect))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	
	$query = "SELECT * FROM accounts";
	$result = mysqli_query($connect, $query);
	
	while ($row = mysqli_fetch_array($result))
	{
		if ($row['username'] == $_POST['username'])
		{
			if ($row['password'] == $_POST['password'])
			{
				setcookie("uid", $row['uid'], time()+3600);
				echo "Account successfully logged in";
			}
			else
				echo "Incorrect password";
		}
	}
	
	
	mysqli_close($connect);
?>

