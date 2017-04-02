<!-- CityConnect WebPage
  -- Facebook Login
  -- January 2017
 -->
 
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>Facbook Login</title>
		<link rel="stylesheet" type="test/css" href="stylesheet.css">
			
	</head>
	
	<body>
	
	<!-- FACEBOOK SDK ---------------------------------------------------------------------- -->
	
	<script>
  		window.fbAsyncInit = function() {
    	FB.init({
      	appId      : '485802488281713',
      	xfbml      : true,
      	version    : 'v2.8'
    	});
    	FB.AppEvents.logPageView();
  		};

  		(function(d, s, id){
     	var js, fjs = d.getElementsByTagName(s)[0];
     	if (d.getElementById(id)) {return;}
     	js = d.createElement(s); js.id = id;
     	js.src = "//connect.facebook.net/en_US/sdk.js";
     	fjs.parentNode.insertBefore(js, fjs);
   		}(document, 'script', 'facebook-jssdk'));
	</script>
	
	<div
  	class="fb-like"
  	data-share="true"
  	data-width="450"
  	data-show-faces="true">
	</div>
	
		<?php
	
		session_start();
		require_once __DIR__ . '/Facebook/autoload.php';
		
		$fb = new Facebook\Facebook([
			'app_id' => '485802488281713',
			'app_secret' => 'c80b2ec18f601a6334be5cf8cb526ddf',
			'default_graph_version' => 'v2.5',
 		 ]);

		$helper = $fb->getRedirectLoginHelper();

		$permissions = ['email']; // Optional permissions
		
		$loginUrl = $helper->getLoginUrl('http://localhost/cityconnect/WebContent/FacebookCallback.php', $permissions);

		echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
 
		?>
		
	</body>
</html>