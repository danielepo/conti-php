<?php 
require_once 'DbConnector.php';

class DbUserManagement extends DbConnector {
	/*
	function DbUserManagement ()
	{
		$this.DbConnector();
	}*/
	
	function CheckPermission($user,$pass,$group)
	{
		return $this->query("SELECT * FROM cmsusers WHERE user = '".$user."' AND pass = '".$pass."' AND thegroup <= ".$group." AND enabled = 1");
	}
	function CheckCypherPermission($user,$pass,$group)
	{
	$md5p=md5($pass);
		return $this->query("SELECT * FROM cmsusers WHERE user = '$user' AND pass = '$md5p' AND thegroup <= $group AND enabled = 1");
	}
}
?>