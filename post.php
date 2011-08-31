<?
function stime() {

   list($usec, $sec) = explode(" ",microtime());
   return ((float)$usec + (float)$sec);
}
$pos1 = stime();

include "core.php";

$postPage = new PostPage();


$_post = new Post();
$_post->uid = 1;
$_post->bid = 1;
$_post->title = "테스트는 계속되어야 한다!";
$_post->content = "State the nature of your medical emergency.";

//$postPage->addEntry($_post);



if($_GET[bid])
{
	$postPage->init($_GET[bid]);
}
else if($_GET[pid])
{
	$post =& $postPage->getEntry($_GET[pid]);
	$postPage->init($post->bid);
}
else
{
	$app->messageBox('$bid is not set');
}

//
// board information
//
$board = $postPage->board;
$board[skinPath] = sprintf("templates/%s", $board[skinName]);

$postPage->tpl->assign("board", $board);

//
// action pages (for skin)
//
$action['list'] = POST_LIST;
$action['view'] = POST_VIEW;
$action['registerForm'] = POST_REGISTER_FORM;
$action['registerQuery'] = POST_REGISTER_QUERY;
$action['registerComplete'] = POST_REGISTER_COMPLETE;
$action['modifyForm'] = POST_MODIFY_FORM;
$action['modifyQuery'] = POST_MODIFY_QUERY;
$action['modifyComplete'] = POST_MODIFY_COMPLETE;
$action['deleteForm'] = POST_DELETE_FORM;
$action['deleteQuery'] = POST_DELETE_QUERY;
$action['deleteComplete'] = POST_DELETE_COMPLETE;

$postPage->tpl->assign("action", $action);

///////////////////////////////////////////////////////////////////////////////

$action = SBBS::setAction($_GET[action], POST_LIST);
switch($action)
{
case POST_REGISTER_FORM:
	$postPage->displayPostRegisterForm();
	break;


case POST_REGISTER_QUERY:
	$postPage->registerPost();
	break;


case POST_REGISTER_COMPLETE:
	$postPage->displayPostRegisterComplete();
	break;


case POST_MODIFY_FORM:
	$postPage->displayPostModifyForm($_GET[pid]);
	break;


case POST_MODIFY_QUERY:
	break;


case POST_MODIFY_COMPLETE:
	break;


case POST_DELETE_FORM:
	$postPage->displayPostDeleteForm($_GET[pid]);
	break;


case POST_DELETE_QUERY:
	break;


case POST_DELETE_COMPLETE:
	break;


case POST_VIEW:
	$postPage->displayPost($_GET[pid]);
	break;

case POST_LIST:
default:
	$postPage->displayPostList($_GET[bid], SBBS::getPage());
	break;
}

$pos2 = stime();

printf("<br/><br/>total executed time: %s", $pos2-$pos1);
?>