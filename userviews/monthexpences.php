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
	$result=$accountMan->getMonthExpenseTable($_POST['month'],$_POST['year']);
else
	$result=$accountMan->getMonthExpenseTable();
$outcomeTable=array();
$tOutcome=0;
while($row=$accountMan->fetchArray($result,MYSQL_ASSOC)){
	$outcomeTable[]=$row;
	$tOutcome+=$row['cost'];
}

unset($accountMan);
?>