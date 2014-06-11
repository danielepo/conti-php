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
function __construct(){

}
protected function connect(){
  	$settings = SystemComponent::getSettings();

	// Get the main settings from the array we just loaded
	$host = $settings['dbhost'];
	$db = $settings['dbname'];
	$user = $settings['dbusername'];
	$pass = $settings['dbpassword'];
  $this->link = mysqli_init();
	// Connect to the database
	$this->link->real_connect($host, $user, $pass, $db, 3306);
  register_shutdown_function(array(&$this, 'close'));
	
}

//*** Function: query, Purpose: Execute a database query ***
public  function query($query) {
   $this->connect();
  $this->theQuery = $query;
	$this->queryResult = $this->link->query($query);
	$this->error=$this->link->error;
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
	return $this->queryResult->num_rows;
}
//*** Function: getNumRows, Purpose: Return row count, MySQL version ***
function hasData($result){
	return $this->getNumRows(null) > 0;
}

//*** Function: fetchArray, Purpose: Get array of query results ***

function fetchArray($result,$result_type = MYSQL_BOTH) {
   if ($this->queryResult)
    {
      return $this->queryResult->fetch_array($result_type);
    }
    else
    {
      return -1;
    }
  }
//*** Function: fetchArray, Purpose: Get array of query results ***
function fetchRow($result) {
	return $this->queryResult->fetch_row();
}
//*** Function: close, Purpose: Close the connection ***
function close() {
	if($this->link != null)
  $this->link->close();
}


}