<?php 
include_once '../includes/DbAccountManagement.php';

$accountMan = new DbAccountManagement();
$accountMan->GetCategories();
$catArray=array();
while($row=$accountMan->fetchArray(NULL,MYSQL_ASSOC)){
	$catArray[]=$row;
}$accountMan->GetCurrentData();
$date=$accountMan->fetchArray(NULL,MYSQL_ASSOC);
if(isset($_POST['month']) && is_numeric($_POST['month']))$date['month']=$_POST['month'] ;
if(isset($_POST['year']) && is_numeric($_POST['year']))$date['year']=$_POST['year'];
