<?php
require( "config.php" );
require_once'includes/session.php'; 
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";


switch ( $action ) {
  case 'archive':
    archive();
    break;
  case 'viewarticle':
    viewarticle();
    break;
  case 'navmenu':
    navmenu();
    break;	
  case 'signup':
    signup();
	break;	
  case 'profilelogin':
    profilelogin();
	break;
  case 'changeavatar':
	changeavatar();
	break;
  case 'search':
	search();
	break;	
  case 'logout':
    logout();
    break;			
  default:
    homepage();
}

function archive() {
  $categoryId = ( isset( $_GET['categoryid'] ) && $_GET['categoryid'] ) ? (int)$_GET['categoryid'] : null;
  $catById = getCatById( $categoryId );
  $category = mysql_fetch_array($catById);
  $pageHeading = $category['name'];
  $pageTitle = $pageHeading . " | Let Us Learn It";
  include_once "templates/include/emailsubscribers.php";
	 require( TEMPLATE_PATH . "/archive.php" );
}
function viewarticle() {
  if ( !isset($_GET["articleid"]) || !$_GET["articleid"] ) {
    homepage();
    return;
  }
  $page_ok = getById( (int)$_GET["articleid"] );
  $page = mysql_fetch_array($page_ok);
  $pageTitle = $page['title'] . " | Widget News";
  include_once "templates/include/emailsubscribers.php";
  require( TEMPLATE_PATH . "/viewArticle.php" );
}
function homepage() {
$pageTitle = "Let Us Learn It";
$article_ok = getList( HOMEPAGE_NUM_ARTICLES );	
include_once "templates/include/emailsubscribers.php";
require( TEMPLATE_PATH . "/homepage.php" );
}

function navmenu() {
  if ( !isset($_GET["subjid"]) || !$_GET["subjid"] || ($_GET["subjid"]==1) ) {
    homepage();
    return;
  }
  $nav_ok = getMenuById( (int)$_GET["subjid"] );
  $navresult = mysql_fetch_array($nav_ok);
   $pageTitle = $navresult['menuName'] . " | Let Us Learn It";
   include_once "templates/include/emailsubscribers.php";
  require( TEMPLATE_PATH . "/navMenu.php" );
}
function signup() {
	  $pageTitle = "Sign Up form | Let Us Learn It";
	  include_once "templates/include/emailsubscribers.php";	
	   require( TEMPLATE_PATH . "/signUp.php" );
	}
function profilelogin() {
	  $pageTitle = "User Profile | Let Us Learn It";
	  if(!empty($_GET['success'])){
	    if($_GET['success']=="true"){
			$signupmessage ="Thank you <span id=\"newuser\">".$_REQUEST['user']."</span> for signing up for an account.<b></b><br />";
			$signupmessage .= "Login to view and edit your profile including your avatar(display picture)";
		}
		else{$signupmessage="";}
    }
	  include_once "templates/include/emailsubscribers.php";	
	   require( TEMPLATE_PATH . "/profileLogIn.php" );
	}
function changeavatar() {
	  $pageTitle = "User avatar edit | Let Us Learn It";
	  include_once "templates/include/emailsubscribers.php";	
	   require( TEMPLATE_PATH . "/profileEdit.php" );
	}
function search() {
	  $pageTitle = "Search Result | Let Us Learn It";
	  require(TEMPLATE_PATH."/searchpage.php");
	}	
function logout() {
  unset( $_SESSION['useridentity'] );
  session_destroy();
  header( "Location: index.php" );
}		
?>