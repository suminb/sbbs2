<?
define("USER_ATTR_AUTHORIZED",		0x00000001);
define("USER_ATTR_DELETED",			0x00000002);
define("USER_ATTR_ANONYMOUS",		0x00000004);

define("USER_ATTR_ADMINISTRATOR",	0xF0000000);


class User extends Entry
{
	var $struid = null;
	var $password = null;
	var $name = null;
	var $nickname = null;
	var $email = null;
	var $website = null;

	var $dateReg = null;
	var $dateMod = null;
	var $dateDlt = null;

	var $attributes = null;
	var $extended = null;

	var $details = null;
	var $signature = null;


	function User($vars)
	{
		if($vars)
		{
			$this->setEntry($vars);
		}
	}


	///////////////////////////////////////////////////////
	// Section
	//
}

?>