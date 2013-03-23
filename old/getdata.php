<?php
include("config.php");
if(isset($_POST['time'])){
	$time = intval($_POST['time']);
}
$stime = $time;
$etime = $stime + 60*60*12;
$type = array(0,0,0);
while($stime<$etime){
	
	foreach($data[$time] as $dt){
		if((intval($dt['created_time']/60)*60)==$stime){
			if(isset($dt['cat'])){
			$type = array(intval($dt['cat'])+1,$dt['actor_id'],$dt['permalink'],date("h:i",$dt['created_time']));
			}
		}
	}
	echo '<tr>';
	echo '<td '.($type[0]==1?('class="td1" uid='.$type[1].'><a target="_blank" href="'.$type[2].'" title="A comment posted at '.$type[3].'"></a>'):'class="td0">');
	echo '</td>';
	echo '<td '.($type[0]==2?('class="td2" uid='.$type[1].'><a target="_blank" href="'.$type[2].'" title="A checked in at '.$type[3].'"></a>'):'class="td0">');
	echo '</td>';
	echo '<td '.($type[0]==3?('class="td3" uid='.$type[1].'><a target="_blank" href="'.$type[2].'" title="A link posted at '.$type[3].'"></a>'):'class="td0">');
	echo '</td>';
	echo '<td '.($type[0]==4?('class="td4" uid='.$type[1].'><a target="_blank" href="'.$type[2].'" title="A status updated at '.$type[3].'"></a>'):'class="td0">');
	echo '</td>';
	echo '<td '.($type[0]==5?('class="td5" uid='.$type[1].'><a target="_blank" href="'.$type[2].'" title="A photo/video posted at '.$type[3].'"></a>'):'class="td0">');
	echo '</td>';
	echo '<td '.($type[0]==6?('class="td6" uid='.$type[1].'><a target="_blank" href="'.$type[2].'" title="Some other things posted at '.$type[3].'"></a>'):'class="td0">');
	echo '</td>';
	echo '</tr>';	
	$type = array(0,0,0);
	$stime+=60;
}
?>