

<?php
    include 'globals.php';
?>


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
				
				header('Location: https://cin.kc8khl.net/cardinalCodefest2014/requestPage.html');
				
				//echo "Account successfully logged in";
			}
			else
			{
				echo "Incorrect password";
				
				include 'login.html';
			}
		}
	}
	
	
	mysqli_close($connect);
?>

