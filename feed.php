<?php

$sApplicationId = '549567871741754';
$sApplicationSecret = 'c15a20dec1d41b78e9ef267814ac4c0f';
//echo $_POST['feedJSON'];
if(isset($_GET['startTime']))
	$startTime = $_GET['startTime'];
else
	$startTime = mktime(0, 0, 0, date("m"), date("d")-3,   date("Y"));	// Last 15 days
	
	
if(isset($_GET['endTime']))
	$endTime = $_GET['endTime'];// Now
else
	$endTime = mktime(0, 0, 0, date("m"), date("d")-1,   date("Y"));;
	
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
<center>
<img src="img/loading.gif"></img>
</center>
<div id="results"></div>

  <script>
	typeSets = { 
		'11' : '5',  //Group created
		'12' : '5',  //Event created
		'46' : '3',	 //Status update
		'56' : '5',	 //Post on wall from another user
		'66' : '5',	 //Note created
		'80' : '2',  //Link posted
		'128' : '4',  //Video posted
		'247' : '4',  //Photos posted
		'237' : '5',  //App story
		'257' : '0',  //Comment created
		'272' : '5',  //App story
		'285' : '1',  //Checkin to a place
		'308' : '5',  //Post in Group
		};
	feedJSON = "";
	friendsJSON = "";
	step = 12 * 60 * 60; // 1 hour
	feedArray = new Array();
	resultArray = {};
	start_time = <?=$startTime?>;
	end_time = <?=$endTime?>;

	
window.fbAsyncInit = function() {
		
	FB.init({ appId: '<?= $sApplicationId ?>', 
		status: true, 
		cookie: true,
		xfbml: true,
		oauth: true
	});
	
					
	function getResults(start, end){
			 FB.api({ // call fql.query
                            method : 'fql.query',
                           // query : "SELECT post_id, actor_id, type, description, permalink, message FROM stream WHERE filter_key in (SELECT filter_key FROM stream_filter WHERE uid = me() AND type = 'newsfeed') LIMIT 200" //AND type != '347'"
							query : "SELECT actor_id, created_time, type, permalink FROM stream WHERE filter_key in (SELECT filter_key FROM stream_filter WHERE uid = me() AND type = 'newsfeed') AND " + start + " < created_time AND created_time < " + end + " LIMIT 200" //AND type != '347'"

                        }, function(response) {
							var thisDayArray = {};
							
							for (var i = 0; i < response.length; i++){
								var t = response[i].type;
								var set = typeSets[t];
								response[i].cat = set ; 
							}
							resultArray[start] = response; 
							//r = JSON.stringify(response);
							//feedJSON = feedJSON.concat(r);
							feedArray = feedArray.concat(response);
		
							if (end < end_time)
								getResults(end, end + step);
							else{
								//alert (feedArray.length);
								resultJSON = JSON.stringify(resultArray);
								feedJSON = JSON.stringify(feedArray);
								//$('#results').html(resultJSON);
								FB.api('/me/friends' , function(response) {
									// Picture: '<img src="https://graph.facebook.com/' + response.id + '/picture">'
									friendsJSON = JSON.stringify(response.data);
									arr = new Array();
									arr['friends'] = friendsJSON;
									arr['feeds'] = resultJSON;
									postData('index.php',arr);
								});
								//$.post('index2.php',{'resultJSON':resultJSON});
								//$('#results').html(friendsJSON);
							}
							
                        });
		}
	
		function postData(url, data)
			{
			  var form = $('<form></form>');
			  $(form).hide().attr('method','post').attr('action',url);
			  for (i in data)
			  {
				var input = $('<input type="hidden" />').attr('name',i).val(data[i]);
				$(form).append(input);
			  }
			  $(form).appendTo('body').submit();
			}

        function update(response) {
			if (response.authResponse) {		
				FB.api('/me', function(response) {		
					feedJSON = {"name":"John Johnson"};	
					feedArray = new Array();
					getResults(start_time, start_time + step);
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