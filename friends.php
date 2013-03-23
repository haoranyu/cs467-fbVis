<?php

$sApplicationId = '549567871741754';
$sApplicationSecret = 'c15a20dec1d41b78e9ef267814ac4c0f';
?>

<html lang="en" xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
    <meta charset="utf-8" />
    <title>Facebook API - Get friends activity</title>
    <link href="css/main.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script>
        google.load("jquery", "1.7.1");
    </script>
</head>

<body>
<div id="fb-root"></div>
<div id="results"></div>

  <script>
	
window.fbAsyncInit = function() {
		
	FB.init({ appId: '<?= $sApplicationId ?>', 
		status: true, 
		cookie: true,
		xfbml: true,
		oauth: true
	});
	
	
	function getFriends(){
		FB.api('/me/friends' , function(response) {
			// Picture: '<img src="https://graph.facebook.com/' + response.id + '/picture">'
			friendsJSON = JSON.stringify(response.data);
			$('#results').html(friendsJSON);
		});
	}
			
        function update(response) {
			if (response.authResponse) {		
				FB.api('/me', function(response) {		
					getFriends();
					});	
				}
				else {
					alert('login first!');
				}
		}

        // run once with current status and whenever the status changes
		FB.getLoginStatus(update);
       // FB.Event.subscribe('auth.statusChange', update);    
        
		};
    (function() {
        var e = document.createElement('script'); e.async = true;
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
    }());
    </script>
</body>
</html>