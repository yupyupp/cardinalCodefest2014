<!DOCTYPE html>
<html>
	<head>
		<title> Unexpected Packet Grabber </title>
		<link rel="stylesheet" type="text/css" href="requestPage.css">
		<script>
			function getCookie(cname)
					{
					var name = cname + "=";
					var ca = document.cookie.split(';');
					for(var i=0; i<ca.length; i++)
					  {
					  var c = ca[i].trim();
					  if (c.indexOf(name)==0) return c.substring(name.length,c.length);
					  }
					return "";
					}

			function makePage()
					{
						newWindow = window.open();
						newDocument = newWindow.document;
						newDocument.write("<html><head><title>Patient Summary<title></head><body><table?"+getCookie(all)+"</table></body></html>");
					}
		</script>
	</head>
	<body>
	
	
	
	    <?php
	        include 'login2.php';
	    ?>
	
	

		<div class="getInfo">
			<form action="welcome_get.php" method="get">
				Category: 
					<select name="category">
						  <option value="default" selected="selected"> Choose a category</option>
						  <option value="BrokenBones">BrokenBones</option>
						  <option value="Allergies">Allergies</option>
						  <option value="MentalIllness">MentalIllness</option>
						  <option value="ChronicConditions">ChronicConditions</option>
					</select><br>
				<input type="submit" value="Get info">
			</form>
		</div>
		<div class="chosen">
			<h2>Chosen Conditions</h2>
			<script>
				var categories = getCookie(categories);
				document.write(categories);
			</script>
			<button class="new" type="button" onclick="makePage()">Make List</button>

		</div>
		<div class="console"> <textarea class="console"></textarea></div>

	</body>
</html>
