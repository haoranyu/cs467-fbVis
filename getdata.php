<?php
session_start();
$data = $_SESSION['data'];
if(isset($_POST['time'])){
	$time = intval($_POST['time']);
}
$stime = $time;
$etime = $stime + 60*60*12;
//$count = array(0,0,0,0);
$tooltip = array(' ','A comment posted','A checked in','A link posted','A status updated','A photo/video posted','Some other things posted');
while($stime<$etime){
	$count = array(0,0,0,0,0,0,0);
	$type = array();
	foreach($data[$time] as $dt){
		if((intval($dt['created_time']/600)*600)==$stime){
			if(isset($dt['cat'])){
				$type[intval($dt['cat'])+1][$count[intval($dt['cat'])+1]] = array($dt['actor_id'],$dt['permalink'],date("h:i",$dt['created_time']));
				$count[intval($dt['cat'])+1]++;
			}
		}
	}
	echo '<tr>';
	for($i=1;$i<=6;$i++){
	if ($count[$i] > 0 ){
		if ($count[$i] > 5)
			$count[$i] = 5;
		$images = '<ul class="fblist">';
		for($j = 0 ;$j < $count[$i] ; $j++){
		
			$images = $images . '<div uid='.$type[$i][$j][0].' class="face2" style="background-image:url(http://graph.facebook.com/'. $type[$i][$j][0].'/picture?type=square);"><a target="_blank" href="'.$type[$i][$j][1].'" title="'.$tooltip[$i].' at '.$type[$i][$j][2].'"></a></div>';
		}
		$images = $images . '</ul>';
		echo '<td class="td'.$i.'">'.$images.'</td>';
	//	echo '<td '.($count[$i]>0?('class="td'.$i.'" uid='.$type[$i][0].'><a target="_blank" href="'.$type[$i][1].'" title="'.$tooltip[$i].' at '.$type[$i][2].'"></a></td>";
	} else {
		echo '<td class="td0"></td>'; 
	}
	}
	echo '</tr>';
	$stime+=600;
}
?>