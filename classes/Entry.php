<?
class Entry
{
	var $id = 0;

	function Entry($vars = null)
	{
		if($vars)
		{
			$this->setEntry($vars);
		}
	}

	///////////////////////////////////////////////////////
	// Section : get/set (entry)
	//
	function getEntry()
	{
		return get_object_vars($this);
	}

	function setEntry($vars)
	{
		foreach($vars as $key => $value)
		{
			$this->$key = $value;
		}
	}

	function neutralizeTags($str, $exception = null)
	{
		$str = str_replace("<", "&lt;", $str);

		return $str;
	}
}
?>