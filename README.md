FeedVis
======
This visualization which is named "FeedVis" has been done for CS467 class at University of Illinois at Urbana-Champaign by Motahareh EslamiMehdiabadi, Haoran Yu and Drayden Lin.

“FeedVis” visualizes Facebook feeds of a person during a day by categorizing feeds to these six classes in a whole view.
These are the mentioned categories:
1- Post a comment
2- Check in a place
3- Post a link
4- Status update
5- Post a photo/ video
6- Others (App story, Write on other wall,...) 

The first 5 categories are the most popular categories which can be retrieved from Facebook. The others category includes other not very common categories such as playing a game.

How to Use
======
To see the visualization, you should have a PhP server. We suggest Xampp as an option. After installing Xampp, you should put the FeedVis Package on the ‘htdocs’ folder of the Xampp server.

Visualization
======
You can run the visualization by opening the ‘login.php’ page from the FeedVis directory of localhost. In this page, you can login with your Facebook account.   Since downloading and processing your Feed Facebook data takes time, we put the default time period the last two days to make it faster. However, you can change it in feed.php page by changing the 'startTime' and 'endTime' variables as you wish.

In the appeared visualization, all of your Facebook friends have been shown on the right sidebar. In the center, you can see each feed (story) of your Facebook friends during a day or night by picking a date(by AM or PM). Different categories are shown by different colors. Here, you can hover on each story to see its exact time and also clicking on it to see the complete version of the story.
'FeedVis' will show your friends activities in Facebook during a day in a compact view. You can also choose some desired friends to see just their activities and compare with others.