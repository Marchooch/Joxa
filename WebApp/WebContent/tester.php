<!-- Written By LaVerne Woroschuk
  -- trial page
  -- January 2017
 -->
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>Events Tester</title>
		<link rel="stylesheet" type="test/css" href="tester.css">
		
	</head>
	
	<body>


<!-- Search for an Evemt ---------------------------------------------------------------------- -->

		<?php
			$missingDateErr = $noEventErr = "";
		?>
		
		<div id="eventSearch">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
				<input type="date" name="date" placeholder="date">
  				<span class="error"> <?php echo $missingDateErr;?></span>
  				<button class="button" name="buttonSubmit" value="search"><span>Search</span></button>
  				<span class="error"> <?php echo $noEventErr;?></span>
			</form>
		</div>

	</body>
</html>