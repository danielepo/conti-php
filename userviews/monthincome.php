<?php 

include_once '../includes/DbAccountManagement.php';


$accountMan = new DbAccountManagement();

if(isset($_POST['inputMethod']))
	$inputMethod="inputMethod=".$_POST['inputMethod'];
else if(isset($_GET['inputMethod']))
	$inputMethod="inputMethod=".$_GET['inputMethod'];
else
	$inputMethod="";

if(isset($_POST['month']) && isset($_POST['year']))
	$result=$accountMan->getMonthIncomeTable($_POST['month'],$_POST['year']);
else
	$result=$accountMan->getMonthIncomeTable();
$incomeTable=array();
$tIncome=0;
while($row=$accountMan->fetchArray($result,MYSQL_ASSOC)){
	$incomeTable[]=$row;
	$tIncome+=$row['cost'];
}
if(isset($_POST['rowId']) && $_POST['rowId']!='')
	$accountMan->deleteEntry($_POST['rowId']);
	
unset($accountMan);
?>