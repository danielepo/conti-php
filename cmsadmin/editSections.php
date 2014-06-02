<?php
// Require the classes
require_once('../includes/DbConnector.php');
require_once('../includes/Validator.php');

require_once('../includes/Sentry.php');
$theSentry = new Sentry();
if (!$theSentry->checkLogin(2) ){ header("Location: login.php"); die(); }

// Create an object (instance) of the DbConnector and Validator
$connector = new DbConnector();
$validator = new Validator();

// DELETE SECTIONS ////////////////////////////////////////////////////////////////////
if (isset($_GET['action']) && $_GET['action'] == 'delete'){

	// Store the section ID to be deleted in a variable
	$sectionID = $_GET['id'];

	// Validate the sectionID, and if it's ok delete the section
	if ( $validator->validateNumber($sectionID,'Section ID') ){

		// The validator returned true, so go ahead and delete the section
		$connector->query('DELETE FROM cmssections WHERE ID = '.$sectionID);
		echo 'Section Deleted.<br>';
	}else{
		// The validator returned false, meaning there was a problem
		echo "Couldn't delete. There was a problem with: ".$validator->listErrors();
	}
}

// ADD SECTION ////////////////////////////////////////////////////////////////////
if (isset($_GET['action']) && $_GET['action'] == 'add'){
	$validator->validateTextOnlyNoSpaces($_POST['name'],'section name');
	$validator->validateNumber($_POST['parent'],'parent section');
	
	if (!$validator->foundErrors()){
		$connector->query('INSERT INTO cmssections (name,parentid) VALUES ("'.$_POST['name'].'",'.$_POST['parent'].')');	
	}else{
		echo '<b>Please correct '.$validator->listErrors().'</b><br><br>';
	}

}

// LIST SECTIONS /////////////////////////////////////////////////////////////////////
$result = $connector->query('SELECT ID,name,parentid FROM cmssections');

// Get an array containing the results.
// Loop for each item in that array
while ($row = $connector->fetchArray($result)){
	echo $row['name'].' - &nbsp;&nbsp; '; // Show the name of section
	echo '<a href="editSections.php?action=delete&id='.$row['ID'].'"> Delete </a>'; // Show the delete link 
	echo '<br>'; // Show a carriage return
}

?>
<html>
<head>
<title>Edit Sections</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<form name="form1" method="post" action="editSections.php?action=add">
  <p>Create a Section:</p>
  <p>&nbsp;Name:
      <input name="name" type="text" id="name">
  </p>
  <p>&nbsp;Parent:
    <select name="parent">
	<option value="0">None</option>
      <?PHP 	// Generate a drop-down list of sections.
				// NOTE : Requires database modifications in article 4
				$result = $connector->query('SELECT ID,name FROM cmssections ORDER BY name');

				// Get an array containing the results.
				// Loop for each item in that array
				while ($row = $connector->fetchArray($result)){
					echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
				}
		  ?>
        </select>
  </p>
  <p align="left">
    <input type="submit" name="Submit" value="Create">
  </p>
</form>
</body>
</html>
