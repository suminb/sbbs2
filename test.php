<?
include "core.php";


// smarty configuration
class SmartyPost extends Smarty {
    function Guestbook_Smarty() {
        $this->template_dir = 'templates/'.SKIN_NAME.'/post/';
        $this->compile_dir = 'templates/'.SKIN_NAME.'/post/compile/';
        $this->config_dir = 'templates/'.SKIN_NAME.'/post/config/';
        $this->cache_dir = 'templates/'.SKIN_NAME.'/post/cache/';
    }
}


class Post
{
	// database object
	var $sql = null;
	// smarty template object
	var $tpl = null;
	// error messages
	var $error = null;

	function Post()
	{
		$this->sql =& new SBBS_SQL;
		$this->tpl =& new SmartyPost;
	}

/*
	`id` INT NOT NULL AUTO_INCREMENT,

	`uid` INT NOT NULL DEFAULT 0,
	`bid` INT NOT NULL DEFAULT 0,
	`category` INT NOT NULL DEFAULT 0,
	`dateReg` INT NOT NULL DEFAULT 0,
	`dateMod` INT NOT NULL DEFAULT 0,
	`dateDlt` INT NOT NULL DEFAULT 0,
	`accessed` INT NOT NULL DEFAULT 0,
	`attributes` INT NOT NULL DEFAULT 0,
	`extended` INT NOT NULL DEFAULT 0,

	`title` VARCHAR(255) DEFAULT NULL,
	`content` TEXT DEFAULT NULL,

*/
	function addEntry($vars)
	{
		if($vars[bid])
		{
			$query = sprintf("INSERT INTO sbbs_posts (`uid`,`bid`,`category`,`dateReg`,`attributes`,`extended`,`title`,`content`) VALUES('%d','%d','%d','%d','%d','%d','%s','%s');", $vars[uid], $vars[bid], $vars[category], $vars[dateReg], $vars[attributes], $vars[extended], $vars[title], $vars[content]);

			$this->sql->query($query);
		}
	}
}

$post = new Post();

$vars[bid] = 1;
$vars[uid] = 1;
$vars[dateReg] = time();
$vars[title] = addslashes("TEST'");
$vars[content] = addslashes("Here is content'");

$post->addEntry($vars);

printf("<pre>");

printf("<a href='post.php?action=%d'>list</a>\n", POST_LIST);
printf("<a href='post.php?action=%d'>view</a>\n", POST_VIEW);
printf("<a href='post.php?action=%d'>register</a>\n", POST_REGISTER_FORM);

printf("</pre>");

?>