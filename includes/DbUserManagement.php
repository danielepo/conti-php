<?php

require_once 'DbConnector.php';

class DbUserManagement extends DbConnector
{

  function CheckPermission($user, $md5)
  {
    $this->queryResult = $this->query("SELECT * FROM cmsusers WHERE user = '" . $user . "' AND pass = '" . $md5 . "' AND enabled = 1");
    //return $this->queryResult;
  }

  function CheckCypherPermission($user, $pass)
  {
    
    $md5p = md5($pass);
    $this->CheckPermission($user, $md5p);
   // return $this->queryResult;
  }

}