<?php 
include_once '../templates/templating.php';

get_sentry();
include_once './initialData.php';
include_once './addexpences.php';

get_heather();
?>
<div id='adder' title='title'>
		
		<form action="aggUscita.php" name='addrow' id='addrow' method='POST'>
			<table class='addTable'>
				<tr><td class='first'>
					<p id="cattext">Cathegory</p>
				</td><td class='second'>
					<input id='selId' type='hidden' value=''>
					<input id="cat"  name="cat"><br>
					<input id="subcat" type="text" name="subcat">
				</td></tr>
				<tr><td class='first'>
					<p id="desctext">Description</p>
				</td><td class='second'>
					<textarea id="desc" name="desc"></textarea>
				</td></tr>
				<tr><td class='first'>
					<p id="costtext">Cost</p>
				</td><td class='second'>
					<input id="cost" type="text" name="cost">
				</td></tr>
				<tr><td class='first'>
					<p>Date</p>
				</td><td class='second'>
					<input id="datepicker" readonly="readonly" name="date">			
				</td></tr>
				<tr><td colspan='2'>
					<input id="adderSubmit" type="submit" value="Submit" onclick='forms[0].submit();'>
				</td></tr>
				
			</table>
			<input id="inputMethod" type="hidden" name="inputMethod" value="expence">				
		</form>							<!-- document.addincome.submit(); -->
	
	
</div>
<?php get_footer();?>
<script type="text/javascript">

<!--
$(document).ready(
		function (){
			
			$( "#adder" ).show();
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
			$("#cat").val('').focus();
		}
		);
//-->
</script>