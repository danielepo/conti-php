<?php 
require_once 'DbConnector.php';
require_once('Validator.php');

class DbAccountManagement extends DbConnector {
	/*
	function DbUserManagement ()
	{
		$this.DbConnector();
	}*/
	private $cathegory;
	private $validator;
	function AddCathegory($cat)
	{
		
		if(!isset($this->validator))
			$this->validator=new Validator();
		$this->cathegory = $cat;
		
		$this->validator->validateTextOnly($cat,"Cathegory from user input");
		
		$result = $this->query("SELECT count(*) FROM cmscathegory WHERE name = '".$cat."';");
		
		$row=$this->fetchRow($result);
		if($row[0]>0)	
			return true;
		
		
		return $this->query("INSERT INTO cmscathegory (name) VALUES ('".$cat."')");
	}
	function GetCategories(){
		return $this->query("SELECT name FROM cmscathegory ;");
	}
	function GetCurrentData(){
		return $this->query("SELECT year(now()) year,month(now()) as month;");
	}
	function AddExpense($subcat,$cost,$date,$desc='',$isExpence = true)
	{
		if(!isset($this->validator))
			$this->validator=new Validator();

		if(	!$this->validator->validateTextOnly($subcat,"Expence from user input") ||
			!$this->validator->validateNumber($cost,"Cost from user input") ||
			!$this->validator->validateDate($date,"Date from user input")) return false;
		
		if($isExpence) $vExpence="1";
		else $vExpence="0";
			
		$result = $this->query("SELECT id FROM cmscathegory WHERE name = '".$this->cathegory."';");
		$cat=$this->fetchArray($result);
		return $this->query("INSERT INTO cmsexpense (cathegory, object, description, cost, tsdate, isOutcome) VALUES ".
							"('".$cat['id']."','".$subcat."','".$desc."','".$cost."','".$date."',$vExpence)");
	}
	
	function getMonthExpenseTable($month = 'month(now())',$year = 'year(now())')
	{
		if($month=='') $month = 'month(now())';
		if($year=='') $year = 'year(now())';
		if(!isset($this->validator))
			$this->validator=new Validator();
		if($month!='month(now())')		
			if(	!$this->validator->validateNumber($month)) return false;
		if($year!='year(now())')		
			if(	!$this->validator->validateNumber($year)) return false;
			
		return $this->query("SELECT e.id, c.name as cat, object, description, cost, date(tsdate) as date ".
							"FROM cmsexpense e, cmscathegory c where month(tsdate)=$month AND year(tsdate)=$year AND c.id=e.cathegory".
							" AND isOutcome=1 order by date; ");
	}
	function getMonthIncomeTable($month = 'month(now())',$year = 'year(now())')
	{
		if($month=='') $month = 'month(now())';
		if($year=='') $year = 'year(now())';
		if(!isset($this->validator))
			$this->validator=new Validator();
		if($month!='month(now())')		
			if(	!$this->validator->validateNumber($month)) return false;
		if($year!='year(now())')		
			if(	!$this->validator->validateNumber($year)) return false;
			
		return $this->query("SELECT e.id, c.name as cat, object, description, cost,  date(tsdate) as date ".
							"FROM cmsexpense e, cmscathegory c where month(tsdate)=$month AND year(tsdate)=$year AND c.id=e.cathegory".
							" AND isOutcome=0 order by date;");
	}
	
	function deleteEntry($id)
	{
		if(	!$this->validator->validateNumber($id)) return false;
		return $this->query("DELETE FROM cmsexpense WHERE id=".$id);
	}
}
?>