<?php 
include_once '../templates/templating.php';

get_sentry();
include_once './initialData.php';
include_once './addexpences.php';
include_once './monthexpences.php';
include_once './monthincome.php';

get_heather();
?>
<div id='contenthead'>
<button onclick='openAddOutcome()'>Add Outcome</button>
<button onclick='openAddIncome()' >Add Income</button>

<form action="completeView.php" name='changemonth' method="post"  onSubmit="return TestSubmitPermision()">
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

<form action="completeView.php" name='deleteRow' id='deleteRow' method="post">

	<input type="hidden" id='month' name='month' value='<?php echo $date['month'];?>'>
	<input type="hidden" id='year' name='year' value='<?php echo $date['year'];?>'>
	<input type="hidden" id='rowId' name='rowId' value=''>
</form>
<div id='adder' title='title'>
		
		<form action="completeView.php" name='addrow' id='addrow' method='POST'>
			
			<p id="cattext">Cathegory</p>
			<p id="desctext">Description</p>
			<p id="costtext">Cost</p>
			<p>Date</p>
			<div style="position: absolute; top: 0pt; left: 100px;">
				<input id='selId' type='hidden' value=''>
				<input id="cat"  name="cat">
				<br>
				<input id="subcat" type="text" name="subcat">
				<br>
				<textarea id="desc" name="desc"></textarea>
				<br>
				<input id="cost" type="text" name="cost">
				<br>
				<input id="datepicker" readonly="readonly" name="date">
				<br>
				<input id="inputMethod" type="hidden" name="inputMethod" value="">
				<br>
				<input id="adderSubmit" type="button" value="Submit">
			</div>
				
		</form>							<!-- document.addincome.submit(); -->
	
	
</div>

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
	<thead><tr><td>Delete</td><td>Modify</td><td>Date</td><td>Cathegory</td><td>Object</td><td>Value</td><tr></thead>
	<?php 
	$oddeven='odd';
	foreach($array['tabledata'] as $row)
	{
		echo "<tr class='$oddeven'>".
			"<td><button onclick=\"removeId(this,'".$row['id']."')\" class='deleteRow'><span class='ui-icon ui-icon-close'></span></button></td>".
			"<td><button onclick=\"modifyEntry(this,'".$row['id']."')\" class='deleteRow'><span class='ui-icon ui-icon-pencil'></span></button></td>";
		echo "<td class='rdate'>".$row['date']."</td>";
		echo "<td class='rcathegory'>".$row['cat']."</td>";
		echo "<td class='robject'>".$row['object']."</td>";
		echo "<td class='rcost'><span>".number_format ( (float)$row['cost'] , 2 )."</span></td>";
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
				
				$( "#adder" ).dialog({ modal: true,autoOpen: false, height: 500, width:500});
		//		$( ".deleteRow").children('span').each(function(){$(this).removeClass( '.ui-button-text' );});
				$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
				var availableCategories = [
				        			<?php
				        			$vir=''; 
				        			foreach ($catArray as $val){
				        				echo $vir."'".$val['name']."'";
				        				$vir=',';
				        			}
				        			?>					         			
				         		];
         		$( "#cat" ).autocomplete({
         			source: availableCategories
         		});

         		$("input:text").each(function(){ $(this).val(''); });
         		$("#cat").val('');

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
function removeId(elm,elmid){
	$('#rowId').val(elmid);
	//alert(elmid);
	$('#deleteRow').submit();
}
function openAddOutcome(){
	$('#adder').dialog('open');
	$('#selId').val('');
	$('#inputMethod').val('');
	$( "#adder" ).dialog( "option", "title", 'Inputing an Outcome' );
	
	$('#adderSubmit').click(function() {
		$('#addrow').submit();  
	});
}
function openAddIncome(){
	$('#adder').dialog('open');
	$('#selId').val('');
	$('#inputMethod').val('income');
	$( "#adder" ).dialog( "option", "title", 'Inputing an Income' );
	
	$('#adderSubmit').click(function() {
		$('#addrow').submit();  
	});
}
function modifyEntry(elm,elmId){
	
	$('#selId').val(elmId);
	$('#adder').dialog('open');
	
	var row = $(elm).parents("tr");
	var cat = row.children('.rcathegory').html();
	var object = row.children('.robject').html();
	var cost = row.children('.rcost').html();
	var date = row.children('.rdate').html();
	
	$('#cat').val(cat);
	$('#subcat').val(object);
	$('#cost').val(cost);
	$('#datepicker').val(date);
	//$('cat').val();
}
//-->
</script>
<?php get_footer();?>