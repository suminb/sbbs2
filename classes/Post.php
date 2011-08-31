<?
define("POST_ATTR_NOTICE",0);
define("POST_ATTR_SECRET",0);
define("POST_ATTR_DELETED",0);

define("POST_INBOUND", 1);
define("POST_OUTBOUND", 2);

class Post extends Entry
{
	var $uid = null;
	var $bid = null;
	var $category = null;
	var $dateReg = null;
	var $dateMod = null;
	var $dateDlt = null;
	var $ip = null;
	var $accessed = null;
	var $attributes = null;
	var $extended = null;

	var $title = null;
	var $content = null;


	function Post($vars = null)
	{
		if($vars)
		{
			$this->setEntry($vars);
		}
	}

	function getTitle() // OUTBOUND
	{
	}
	function setTitle() // INBOUND
	{
	}

	function processTitle($direction)
	{
		if($direction == POST_INBOUND)
		{
			$this->title = addslashes($this->title);
		}
		else if($direction == POST_OUTBOUND)
		{
			$this->title = stripslashes($this->title);
			$this->title = $this->neutralizeTags($this->title);
		}
	}

	function processContent($direction)
	{
		if($direction == POST_INBOUND)
		{
			$this->content = addslashes($this->content);
		}
		else if($direction == POST_OUTBOUND)
		{
			$this->content = stripslashes($this->content);
			$this->content = $this->neutralizeTags($this->content);
			$this->content = str_replace("\n", "<br/>\n", $this->content);
		}
	}

}

?>