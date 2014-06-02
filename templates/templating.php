<?php 
function get_heather($mainPage = false){
if(!$mainPage) $dots='..'; else $dots='.';?>
<html>
	<head>
	<link rel='stylesheet' href='../css/style.css' type='text/css'/>
	<link type="text/css" href="../css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
	<script type="text/javascript" src='../js/jquery-1.6.2.min.js'></script>
	<script type="text/javascript" src='../js/jquery-ui-1.8.16.js'></script>
	</head>

	<body>
		<div id='wrap'>

	<h1>Acount Manager</h1>
	
	<ul id='nav'>
		<li><a href='../index.php'>Home</a></li>
		<li><a href='./completeView.php'>Monthly Report</a></li>
		<li><a href='./aggUscita.php'>Aggiungi Uscita</a></li>
		<li><a href='./aggIngresso.php'>Aggiungi Ingresso</a></li>
	</ul>
	
	<?php 
}

function get_footer(){
?>
		</div>
	</body>
</html>
<?php 
}

function get_sentry($level=10){
	require_once('../includes/Sentry.php');
	$theSentry = new Sentry();
	if (!$theSentry->checkLogin($level) ){ header("Location: ../index.php"); die(); }
	
}
?>