<?php 
include '../templates/templating.php';

get_sentry();

include_once './addexpences.php';

get_heather();
?>

		<form action="aeview.php" name='addexpences' method='POST'>
			<p><?php if($inputMethod=='income') echo "Inputting an Income"; else echo "Inputting an Outcome";?><p>
			<label for='cat'>Cathegory</label><input type = 'text' name='cat'    id='cat'><br>
			<label for='subcat'>Object</label><input type = 'text' name='subcat' id='subcat'><br>
			Description<textarea name='desc' id='desc'></textarea><br>
			<label for='cost'>Cost</label><input type = 'text' name='cost'   id='cost'><br>
			<label for='date'>Date</label><input type = 'text' name='date' id='date'><br>
			<input type='hidden' value='<?php echo $inputMethod;?>' name ='inputMethod'>
			<input type = 'button' onclick='document.addexpences.submit();' value='submit'>
		</form>
<?php get_footer();?>