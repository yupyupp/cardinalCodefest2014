<?php
  include 'globals.php';
?>


<?php
  //create connection and store the data for later use
  //host, username, password, dbname
  echo "DO SHIT.";
  
  
  $connect = mysqli_connect($host,$user,$pass, $db);

  // Check connection
  if (mysqli_connect_errno($connect))
  {
	 echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $uID = $_COOKIE['uid'];
  $condition = array();
  
  //a single dimensional array that contains uID and username from the array_push
  $sharingUsers = array();
  
  
  //@Debugging
  echo "cookie: " . $_COOKIE['uid'] . "\n";
  echo "stephen's uID var: " . $_COOKIE['uid'] . "\n";
  

  // Get uID and username of non-anon patients
  $query = "SELECT * FROM loginData";
  $result = mysqli_query($connect, $query);

  while ($row = mysqli_fetch_array($result))
  {
	 if ($row['anon'] == 0)
	 {
		//pushes on 2 elements: uID and username (heterogeneous array???)
		array_push($sharingUsers, $row['uID'], $row['username']);
		//how about just user name OR uID and determine the other value from what you kept later?
		
		//@Debugging
		echo "anon user: " . $row['username'] . "\n";
	 }
  }

  // Get this user's contitions and adds them to the conditions array
  $query = "SELECT * FROM medicalHistory";
  $result = mysqli_query($connect, $query);
  while ($row = mysqli_fetch_array($result))
  {
	 if ($row['uID'] == $_COOKIE['uid'])
	 {
		//why also push an empty string?
		//shouldn't it be: array_push($condition, $row['name']);
		array_push($condition, $row['name'], "");
		
		//@Debugging
		echo "condition: " . $row['name'] . "\n";
	 }
  }

  // Find other users with any of the same conditions
  $partnerID;

  $query = "SELECT * FROM medicalHistory";
  $result = mysqli_query($connect, $query);
  while ($row = mysqli_fetch_array($result))
  {
	 //@Debugging
	 echo "Checking: " . $row['uID'] . " " . $row['name'];
	 
	 if (array_key_exists($row['uID'], $sharingUsers)
	 {
		//@Debugging
		echo "Check 1 passed";
		
		if (array_key_exists($row['name'], $condition)
		{
		  $partnerID = $row['uID'];
		  
		  //@Debugging
		  echo "Check 2 passed";
		}
	 }
  }

  // Check if already in conversation thread with $partnerID
  // Give them a cookie for existing thread or issue cookie
  // for new thread
  $threadCount=0;
  $threadID=0;
  $query = "SELECT * FROM threads";
  $result = mysqli_query($connect, $query);
  while ($row = mysqli_fetch_array($result))
  {
	 //@Debugging
	 echo "2 Checking: " . $row['uID'] . " " . $row['partnerID'];
	 
	 if ($row['uID'] == $_COOKIE['uid'])
	 {
		//@Debugging
		echo "Check 1 passed";
		
		if ($row['partnerID'] == $partnerID)
		{
		  //@Debugging
		  echo "Check 2 passed";
		  
		  $partnerID = $row['uID'];
		}
	 }
	 $threadCount = $threadCount + 1;
  }
  
  //YOU WERE JUST INCREMENTING THREADID, WHY WOULD IT BE ZERO? no, that was thread count
  //IF THIS IS RUN MULTIPLE TIME, IS IT RESET TO ZERO AT START OF PROGRAM?
  //why even check if threadID is zero? Why not just set it?
  //possibly, in case it is already set X it is reset to 0 anyway right before the while loop
  //if ($threadID == 0)
  //{
	 $threadID = $threadCount;
  //}

  setcookie("threadID", $threadID, time()+3600);
  
  
  //@Debugging
  //header('Location: https://cin.kc8khl.net/cardinalCodefest2014/postsFront.html');
  
  
  mysqli_close($connect);
?>
