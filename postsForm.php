<?php
	include 'globals.php';
?>

<?php
	$connect = mysqli_connect($host,$user,$pass,$db);
	
	// Check connection
	if (mysqli_connect_errno($connect))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
        
        
        $tempInt = mysqli_num_rows($connect);
        $tempInt = $tempInt + 1;
        

	$sql = "INSERT INTO messages (postCound, threadID, uID, content)
	VALUES
	('$tempInt', '$_COOKIE[threadID]', '$_COOKIE[uid]', '$_POST[pContent]');";





	$result = mysqli_query($connect, $sql);
	
	
	//if (!mysqli_query($connect,$sql))
	if (!$result)
	{
	    die('Error: ' . mysqli_error($connect));
	}
	echo "1 record added";

	
	
//end updates



	
	mysqli_close($connect);
	
	
	
	header('Location: https://cin.kc8khl.net/cardinalCodefest2014/postsFront.php');
	
	
?>
