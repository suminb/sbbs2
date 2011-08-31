<?
class PostPage extends EntryPage
{
	var $tpl = null;
	// error messages
	var $error = null;
	// post object
	var $post = null;

	var $bid = 0;
	var $board = null;

	function PostPage($table="sbbs_posts")
	{
		$this->table = $table;
		$this->tpl = new Smarty;
	}

	function init($bid)
	{
		$this->bid = $bid;
		$this->board = $this->getBoardInfo($bid);

		// smarty configuration
        $this->tpl->template_dir = 'templates/'.$this->board[skinName].'/post';
        $this->tpl->compile_dir = 'templates/'.$this->board[skinName].'/post/compile';
        $this->tpl->config_dir = 'templates/'.$this->board[skinName].'/post/config';
        $this->tpl->cache_dir = 'templates/'.$this->board[skinName].'/post/cache';	
	}

	///////////////////////////////////////////////////////
	// Section : get/set (board)
	//
	function getBoardInfo($bid)
	{
		global $sql, $app;

		$sql->query("SELECT * FROM sbbs_boards WHERE id='$bid' LIMIT 1", SQL_INIT, SQL_ASSOC);

		if($sql->record[id] == NULL)
			$app->MessageBox("The board does not exist.");
		else
			return $sql->record;
	}


	///////////////////////////////////////////////////////
	// Section : register, modify, delete
	//
	function registerPost()
	{
		global $app, $sql;

		if($_SESSION[uid])
		{
			// for registered user
			$postvars[uid] = $_SESSION[uid];
		}
		else
		{
			// for anonymouse user

			if($_POST[password1]==NULL || $_POST[password2]==NULL)
			{
				$app->messageBox("Please input both of password and password confirmation.");
			}
			else if($_POST[password1] != $_POST[password2])
			{
				$app->messageBox("password and password confirmation are not matched.");
			}

			$uservars[name] = $_POST[name];
			$uservars[email] = $_POST[email];
			$uservars[website] = $_POST[website];
			$uservars[password] = sha1($_POST[password1]);
			$uservars[dateReg] = time();
			$uservars[attributes] = USER_ATTR_ANONYMOUS;

			$user = new User($uservars);

			$userPage = new UserPage();
			$postvars[uid] = $userPage->addEntry($user);

			ob_start();
			$expire = time() + 3600*24*30;
			setcookie("id", $uservars[id], $expire);
			setcookie("name", $uservars[name], $expire);
			setcookie("email", $uservars[email], $expire);
			setcookie("website", $uservars[website], $expire);
		}

		$postvars[bid] = $_POST[bid];
		$postvars[category] = $_POST[category];
		$postvars[dateReg] = time();
		$postvars[ip] = SBBS::ipStrToDgt($_SERVER[REMOTE_ADDR]);

		$postvars[depth] = 0;
		$postvars[parent] = 0;
		$postvars[children] = 0;

		$postvars[attributes] = 0;
		$postvars[extended] = 0;
		$postvars[title] = $_POST[title];
		$postvars[content] = $_POST[content];

		$post = new Post($postvars);
	//	$post->processTitle(POST_INBOUND);
	//	$post->processContent(POST_INBOUND);

		$this->addEntry($post);

		$header = sprintf("Location: ?action=%d&bid=%d", POST_REGISTER_COMPLETE, $_POST[bid]);
		header($header);
	}

