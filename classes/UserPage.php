<?
class UserPage extends EntryPage
{
	// smarty template object
	var $tpl = null;
	// error messages
	var $error = null;

	function UserPage($table="sbbs_users")
	{
		$this->table = $table;
		$this->tpl = new Smarty;
	}

	
}

?>