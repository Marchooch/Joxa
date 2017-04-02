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
	
	<!-- FACEBOOK SDK ---------------------------------------------------------------------- -->
	
		<?php
		
		session_start();
		require_once __DIR__ . '/Facebook/autoload.php';
	
		$fb = new Facebook\Facebook([
			'app_id' => '485802488281713',
			'app_secret' => 'c80b2ec18f601a6334be5cf8cb526ddf',
			'default_graph_version' => 'v2.5',
		]);

		$helper = $fb->getRedirectLoginHelper();
		
		try {
 		$accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
 		 // When Graph returns an error
  		echo 'Graph returned an error: ' . $e->getMessage();
  		exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
  		// When validation fails or other local issues
  		echo 'Facebook SDK returned an error: ' . $e->getMessage();
  		exit;
		}
		
		if (! isset($accessToken))
		{
 			if ($helper->getError())
 			{
    			header('HTTP/1.0 401 Unauthorized');
    			echo "Error: " . $helper->getError() . "\n";
    			echo "Error Code: " . $helper->getErrorCode() . "\n";
    			echo "Error Reason: " . $helper->getErrorReason() . "\n";
    			echo "Error Description: " . $helper->getErrorDescription() . "\n";
  			}
  			else
  			{
    			header('HTTP/1.0 400 Bad Request');
    			echo 'Bad request';
  			}
  		exit;
		}
		
		// Logged in
		
		// The OAuth 2.0 client handler helps us manage access tokens
		$oAuth2Client = $fb->getOAuth2Client();

		// Get the access token metadata from /debug_token
		$tokenMetadata = $oAuth2Client->debugToken($accessToken);

		// Validation (these will throw FacebookSDKException's when they fail)
		$tokenMetadata->validateAppId('485802488281713'); // Replace {app-id} with your app id

		$tokenMetadata->validateExpiration();
		
		if (! $accessToken->isLongLived()) {
  			// Exchanges a short-lived access token for a long-lived one
  			try {
    		$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  			} catch (Facebook\Exceptions\FacebookSDKException $e) {
    		echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
    		exit;
  			}

		}
		
		$_SESSION['fb_access_token'] = (string) $accessToken;
		
		header('Location: EventRetrieval.php');
		
		?>
						
	</body>
</html>
	
