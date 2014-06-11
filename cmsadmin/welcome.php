<?php
function __autoload($class)
{
  $filename = $class . '.php';
  $includeFolder = './includes/';
  $templatesFolder = './templates/';
  if (file_exists($includeFolder . $filename))
  {
    require_once $includeFolder . $filename;
  }
  if (file_exists($templatesFolder . $filename))
  {
    require_once $templatesFolder . $filename;
  }
}

$theSentry = new Sentry();
if (!$theSentry->checkLogin(10) ){ header("Location: login.php"); die(); }
?>
<html>
<head>
<title>Welcome</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
Welcome to the admin area
</body>
</html>
