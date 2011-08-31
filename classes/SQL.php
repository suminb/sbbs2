<?
//
// http://smarty.php.net/sampleapp/sampleapp_p3.php
//

// define the query types
define('SQL_NONE', 1);
define('SQL_ALL', 2);
define('SQL_INIT', 3);

// define the query formats
define('SQL_ASSOC', 1);
define('SQL_INDEX', 2);


class SQL
{
	var $db = null;
	var $result = null;
	var $error = null;
	var $record = null;
	var $count = 0;
	
	/**
	 * class constructor
	 */
	function SQL() { }
	
	/**
	 * connect to the database
	 *
	 * @param string $dsn the data source name
	 */
	function connect($dsn = "")
	{
		// DEBUG
		$this->db = mysql_connect("localhost", "superwtk", "dhshrotoRlbbq");
		mysql_select_db("superwtk");

	/*
		$this->db = DB::connect($dsn);

		if(DB::isError($this->db)) {
			$this->error = $this->db->getMessage();
			return false;
		}		
	*/
		return true;
	}
	
	/**
	 * disconnect from the database
	 */
	function disconnect()
	{
		mysql_close();
	}
	
	/**
	 * query the database
	 *
	 * @param string $query the SQL query
	 * @param string $type the type of query
	 * @param string $format the query format
	 */
	function query($query, $type = SQL_NONE, $format = SQL_ASSOC)
	{
		$this->record = array();
		$_data = array();

		$this->result = mysql_query($query) or die(mysql_error());
		$this->count = 0;


		switch ($type)
		{
			case SQL_ALL:
				// get all the records
				if($format == SQL_INDEX)
				{
					while($_row = mysql_fetch_row($this->result)) {
						$_data[] = $_row;
						$this->count++;
					}
				}
				else if($format == SQL_ASSOC)
				{
					while($_row = mysql_fetch_assoc($this->result)) {
						$_data[] = $_row;
						$this->count++;
					}
				}
		
				$this->record = $_data;
				break;

			case SQL_INIT:
				// get the first record
				if($format == SQL_INDEX)
				{
					$this->record = mysql_fetch_row($this->result);
					if($this->record)
						$this->count++;
				}
				else if($format == SQL_ASSOC)
				{
					$this->record = mysql_fetch_assoc($this->result);
					if($this->record)
						$this->count++;
				}
				break;
			case SQL_NONE:
			default:
				// records will be looped over with next()
				break;   
		}
		return true;
	}
	
	/**
	 * connect to the database
	 *
	 * @param string $format the query format
	 */
	function next($format = SQL_INDEX)
	{
		if($format == SQL_INDEX)
		{
			$this->record = mysql_fetch_row($this->result);
		}
		else if($format == SQL_ASSOC)
		{
			$this->record = mysql_fetch_assoc($this->result);
		}
	}
	
}
?>
