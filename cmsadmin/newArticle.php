<html>
<head>
<title>Add an Article</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php
// Get the PHP file containing the DbConnector class
require_once('../includes/DbConnector.php');
require_once('../includes/Validator.php');

require_once('../includes/Sentry.php');
$theSentry = new Sentry();
if (!$theSentry->checkLogin(2) ){ header("Location: login.php"); die(); }


// Create an instance of DbConnector
$connector = new DbConnector();

// Check whether a form has been submitted. If so, carry on
if ($_POST){

// Validate the entries
$validator = new Validator();

$validator->validateTextOnly($_POST['title'],'Article Title');
$validator->validateTextOnly($_POST['tagline'],'Tagline');
$validator->validateNumber($_POST['section'],'Section');
$validator->validateGeneral($_POST['thearticle'],'Article');

// Check whether the validator found any problems
if ( $validator->foundErrors() ){
	echo 'There was a problem with: <br>'.$validator->listErrors('<br>'); // Show the errors, with a line between each
}else{

// Create an SQL query (MySQL version)
// The 'addslashes' command is used 5 lines below for added security
// Remember to use 'stripslashes' later to remove them (they are inserted in front of any
// special characters

$insertQuery = "INSERT INTO cmsarticles (title,tagline,section,thearticle) VALUES (".
"'".$_POST['title']."', ".
"'".$_POST['tagline']."', ".
$_POST['section'].", ".
"'".addslashes($_POST['thearticle'])."')";

	// Save the form data into the database 
	if ($result = $connector->query($insertQuery)){

		// It worked, give confirmation
		echo '<center><b>Article added to the database</b></center><br>';

	}else{

		// It hasn't worked so stop. Better error handling code would be good here!
		exit('<center>Sorry, there was an error saving to the database</center>');

	}
}
}
?>

<body>
<form name="form1" method="post" action="newArticle.php">
        <p>&nbsp;Title:
          <input name="title" type="text" id="title">
        </p>
        <p>&nbsp;Tagline:
          <input name="tagline" type="text" id="tagline">
        </p>
        <p>&nbsp;Section:
		<select name="section" id="section">
		
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
        <p>&nbsp;Article:
          <textarea name="thearticle" cols="50" rows="6" id="thearticle"></textarea>
        </p>
        <p align="center">
          <input type="submit" name="Submit" value="Submit">
        </p>
</form>
</body>
</html>
