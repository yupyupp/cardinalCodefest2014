
<?php
  include 'globals.php';
?>


<?php
  //create connection and store the data for later use
  //host, username, password, dbname
  $connect = mysqli_connect($host,$user,$pass, $db);

  // Check connection
  if (mysqli_connect_errno($connect))
  {
	 echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $uID = $_COOKIE['uid'];
  $patientUserName = $_GET['patient'];
  $category = $_GET['category'];
  $pID;


  // Get uID of specified patient
  $query = "SELECT * FROM loginData";

  $result = mysqli_query($connect, $query);

  while ($row = mysqli_fetch_array($result))
  {
	 if ($row['username'] == $patientUserName)
	 {
		$pID = $row['uID'];
	 }
	 else
	 {
		echo 'Invalid Patient';
		include 'requestPage.html';
	 }
  }

  // Get permissions of professional with pID
  $query = "SELECT * FROM permissions";

  $result = mysqli_query($connect, $query);

  $allowedToAccess = false;
  while ($row = mysqli_fetch_array($result))
  {
  if ($row['uID'] == $uID)
  {
	 if ($row['uID'] == $uID)
	 {
		if ($pID == $row['pID'])
		{
		  if ( $category == $row['category'])
		  {
			 $allowedToAccess = true;
			 echo $allowedToAccess;
		  }
		}
	 }
  }
  }

  // Get patient data if $allowedToAccess
  $htmlReturn = "ERROR: You do not have permission to view this data!";
  if($allowedToAccess)
  {
	 $query = "SELECT * FROM permissions";

	 $result = mysqli_query($connect, $query);

	 $htmlReturn = "<table>";
	 while ($row = mysqli_fetch_array($result))
	 {
	 if ($row['uID'] == $uID)
	 {
		$pID = $row['uID'];
		if ($row['uID'] == $uID)
		{
		  if ($pID == $row['uID'])
		  {
			 if ( $category == $row['category'])
			 {
				$htmlReturn .= "<tr><td>".$row['date']."</td><td>".$row['name']."</td><td>".$row['description']."</td></tr>";
				echo $htmlReturn;
			 }
		  }
		}
	 }
	 }
	 $htmlReturn .= "</table>";
  }
  setcookie("table", $htmlReturn, time()+3600);
  mysqli_close($connect);
?>