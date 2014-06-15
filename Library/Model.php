<?php

class Model{
  protected $view;
  public function __construct($view)
  {
    $this->view = $view;
  }
}