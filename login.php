<?php

$sApplicationId = '549567871741754';
$sApplicationSecret = 'c15a20dec1d41b78e9ef267814ac4c0f';
?>

<!DOCTYPE html>
<html lang="en" xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
    <meta charset="utf-8" />
    <title>FeedVis: Facebook Feed Visualization</title>
    <link href="css/main.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script>
        google.load("jquery", "1.7.1");
    </script>
 </head>

<body>
       
    <div id="fb-root"></div>
    <center>
        <h2>Login with your facebook account</h2>
        <div id="user-info"></div>
        <button id="fb-auth"> Please login here</button>
		<br>
		<br>
		<form id="fb_form" action="feed.php" method="post">
		
			<input type="submit" name="SubmitButton" id="feedB" value="Get Started">
		</form>
    </center>

    <div id="results"></div>
	<div id="results2"></div>
	
    <script>
	
    window.fbAsyncInit = function() {
        FB.init({ appId: '<?= $sApplicationId ?>', 
            status: true, 
            cookie: true,
            xfbml: true,
            oauth: true
        });
		
        function updateButton(response) {
            var button = document.getElementById('fb-auth');

            if (response.authResponse) { // in case if we are logged in
                var userInfo = document.getElementById('user-info');
                var iPid = 0;
                FB.api('/me', function(response) {
                    userInfo.innerHTML = '<img src="https://graph.facebook.com/' + response.id + '/picture">' + response.name;
                    button.innerHTML = 'Logout';

                    // get friends activity feed
                    iPid = response.id;
                });

                button.onclick = function() {
                    FB.logout(function(response) {
                        window.location.reload();
                    });
                };
            } else { // otherwise - dispay login button
                button.onclick = function() {
                    FB.login(function(response) {
                        if (response.authResponse) {
                            window.location.reload();
                        }
                    }, {scope:'read_stream'});
                }
            }
        }

        // run once with current status and whenever the status changes
        FB.getLoginStatus(updateButton);
       // FB.Event.subscribe('auth.statusChange', updateButton);    
    };
        
    (function() {
        var e = document.createElement('script'); e.async = true;
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
    }());
    </script>
</body>
</html>