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

	$result = mysqli_query($connect,"SELECT * FROM messages");

	
	
	echo "<table border='1'>";
	echo "<tr>";
	echo "<th>Post Number</th>";
	echo "<th>Post User</th>";
	echo "<th>Post Content</th>";
	echo "</tr>";
	
	while($row = mysqli_fetch_array($result))
	{
	    echo "<tr>";
	    echo "<td>" . $row['postNumber'] . "</td>";
	    echo "<td>" . $row['postUser'] . "</td>";
	    echo "<td>" . $row['postContent'] . "</td>";
	    echo "</tr>";
	}
	echo "</table>";
	
	

	mysqli_close($connect);
?>

