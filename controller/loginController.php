<?php

class loginController extends Controller{
  public function logout(){
    $sentry = new AccessControl();
    $sentry->logout();
    $this->view->printView();
  }
  public function login($user,$password){
    $sentry = new AccessControl();
    $sentry->login($user, $password);
    //$model->checkCredentials();
  }
}