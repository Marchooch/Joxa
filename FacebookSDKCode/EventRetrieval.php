<!-- CityConnect WebPage
  -- Facebook Login
  -- January 2017
 -->
 
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>City Connect</title>
		<link rel="stylesheet" type="test/css" href="stylesheet.css">
			
	</head>
	
	<body>
	
	<?php 
	
	session_start();
	require_once __DIR__ . '/Facebook/autoload.php';
	
	$fb = new Facebook\Facebook([
			'app_id' => '485802488281713',
			'app_secret' => 'c80b2ec18f601a6334be5cf8cb526ddf',
			'default_graph_version' => 'v2.5',
	]);
	
	$userAccessToken = $_SESSION['fb_access_token'];
	$appAccessToken = "485802488281713|TDv2tUhF4CRPi594wbGF4kiz5uw";
	$missingCategoryErr = $noEventErr = $category = "";
	
	?>
	
	<div id="eventSearch">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
				<input type="text" name="category" placeholder="category">
		  		<span class="error"> <?php echo $missingCategoryErr;?></span>
				<button class="button" name="buttonSubmit" value="search"><span>Search</span></button>
				<span class="error"> <?php echo $noEventErr;?></span>
			</form>
		</div>
		
	<?php
	
	if ($_SERVER["REQUEST_METHOD"] == "POST" && $_REQUEST["buttonSubmit"] == "search")
	{
		if (empty($_POST["category"]))
		{
			$missingCategoryErr = "* Category is required.";
		}
		if($_POST["category"])
		{
			$category = $_POST['category'];
				
			// Search FB Graph API
			// -----------------------------------------------------------------------------------
			try{// Returns a `Facebook\FacebookResponse` object
				$response = $fb->get("/search?q=calgary,{$category}&type=event&fields=id,name,description,place,start_time&access_token={$userAccessToken}");
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
				echo 'Graph returned an error: ' . $e->getMessage();
				exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
				echo 'Facebook SDK returned an error: ' . $e->getMessage();
				exit;
			}
	
			$graphEdge = $response->getGraphEdge();
			
			$totalCount = $graphEdge->getTotalCount();
			
			echo "{$totalCount}";
			
			foreach ($graphEdge as $graphNode)
			{
				$eventID = $graphNode->getField('id');
				$eventName = $graphNode->getField('name');
				$eventDescription = $graphNode->getField('description');
				$eventPlace = $graphNode->getField('place');
				$eventStartTime = $graphNode->getField('start_time');
				echo "{$eventID}<br/> <h2>{$eventName}</h2><br/> {$eventDescription}<br/> {$eventPlace}<br/> {$eventStartTime->format('Y-m-d')}\n\n";
				echo "<br/> <br/> <br/>";
			}
			//print_r($response);
	
	/**
			$graphArray = $graph->asArray();
			$events = $graphArray['name'];
			foreach ($events as $event) {
				$name = $event['name'];
			}
			*/
			// -----------------------------------------------------------------------------------
		}
	}
	
	?>
		
					
	</body>
</html>
	
