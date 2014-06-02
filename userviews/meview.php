<?php 
include '../templates/templating.php';

get_sentry();

include_once './monthexpences.php';

get_heather();
?>

<script type="text/javascript">
function CheckAndSubmit(){document.changemonth.submit();}
</script>
<form action="meview.php<?php echo "?".$inputMethod;?>" name='changemonth' method="post">
<label for='month'>Month</label>
<input type="text" id='month' name='month'><br>
<label for='year'>Year</label>
<input type="text" id='year' name='year'>
<input type='button' onclick='CheckAndSubmit()' value='GO'><br> 
</form>
<table id='outcometable' class='reporttable'>
<?php 

foreach($outcomeTable as $row)
{
	echo "<tr>";
	foreach($row as $field){
		echo "<td>$field</td>";
	}
	echo "</tr>";
}

?>
</table>

<table id='incometable' class='reporttable'>
<?php 

foreach($incomeTable as $row)
{
	echo "<tr>";
	foreach($row as $field){
		echo "<td>$field</td>";
	}
	echo "</tr>";
}

?>
</table>

<?php get_footer();?>