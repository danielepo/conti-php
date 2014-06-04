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

$sentry = new Sentry();
if (!isset($_GET['REDIRECT']) || $_GET['REDIRECT'] != "1")
{
  if (isset($_POST['user']) && $_POST['pass'] != '')
  {
    $sentry->login($_POST['user'], $_POST['pass'], 4, './userviews/welcome.php', './userviews/failed.php');
  }
  else
  {
    $sentry->login(null, null, 4, './userviews/welcome.php', './userviews/failed.php');
  }
}
if (isset($_GET['action']) && $_GET['action'] == 'logout')
{
  if ($sentry->logout())
  {
    echo '<center>You have been logged out</center><br>';
  }
}
?>

<html>
  <head>
    <title>Gestione Spesa</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  </head>

  <body>
    <table width="50%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000066">
      <tr>
        <td align="center" bgcolor="#000066"><font color="#FFFFFF" size="5" face="Verdana, Arial, Helvetica, sans-serif"><strong>Login</strong></font></td>
      </tr>
      <tr>
        <td bordercolor="#FFFFFF">
          <form name="form1" method="post" style='font-size:2em' action="index.php">
            <input style='width:100%;font-size:1.6em;margin:5px 0 5px 0'  type="text" name="user">
            <input style='width:100%;font-size:1.6em;margin:5px 0 5px 0' type="password" name="pass">
            <input style='width:100%;font-size:1.6em;margin:5px 0 5px 0' type="submit" name="Submit2" value="Submit">
          </form>
          <div align="right"><font size="3" face="Verdana, Arial, Helvetica, sans-serif"><a href="index.php?action=logout">Logout</a>&nbsp;</font></div>
        </td>
      </tr>
    </table>
  </body>
</html>