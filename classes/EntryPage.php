<?
class EntryPage
{
	var $table = null;


	function EntryPage()
	{
	}

	///////////////////////////////////////////////////////
	//
	//
	function getEntry($id)
	{
		return new Entry($this->getEntryVars($id));
	}
	function getEntryVars($id)
	{
		$pos1 = SBBS::getMicrotime();

		global $sql;

		$query = "SELECT * FROM `$this->table` WHERE id='$id' LIMIT 1";

		$sql->query($query, SQL_INIT, SQL_ASSOC);

		$pos2 = SBBS::getMicrotime();
		$debug = sprintf("EntryPage::getEntryVars() : %f<br>", $pos2-$pos1);
		print($debug);

		return $sql->record;

		// NEED EXCEPTION HANDLING
	}

	function getEntries($vars, $begin=0, $num=0)
	{
		$vars = $this->getEntriesVars($vars, $begin, $num);

		$i = 0;
		while($vars[$i] != NULL)
		{
			$entry[$i] = new Entry($vars[$i]);
			$i++;
		}

		return $entry;
	}
	function getEntriesVars($vars, $begin=0, $num=0)
	{
		$pos1 = SBBS::getMicrotime();

		global $sql;

		list($key, $value) = each($vars);
		$query = "SELECT * FROM `$this->table` WHERE `$key`='$value' ORDER BY id DESC";

		$query .= sprintf(" LIMIT %d", $begin);
		if($num != 0)
			$query .= sprintf(", %d", $num);

		$sql->query($query, SQL_ALL, SQL_ASSOC);

		$pos2 = SBBS::getMicrotime();

		$debug = sprintf("EntryPage::getEntriesVars() : %f<br>", $pos2-$pos1);
		print($debug);

		return $sql->record;

		// NEED EXCEPTION HANDLING
	}

	function getNumOfEntries()
	{
		return mysql_result(mysql_query("SELECT count(id) FROM `$this->table`"), 0);
	}



	function addEntry($obj)
	{
		return $this->addEntryVars(get_object_vars($obj));
	}
	function addEntryVars($vars)
	{
		global $app, $sql;

		$query = "INSERT INTO `$this->table`";
		$i = 0;
		$key = array();
		$value = array();
		foreach($vars as $_key => $_value)
		{
			// DEBUG (null, 0 ..........)
			if($_value != null)
			{
				$key[$i] = sprintf("`%s`", $_key);
				$value[$i] = sprintf("'%s'", $_value);
				$i++;
			}
		}
		$query .= sprintf(" (%s)", implode(",", $key));
		$query .= sprintf(" VALUES(%s);", implode(",", $value));

		$sql->query($query);

		return mysql_insert_id();

		// NEED EXCEPTION HANDLING
	}

	function modifyEntry($obj)
	{
		$this->modifyEntryVars(get_object_vars($obj));
	}
	function modifyEntryVars($vars)
	{
		global $sql;

		$query = "UPDATE `$this->table` SET";
		foreach($vars as $key => $value)
		{
			if($key != "id")
				$tmp[] = " `$key`='$value'";
		}
		if(count($tmp) > 1)
			$query .= implode(",", $tmp);
		else
			$query .= $tmp[0];

		$query .= " WHERE `id`='$vars[id]' LIMIT 1";

		$sql->query($query);

		// NEED EXCEPTION HANDLING
	}

	function moveEntry($obj, $dstTable)
	{
		$this->moveEntryVars(get_object_vars($obj), $dstTable);
	}
	function moveEntryVars($vars, $dstTable)
	{
		global $sql;

		$id = $vars[id];
		$query = "INSERT INTO `$dstTable` SELECT * FROM `$this->table` WHERE id='$id' LIMIT 1";

		$sql->query($query);

		// NEED EXCEPTION HANDLING
	}

	function removeEntry($obj)
	{
		$this->removeEntryVars(get_object_vars($obj));
	}
	function removeEntryVars($vars)
	{
		global $sql;

		$id = $vars[id];
		$query = "DELETE FROM `$this->table` WHERE id='$id' LIMIT 1";

		$sql->query($query);

		// NEED EXCEPTION HANDLING
	}
}
?>