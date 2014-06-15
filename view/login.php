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
            <input style='width:100%;font-size:1.6em;margin:5px 0 5px 0' type="button" name="Submit" value="Submit2" onclick="document.getElementById('action').setAttribute('value','login')">
            <input type="hidden" id="action">
          </form>
          <div align="right"><font size="3" face="Verdana, Arial, Helvetica, sans-serif"><a href="index.php?action=logout">Logout</a>&nbsp;</font></div>
        </td>
      </tr>
    </table>
  </body>
</html>