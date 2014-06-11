<?php
/*
require_once 'DbConnector.php';
require_once('Validator.php');
*/
class DbAccountManagement extends DbConnector
{

  private $cathegory;
  private $validator;
public function __construct()
{
  parent::__construct();
        $this->validator = new Validator();

}
  function AddCathegory($cat)
  {

    $this->cathegory = $cat;

    $this->validator->validateTextOnly($cat, "Cathegory from user input");

    $this->query("SELECT count(*) FROM cmscathegory WHERE name = '" . $cat . "';");

    if ($this->hasData(null))
    {
      return true;
    }


    return $this->query("INSERT INTO cmscathegory (name) VALUES ('" . $cat . "')");
  }

  function GetCategories()
  {
    return $this->query("SELECT name FROM cmscathegory ;");
  }

  function GetCurrentData()
  {
    return $this->query("SELECT year(now()) year,month(now()) as month;");
  }

  function AddExpense($subcat, $cost, $date, $desc = '', $isExpence = true)
  {
    $subCategoryIsValid = $this->validator->validateTextOnly($subcat, "Expence from user input");
    $costIsValid = $this->validator->validateNumber($cost, "Cost from user input");
    $dateIsValid = $this->validator->validateDate($date, "Date from user input");
    if (!($subCategoryIsValid && $costIsValid &&$dateIsValid))
    {
      return false;
    }

    $isExpence?$vExpence = "1":$vExpence = "0";
    

    $result = $this->query("SELECT id FROM cmscathegory WHERE name = '" . $this->cathegory . "';");
    $cat = $this->fetchArray($result);
    return $this->query("INSERT INTO cmsexpense (cathegory, object, description, cost, tsdate, isOutcome) VALUES " .
            "('" . $cat['id'] . "','$subcat','$desc','$cost','$date',$vExpence)");
  }
  function getMonthExpenseTable($month = 'month(now())', $year = 'year(now())')
  {
    return $this->query($this->getTableQuery(1, $month, $year));
  }
  function getMonthIncomeTable($month = 'month(now())', $year = 'year(now())')
  {
    return $this->query($this->getTableQuery(0, $month, $year));
  }

  private function getTableQuery($isOutcome, $month, $year)
  {
    $month = $this->checkValue($month, "month");
    $year = $this->checkValue($year, "year");

    return "SELECT e.id, c.name as cat, object, description, cost, date(tsdate) as date " .
        "FROM cmsexpense e, cmscathegory c where month(tsdate)=$month AND year(tsdate)=$year AND c.id=e.cathegory" .
        " AND isOutcome=$isOutcome order by date; ";
  }

  private function checkValue($var, $alternative){
  if ($var == '')
    {
      $var = "$alternative(now())";
    }
    if ($var != "$alternative(now())" && !$this->validator->validateNumber($var))
    {
      throw new Exception();
    }
    return $var;
}

  function deleteEntry($id)
  {
    if (!$this->validator->validateNumber($id))
    {
      throw new Exception("The Id is not a number!");
    }
    return $this->query("DELETE FROM cmsexpense WHERE id=" . $id);
  }

}
