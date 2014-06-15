<?php

////////////////////////////////////////////////////////////////////////////////////////
// Class: sentry
// Purpose: Control access to pages
///////////////////////////////////////////////////////////////////////////////////////
class AccessControl
{

  var $loggedin = false; //	Boolean to store whether the user is logged in
  var $userdata;   //  Array to contain user's data
  private $validate;
  private $userManagement;

  function __construct()
  {
    session_start();
    header("Cache-control: private");
    $this->validate = new Validator();
    
  }

  //======================================================================================
  // Log out, destroy session
  function logout()
  {
    session_destroy();
    return true;
  }

  //======================================================================================
  // Log in, and either redirect to goodRedirect or badRedirect depending on success
  function checkLogin()
  {
    return isset($_SESSION["logged"]) && $_SESSION["logged"];
  }

  function login($user = '', $pass = '')
  {
    // Validate input
    $this->userManagement = new DbUserManagement();
    if (!$this->validate->validateTextOnly($user))
    {
      return false;
    }
    if (!$this->validate->validateTextOnly($pass))
    {
      return false;
    }

    $this->userManagement->CheckCypherPermission($user, $pass);

    $this->userManagement->fetchArray(NULL, MYSQL_ASSOC);

    if ($this->userManagement->hasData(NULL))
    {
      // Login OK, store session details
      // Log in
      $_SESSION["logged"] = true;
      return true;
    }
    else
    {
      // Login BAD
      $_SESSION["logged"] = false;
      return false;
    }
  }

}
