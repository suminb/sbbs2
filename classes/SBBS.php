<?
class SBBS
{
	var $tpl = null;

	function SBBS()
	{
		$this->tpl = new Smarty;

		// smarty configuration
        $this->tpl->template_dir = 'templates/common';
        $this->tpl->compile_dir = 'templates/common/compile';
        $this->tpl->config_dir = 'templates/common/config';
        $this->tpl->cache_dir = 'templates/common/cache';	
	}


	function MessageBox($message)
	{
		$page[title] = $message;
		$page[message] = $message;

		$this->tpl->assign("page", $page);
		$this->tpl->display("messageBox.tpl");

		exit(1);
	}

	///////////////////////////////////////////////////////
	// Section : global functions
	//
	function ipStrToDgt($ipStr)
	{
		$ip = explode(".", $ipStr);

		// big endian
		$ipDgt = 0;
		$ipDgt += (int)$ip[0] << 24;
		$ipDgt += (int)$ip[1] << 16;
		$ipDgt += (int)$ip[2] << 8;
		$ipDgt += (int)$ip[3];

		return $ipDgt;
	}

	function ipDgtToStr($ipDgt)
	{
		// big endian
		$ip[0] = ($ipDgt & 0xFF000000) >> 24;
		$ip[1] = ($ipDgt & 0x00FF0000) >> 16;
		$ip[2] = ($ipDgt & 0x0000FF00) >> 8;
		$ip[3] = ($ipDgt & 0x000000FF);

		$ipStr = implode(".", $ip);
		return $ipStr;
	}

	function getMicrotime() 
	{ 
		list($usec, $sec) = explode(" ", microtime()); 
		return ((float)$usec + (float)$sec); 
	}

	function getPage()
	{
		if($_GET[page])
			$page = $_GET[page];
		else
			$page = 1;

		return $page;
	}

	function setAction($_action, $defaultAction)
	{
		if($_action)
			$action = $_action;
		else
			$action = $defaultAction;

		return $action;
	}
}
?>