<?php
include_once '../templates/templating.php';


get_sentry();
include_once './initialData.php';
include_once './monthexpences.php';
include_once './monthincome.php';

get_heather(true);
?>

<form action="welcome.php" name='changemonth' method="post"  onSubmit="return TestSubmitPermision()">
	<div id='selMonth'>
		<button id='mback'><span class="ui-icon ui-icon-arrowthick-1-w"></span></button>
		<span id='m' class='date'><?php echo $date['month'];?></span>
		<button id='mford'><span class="ui-icon ui-icon-arrowthick-1-e"></span></button>
		<br>
		<button id='yback'><span class="ui-icon ui-icon-arrowthick-1-w"></span></button>
		<span id='y'><?php echo $date['year'];?></span>
		<button id='yford'><span class="ui-icon ui-icon-arrowthick-1-e"></span></button>
	</div>
	<input type='hidden' id='submitperm' value='0'>
	<input type="hidden" id='month' name='month' value='<?php echo $date['month'];?>'>
	<input type="hidden" id='year' name='year' value='<?php echo $date['year'];?>'>
	<input type='button' onclick='CheckAndSubmit()' value='GO'><br> 
</form>


</div>
<?php $arr = array( array("total"=>$tOutcome,"divname"=>"ocdiv","tablename"=>"octable","tabledata"=>$outcomeTable),
					array("total"=>$tIncome,"divname"=>"icdiv","tablename"=>"ictable","tabledata"=>$incomeTable)
	)?>

<div id='content'>
<?php 
foreach($arr as $array){
/*
*/?>
<div id='<?php echo $array['divname'];?>'>
<P>Total:<?php echo $array['total'];?> </P>	
<table id='<?php echo $array['tablename'];?>' class='reporttable'>
	<thead><tr><td>Cathegory</td><td>Value</td><tr></thead>
	<?php 
	$oddeven='odd';
	$categories=array();
	foreach($array['tabledata'] as $row)
	{
	/*
		if(!isset($categories[$row['cat']]){
			$categories[$row["cat"]]=array();
			$categories[$row['cat']] = $row['cost'];
		}
		else{
			$categories[$row['cat']] += $row['cost'];
		}*/
		if(!in_array($row['cat'],array_keys($categories)))
			$categories[$row['cat']]=$row['cost'];			
		else
			$categories[$row['cat']]+=$row['cost'];
	}
	arsort($categories);
	foreach($categories as $cat => $cost){
		echo "<tr class='$oddeven'>";
		echo "<td class='rcathegory'>".$cat."</td>";
		echo "<td class='rcost'><span>".number_format ( (float)$cost , 2 )."</span></td>";
		echo "</tr>";
		if($oddeven=='odd')
			$oddeven='even';
		else
			$oddeven='odd';
	}
	
	?>
</table>
</div>
<?php } ?>
</div>
<script type="text/javascript">

<!--
	$(document).ready(
			function (){
				$( "input:submit,input:button, button", "#wrap" ).button();
				
				$("#mback").click(function (){
					var value = $("#m").html();
					value--;
					if (value<=0) value = 12;
					$("#m").html(value);
					$("#month").val(value);
				});
				$("#yback").click(function (){
					var value = $("#y").html();
					value--;
					$("#y").html(value);
					$("#year").val(value);
					
				});

				$("#mford").click(function (){
					var value = $("#m").html();
					value++;
					if (value==13) value = 1;
					$("#m").html(value);
					$("#month").val(value);
				});
				$("#yford").click(function (){
					var value = $("#y").html();
					value++;
					$("#y").html(value);
					$("#year").val(value);
				});
			}
			);
function TestSubmitPermision(){
	var sp = $('#submitperm').val();
	if(sp!='1') return false;
	else return true;
}
/*function closeAdder(){
	$('#adder').hide();
}*/
function CheckAndSubmit(){
	$('#submitperm').val('1');
	document.changemonth.submit();
}

//-->
</script>
<?php get_footer();?>
