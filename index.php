<?php

function __autoload($class)
{
  $filename = $class . '.php';
  $folders = array('./includes/', './library/','./templates/', './model/', './view/', './controller/');
  foreach ($folders as $p)
  {
    $path = $p . $filename;
    if (file_exists($path))
    {
      require_once $path;
    }
  }
}

$controllerClass = "loginController";
$modelClass = "loginModel";
$viewClass = "loginView";
$action = "logout";

if (isset($_REQUEST["action"]))
{

  if (class_exists($_REQUEST["controller"] + "Controller"))
  {
    $controllerClass = $_REQUEST["controller"] + "Controller";
  }
  if (class_exists($_REQUEST["model"] + "Model"))
  {
    $modelClass = $_REQUEST["model"] + "Model";
  }
  if (class_exists($_REQUEST["view"] + "View"))
  {
    $viewClass = $_REQUEST["view"] + "View";
  }
  $action = $_REQUEST["action"];
}
$view = new $viewClass();
$model = new $modelClass($view);
$controller = new $controllerClass($view,$model);

$controller->$action();
