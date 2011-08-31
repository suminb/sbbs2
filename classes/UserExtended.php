<?
class UserExtended extends User
{
	function UserExtneded($vars)
	{
		if($vars)
		{
			$this->setEntry($vars);
		}
	}
}
?>