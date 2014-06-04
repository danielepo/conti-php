<?php 
include_once '../includes/DbAccountManagement.php';

if (isset($_REQUEST['inputMethod']))
{
  $inputMethod = $_POST['inputMethod'];
}
else
{
  $inputMethod = "";
}

if(isset($_POST['cat']) && isset($_POST['subcat']) && isset( $_POST['cost']) && isset($_POST['date']) && isset( $_POST['desc'])){

	if($accountMan->AddCathegory($_POST['cat'])){
		if($inputMethod=="" || $inputMethod=="expence")
			$accountMan->AddExpense($_POST['subcat'], $_POST['cost'], $_POST['date'],$_POST['desc']);
		else 
			$accountMan->AddExpense($_POST['subcat'], $_POST['cost'], $_POST['date'],$_POST['desc'],false);
	}
		
}
