<?php require_once'includes/session.php'; ?>
<?php  
if(isset($_GET['action'])){
	   if($_GET['action'] == "logout"){
       //unset session
       $_SESSION = array();
	   //destroy session
	   session_destroy();
	   }
}
?>