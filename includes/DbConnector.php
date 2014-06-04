<?php
////////////////////////////////////////////////////////////////////////////////////////
// Class: DbConnector
// Purpose: Connect to a database, MySQL version
///////////////////////////////////////////////////////////////////////////////////////
require_once 'SystemComponent.php';

class DbConnector extends SystemComponent {

var $theQuery;
var $link;
var $error;

protected $queryResult;

//*** Function: DbConnector, Purpose: Connect to the database ***
function DbConnector(){

	// Load settings from parent class
	$settings = SystemComponent::getSettings();

	// Get the main settings from the array we just loaded
	$host = $settings['dbhost'];
	$db = $settings['dbname'];
	$user = $settings['dbusername'];
	$pass = $settings['dbpassword'];

	// Connect to the database
	$this->link = mysql_connect($host, $user, $pass);
	mysql_select_db($db);
	register_shutdown_function(array(&$this, 'close'));

}

//*** Function: query, Purpose: Execute a database query ***
public  function query($query) {
	$this->theQuery = $query;
	$this->queryResult = mysql_query($query, $this->link);
	$this->error=mysql_error($this->link);
	//echo $this->theQuery."<br>";
	if ($this->error != '')
    {
      echo $this->error;
    }
    return $this->queryResult;
}

public function getError(){
	return $this->error;
}
//*** Function: getQuery, Purpose: Returns the last database query, for debugging ***
function getQuery() {
	return $this->theQuery;
}

//*** Function: getNumRows, Purpose: Return row count, MySQL version ***
function getNumRows($result){
	return mysql_num_rows($this->queryResult);
}
//*** Function: getNumRows, Purpose: Return row count, MySQL version ***
function hasData($result){
	return mysql_num_rows($this->queryResult) > 0;
}

//*** Function: fetchArray, Purpose: Get array of query results ***

function fetchArray($result,$result_type = MYSQL_BOTH) {
   if ($result)
    {
      return mysql_fetch_array($this->queryResult, $result_type);
    }
    else
    {
      return -1;
    }
  }
//*** Function: fetchArray, Purpose: Get array of query results ***
function fetchRow($result) {
	return mysql_fetch_row($this->queryResult);
}
//*** Function: close, Purpose: Close the connection ***
function close() {
	mysql_close($this->link);
}


}