<?php
require_once("../includes/Sentry.php");

$sentry = new Sentry();
if (isset($_POST['user']) && $_POST['user'] != ''){
	$sentry->login($_POST['user'],$_POST['pass'],4,'welcome.php','failed.php');
}

if (isset($_GET['action']) && $_GET['action'] == 'logout'){
	if ($sentry->logout()){
		echo '<center>You have been logged out</center><br>';
	}
}
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<table width="25%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000066">
  <tr>
    <td align="center" bgcolor="#000066"><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Login</strong></font></td>
  </tr>
  <tr>
    <td bordercolor="#FFFFFF"><form name="form1" method="post" action="login.php">
        <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
&nbsp;User:
          <input type="text" name="user">
        </font></p>
        <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;Pass:
              <input type="password" name="pass">
        </font></p>
        <p align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
          <input type="submit" name="Submit2" value="Submit">
        </font></p>
      </form>
        <div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a href="login.php?action=logout">Logout</a>&nbsp;</font></div>
    </td>
  </tr>
</table>
</body>
</html>
