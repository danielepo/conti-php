<?php

////////////////////////////////////////////////////////////////////////////////////////
// Class: sentry
// Purpose: Control access to pages
///////////////////////////////////////////////////////////////////////////////////////
class sentry
{

  var $loggedin = false; //	Boolean to store whether the user is logged in
  var $userdata;   //  Array to contain user's data
  private $validate;
  private $userManagement;

  function sentry()
  {
    session_start();
    header("Cache-control: private");
    $this->validate = new Validator();
    $this->userManagement = new DbUserManagement();
  }

  //======================================================================================
  // Log out, destroy session
  function logout()
  {
    unset($this->userdata);
    session_destroy();
    return true;
  }

  //======================================================================================
  // Log in, and either redirect to goodRedirect or badRedirect depending on success
  function checkLogin($group = 10)
  {
    return $this->login('', '', $group, '', 'failed.php');
  }

  function loginSimple($user = '', $pass = '', $group = 10)
  {
    // Validate input
    if (!$this->validate->validateTextOnly($user))
    {
      return false;
    }
    if (!$this->validate->validateTextOnly($pass))
    {
      return false;
    }

    // Look up user in DB

     $this->userManagement->CheckCypherPermission($user, $pass, $group);

    $this->userdata = $this->userManagement->fetchArray(NULL, MYSQL_ASSOC);

    if ($this->userManagement->hasData(NULL))
    {
      // Login OK, store session details
      // Log in
      $_SESSION["user"] = $user;
      $_SESSION["pass"] = $this->userdata['pass'];
      $_SESSION["thegroup"] = $this->userdata['thegroup'];

      if ($goodRedirect)
      {
        header("Location: " . $goodRedirect . "?" . strip_tags(session_id()));
      }
      return true;
    }
    else
    {
      // Login BAD
      unset($this->userdata);
      return false;
    }
  }

  function login($user = '', $pass = '', $group = 10, $goodRedirect = '', $badRedirect = '')
  {

    // If user is already logged in then check credentials
    if (isset($_SESSION['user']) && isset($_SESSION['pass']))
    {
      $this->userManagement->CheckPermission($_SESSION['user'], $_SESSION['pass'], $group);

      if ($this->userManagement->hasData(null))
      {
        // Existing user ok, continue
        if ($goodRedirect != '')
        {
          header("Location: " . $goodRedirect . "?" . strip_tags(session_id()));
        }
        return true;
      }
      else
      {
        // Existing user not ok, logout
        $this->logout();
        return false;
      }

      // User isn't logged in, check credentials
    }
    else
    {
      return $this->loginSimple($user, $pass);
    }
  }

}
