<?
// 나는 자랑스런 모니터 앞에
// 조국과 민족의 무궁한 영광을 위하여
// 몸과 마음을 바쳐 키보드를 칠것을 굳게 다짐합니다.

///////////////////////////////////////////////////////////////////////////////
// Global variables
//
//$env[appPath] = "/home1/vincent/public_html/quiz/";
if(!$env[appPath])
	$env[appPath] = "/home/superwtk/public_html/dev/SBBS2.0/";

// DEBUG
define("SKIN_NAME", "default");
define("SKIN_PATH", "templates/".SKIN_NAME);

//header("Content-type: text/html;charset=utf-8");


///////////////////////////////////////////////////////////////////////////////
// Preload header files

// set path to Smarty directory *nix style
//define('SMARTY_DIR','/usr/local/lib/php/Smarty/libs/');

// path to Smarty windows style
define('SMARTY_DIR', $env[appPath].'Smarty/libs/');

// Smarty
require_once(SMARTY_DIR.'Smarty.class.php');

///////////////////////////////////////////////////////////////////////////////
// Session
//
session_cache_limiter("private, must-revalidate");
session_save_path($env[appPath]."sessions");
session_start();


///////////////////////////////////////////////////////////////////////////////
// Page-code definitions
//
define("POST_LIST",				0x00004001);
define("POST_VIEW",				0x00004002);
define("POST_REGISTER_FORM",	0x00004011);
define("POST_REGISTER_QUERY",	0x00004012);
define("POST_REGISTER_COMPLETE",0x00004013);
define("POST_MODIFY_FORM",		0x00004021);
define("POST_MODIFY_QUERY",		0x00004022);
define("POST_MODIFY_COMPLETE",	0x00004023);
define("POST_DELETE_FORM",		0x00004031);
define("POST_DELETE_QUERY",		0x00004032);
define("POST_DELETE_COMPLETE",	0x00004033);

define("USER_LOGIN_FORM",		0x00002001);
define("USER_LOGIN_QUERY",		0x00002002);
define("USER_LOGIN_COMPLETE",	0x00002003);
define("USER_LOGOUT_FORM",		0x00002011);
define("USER_LOGOUT_QUERY",		0x00002012);
define("USER_LOGOUT_COMPLETE",	0x00002013);

define("USER_LIST",				0x00002101);
define("USER_VIEW",				0x00002102);
define("USER_REGISTER_FORM",	0x00002111);
define("USER_REGISTER_QUERY",	0x00002112);
define("USER_REGISTER_COMPLETE",0x00002113);
define("USER_MODIFY_FORM",		0x00002121);
define("USER_MODIFY_QUERY",		0x00002122);
define("USER_MODIFY_COMPLETE",	0x00002123);
define("USER_DELETE_FORM",		0x00002131);
define("USER_DELETE_QUERY",		0x00002132);
define("USER_DELETE_COMPLETE",	0x00002133);

/*
define("ADMIN_MAINPAGE",			0x00000001);
define("ADMIN_POST_LIST",			0x00000011);
define("ADMIN_POST_VIEW",			0x00000012);
define("ADMIN_POST_REGISTER_FORM",	0x00000013);
define("ADMIN_POST_REGISTER_QUERY",	0x00000014);
define("ADMIN_POST_MODIFY_FORM",	0x00000015);
define("ADMIN_POST_MODIFY_QUERY",	0x00000016);
define("ADMIN_POST_DELETE_FORM",	0x00000017);
define("ADMIN_POST_DELETE_QUERY",	0x00000018);
define("ADMIN_USER_LIST",			0x00000021);
define("ADMIN_USER_VIEW",			0x00000022);
define("ADMIN_USER_REGISTER_FORM",	0x00000023);
define("ADMIN_USER_REIGSTER_QUERY",	0x00000024);
define("ADMIN_USER_MODIFY_FORM",	0x00000025);
define("ADMIN_USER_MODIFY_QUERY",	0x00000026);
define("ADMIN_USER_DELETE_FORM",	0x00000027);
define("ADMIN_USER_DELETE_QUERY",	0000000028);
*/

///////////////////////////////////////////////////////////////////////////////
// Classes

require_once("classes/SBBS.php");
$app = new SBBS();

require_once("classes/SQL.php");
require_once("database.php"); // database configuration file
$sql = new SBBS_SQL();

require_once("classes/Pager.php");

require_once("classes/Entry.php");
require_once("classes/EntryPage.php");

require_once("classes/Post.php");
require_once("classes/PostExtended.php");
require_once("classes/PostPage.php");

require_once("classes/User.php");
require_once("classes/UserExtended.php");
require_once("classes/UserPage.php");

///////////////////////////////////////////////////////////////////////////////
// Functions
//

function messageBox($message, $fatal=true) {
	echo $message;

	if($fatal == true)
		exit;
}
?>