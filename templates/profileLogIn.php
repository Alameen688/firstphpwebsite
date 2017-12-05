<?php require_once'includes/session.php'; ?>
<?php require "include/user_login.php"; ?>
<?php include "include/header.php"; ?>
<ul class="nav">
<?php
$menu_ok = get_all_nav();
while($nav = mysql_fetch_array($menu_ok)){
echo"<li><a href=\".?action=navmenu&amp;subjid=".urlencode($nav['id'])."\">".htmlspecialchars( $nav['menuName'] )."</a></li>";
}
?>  
 </ul>
</div><!--sidebar1 closed -->
 <div class="content">
  <div id="storyplatform">
    <?php  
	if(isset($_SESSION['useridentity'])){	
	$user_comment = user_commented_on($_SESSION['useridentity']);
	$user_com_ok = mysql_num_rows($user_comment);	
	 $user_prof_ok = user_profile($_SESSION['useridentity']);
	 while($user = mysql_fetch_array($user_prof_ok)){ 
	          echo "Your Avatar:<br /> <img src=\"".AV_UPLOAD_PATH.$user['avatar']."\"><br />"; 
			  echo "<a href=\".?action=changeavatar\">Change your avatar</a>"; 
			  echo "<br />"; 
              echo "Your Username: ".$user['userName'];
			  echo "<br />";
			  echo "Number of articles you have commented on: ".$user_com_ok;
	 }
   	?>
   <?php
	}
   else{
  ?>
  <center><h2 id="topic">Login to view and edit your profile</h2></center>
  <form action="" method="POST" id="logform"> <br />
     <?php 
   if(!empty($signupmessage)){
	         echo "<p class=\"message\">" .$signupmessage. "</p>";   
			 }  
   ?>
  <?php if(!empty($message)){echo "<div style=\"color:#09f\">".$message ."</div>"; } ?> 
		 <label>Username:</label>
		       <input type="text" name="username" class="forminput" placeholder="username">
			   <br />
               <?php if(!empty($umessage)){echo "<div style=\"color:#09f\">".$umessage ."</div>"; } ?> 
			   <br />  
		       <label>Password:</label>
			   <input type="password" name="password" class="forminput" placeholder="*********">
               <?php if(!empty($pmessage)){echo "<div style=\"color:#09f\">".$pmessage ."</div>" ; } ?>
			   <br />
			   <input type="submit" name="login" value="Log In" id="login">
		</form>	 
  <?php } ?>        
  </div>
 </div>
  <!--commentlayer-->
  </div>
<?php include "include/footer.php"; ?>  