	function modifyPost($pid)
	{
		global $app, $sql;

		if($_SESSION[uid] != null)
		{
			// for anonymouse user

			if($_POST[password1]==NULL || $_POST[password2]==NULL)
			{
				$app->messageBox("Please input both of password and password confirmation.");
			}
			else if($_POST[password1] != $_POST[password2])
			{
				$app->messageBox("password and password confirmation are not matched.");
			}

			$uservars[name] = $_POST[name];
			$uservars[email] = $_POST[email];
			$uservars[website] = $_POST[website];
			$uservars[password] = sha1($_POST[password1]);
			$uservars[dateReg] = time();
			$uservars[attributes] = USER_ATTR_ANONYMOUS;

			$user = new User($uservars);

			$userPage = new UserPage();
			$userPage->addEntry($user);

			// THIS IS NOT SAFE !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
			$uservars[id] = mysql_insert_id();
			$postvars[uid] = $uservars[id];

			ob_start();
			$expire = time() + 3600*24*30;
			setcookie("id", $uservars[id], $expire);
			setcookie("name", $uservars[name], $expire);
			setcookie("email", $uservars[email], $expire);
			setcookie("website", $uservars[website], $expire);
		}

		$postvars[bid] = $_POST[bid];
		$postvars[category] = $_POST[category];
		$postvars[dateMod] = time();
		$postvars[ip] = SBBS::ipStrToDgt($_SERVER[REMOTE_ADDR]);

	//	$postvars[depth] = 0;
	//	$postvars[parent] = 0;
	//	$postvars[children] = 0;

		$postvars[attributes] = 0;
		$postvars[extended] = 0;
		$postvars[title] = $_POST[title];
		$postvars[content] = $_POST[content];

		$post = new Post($postvars);
	//	$post->processTitle(POST_INBOUND);
	//	$post->processContent(POST_INBOUND);

		$this->addEntry($post);

		$header = sprintf("Location: ?action=%d&bid=%d", POST_MODIFY_COMPLETE, $_POST[bid]);
		header($header);
	}

	function deletePost($pid)
	{
	}


	///////////////////////////////////////////////////////
	// Section : display
	//
	function displayPostList($bid, $page=1)
	{
		$pager = new Pager();
		$pager->page = $page;
		$pager->posts = $this->getNumOfEntries();
		$pager->query = sprintf("bid=%d&", $bid);

		$vars[bid] = $bid;
		$post = $this->getEntriesVars($vars, $pager->getStartNo(), 15);

		$i = 0;
		$userPage = new UserPage();
		while($post[$i] != NULL)
		{
			$post[$i][user] = $userPage->getEntryVars($post[$i][uid]);
			$i++;
		}

		$this->tpl->assign("post", $post);
		$this->tpl->assign("pager", $pager->get());
		$this->tpl->display("list.tpl");
	}

	function displayPost($pid)
	{
		$post = new Post($this->getEntry($pid));
	//	$post->processTitle(POST_OUTBOUND);
	//	$post->processContent(POST_OUTBOUND);


		$userPage = new UserPage();
		$user = new User($userPage->getEntry($post->uid));
	//	$user = new User(UserPage::getEntry($post->uid));


		$uservars = get_object_vars($user);
		$postvars = get_object_vars($post);
		$postvars[user] = $uservars;

		// count the number of access
		if($_COOKIE[accessed][$pid] == NULL)
		{
			$post->accessed++;
			$this->modifyEntryVars(array(
				"id" => $post->id,
				"accessed" => $post->accessed
			));
			ob_start();
			setcookie("accessed[$pid]", $post->accessed, time()+3600*24);
		}

		$this->tpl->assign("post", $postvars);
		$this->tpl->display("view.tpl");
	}

	function displayPostRegisterForm()
	{
		$form[name] = "register";
		$form[method] = "post";
		$form[action] = "?action=".POST_REGISTER_QUERY;
		$this->tpl->assign("form", $form);

		$this->tpl->assign("cookie", $_COOKIE);
		$this->tpl->display("register.form.tpl");
	}

	function displayPostRegisterComplete()
	{
		$this->tpl->display("register.complete.tpl");
	}

	function displayPostModifyForm($pid)
	{
		$form[name] = "modify";
		$form[method] = "post";
		$form[action] = "?action=".POST_MODIFY_QUERY;
		$this->tpl->assign("form", $form);

		$post = $this->getEntryVars($pid);
		$this->tpl->assign("post", $post);

		$this->tpl->assign("cookie", $_COOKIE);
		$this->tpl->display("modify.form.tpl");
	}

	function displayPostModifyComplete()
	{
		$this->tpl->display("modify.complete.tpl");
	}

	function displayPostDeleteForm($pid)
	{
		$form[name] = "delete";
		$form[method] = "post";
		$form[action] = "?action=".POST_DELETE_QUERY;
		$this->tpl->assign("form", $form);

		$post = $this->getEntryVars($pid);
		$this->tpl->assign("post", $post);
		$this->tpl->display("delete.form.tpl");
	}

	function displayPostDeleteComplete()
	{
		$this->tpl->display("delete.complete.tpl");
	}
}

?>