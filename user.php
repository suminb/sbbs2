<?
include "core.php";

$action['loginForm'] = USER_LOGIN_FORM;
$action['loginComplete'] = USER_LOGIN_COMPLETE;
$action['logoutForm'] = USER_LOGOUT_FORM;
$action['logoutComplete'] = USER_LOGOUT_COMPLETE;

$action['list'] = USER_LIST;
$action['view'] = USER_VIEW;
$action['registerForm'] = USER_REGISTER_FORM;
$action['registerQuery'] = USER_REGISTER_QUERY;
$action['registerComplete'] = USER_REGISTER_COMPLETE;
$action['modifyForm'] = USER_MODIFY_FORM;
$action['modifyQuery'] = USER_MODIFY_QUERY;
$action['modifyComplete'] = USER_MODIFY_COMPLETE;
$action['deleteForm'] = USER_DELETE_FORM;
$action['deleteQuery'] = USER_DELETE_QUERY;
$action['deleteComplete'] = USER_DELETE_COMPLETE;


$action = SBBS::setAction($_GET[action], USER_LOGIN_FORM);
switch($action)
{
case USER_LIST:
	$userpage->displayUserList();
	break;

case USER_VIEW:
	$userPage->displayUser();
	break;

case USER_LOGIN_FORM:
	$userPage->displayUserLoginForm();
	break;

case USER_LOGIN_QUERY:
	break;

case USER_LOGIN_COMPLETE:
	$userPage->displayUserLoginComplete();
	break;

case USER_LOGOUT_FORM:
	$userPage->displayUserLogoutForm();
	break;

case USER_LOGOUT_QUERY:
	break;

case USER_LOGOUT_COMPLETE:
	$userPage->displayUserLogoutComplete();
	break;

case USER_REGISTER_FORM:
	$userPage->displayUserRegisterForm();
	break;

case USER_REGISTER_QUERY:
	break;

case USER_REGISTER_COMPLETE:
	$userPage->displayUserRegisterComplete();
	break;

case USER_MODIFY_FORM:
	$userPage->displayUserModifyForm();
	break;

case USER_MODIFY_QUERY:
	break;

case USER_MODIFY_COMPLETE:
	$userPage->displayUserModifyComplete();
	break;

case USER_DELETE_FORM:
	$userPage->displayUserDeleteForm();
	break;

case USER_DELETE_QUERY:
	break;

case USER_DELETE_COMPLETE:
	$userPage->displayUserDeleteComplete();
	break;
}

?>