<?
class Comment extends Entry
{
	function Comment($vars)
	{
		if($vars)
		{
			$this->setEntry($vars);
		}
	}
}
?>