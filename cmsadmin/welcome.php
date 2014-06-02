<?php
require_once('../includes/Sentry.php');
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
