<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title>Facebook Feed Map</title>
	<link rel="stylesheet" href="css/main.css" type="text/css">
	<script src="js/jquery-1.9.0.js"></script>
	<script src="js/jquery.slabtext.min.js"></script>
	<script type="text/javascript" src="js/spryMap-2.js"></script>

	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	</head>
<body>
<div id="left">
	<div id="system">
		<div id="rel">
			<table style="font-size:11px;width:60px;border-right:1px solid #ddd;text-align:right;color:#999">
				<?php $i=0;while($i<720){?>
				<tr>
					<td>
					<?php if($i%30==0){?>
					<?php echo	intval($i/60)==0?'12':intval($i/60)?>:
					<?php }?>
					<?php if($i%60==0){?>
					<?php echo	'00';?>
					<?php }elseif($i%30==0){?>
					<?php echo	'30';?>
					<?php }?>
					</td>
				</tr>
				<?php $i++;}?>
			</table>
			<table style="float:left;" class="maintable" id="datatable">
				
			</table>
		</div>
	</div>
	<div class="cate">
		 <span style="color:#999;width:58px;margin:0 1px 0 0">Time</span>
		 <span style="background:mediumslateblue">Comment</span>
		 <span style="background:chocolate">Check in</span>
		 <span style="background:crimson">Link</span>
		 <span style="background:lightskyblue">Status update</span>
		 <span style="background:yellowgreen">Multimedia</span>
		 <span style="background:gold">Other</span>
		 <span>&nbsp;</span>
	</div>
	<div id="timeBar">
		 Pick a date here 
		 <select id="datepicker">
			<?php foreach($date as $d){?>
			<option value="<?php echo $d; ?>"><?php echo date("M jS, Y A",$d); ?></option>
			<?php }?>
		 </select>
	</div>
</div>
<div id="right">
	<div class="logo">
	<span id="sel">Select All</span>
	<span class="bl">|</span>
	<span id="usel">Remove All</span>
	</div>
	<div class="invisible-clear"></div>
	<div class="list2 list">
		<ul>
			<?php foreach($contact as $c){?>
			<li class="check" id="<?php echo $c->id;?>" sel="false">
				<div class="face" style="background-image:url(<?php echo 'http://graph.facebook.com/'.$c->id.'/picture?type=square'?>);"></div>
				<div class="cname"><?php echo $c->name;?></div>
			</li>
			<?php }?>
		</ul>
	</div>
</div>

<script type="text/javascript" charset="utf-8">
//Sizing the frame
function sizing(){
$("#right").height($(window).height());
$(".list2").height($("#right").height()-53);
$("#left").width($(window).width()-$("#right").width()-1).height($(window).height());
$("#system").width($("#left").width()).height($(window).height()-78);

$(".logo").width($("#right").width());
$("#breakline").width($("#timeBar").width());
//$("#pVis").width($("#system").width());
}
var map = new SpryMap({id : "rel",
                             height: ($(window).height()-78),
                             width: ($(window).width()-500),
                             startX: 0,
                             startY: 0,
                             cssClass: "mappy"});
$(window).resize(function(){
	sizing();
});
$(document).ready(function(){
	sizing();
	$(".list li").click();
	$.ajax({
		url: 'getdata.php',
		type: 'POST',
		data:{ time: $("#datepicker").find("option:selected").val()},
		dataType: 'html',
		timeout: 4500,
		error: function(){
		},
		success: function(data){
			$("#datatable").html(data);
		}
	});
});


//List and checkbox
$(".list li").click(function(){
	if($(this).attr('sel')=='true'){
		$(this).removeClass('checked').addClass('check');
		$(this).attr('sel','false');
		$("[uid='"+$(this).attr('id')+"']").css('background','#fff');
	}
	else{
		$(this).removeClass('check').addClass('checked');
		$(this).attr('sel','true');
		$("[uid='"+$(this).attr('id')+"']").css('background','');
	}
});
$("#sel").click(function(){
	$(".list li.check").click();
});
$("#usel").click(function(){
	$(".list li.checked").click();
});


$("#datepicker").change(function(){
	$.ajax({
		url: 'getdata.php',
		type: 'POST',
		data:{ time: $("#datepicker").find("option:selected").val()},
		dataType: 'html',
		timeout: 4500,
		error: function(){
		},
		success: function(data){
			$("#datatable").html(data);
		}
	});
});
</script>
</body>
</html>
