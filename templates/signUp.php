<?php
if(isset($_POST['username'])){
$usernamevalue = $_POST['username'];
}
if(isset($_POST['email'])){
$emailvalue = $_POST['email'];
}

?>
<?php include "include/signuprocess.php" ?>
<?php include "include/header.php" ?>
    <ul class="nav">
    <?php
      $menu_ok = get_all_nav();
      while($nav = mysql_fetch_array($menu_ok)){
      echo"<li><a href=\".?action=navmenu&amp;subjid=".urlencode($nav['id'])."\">".htmlspecialchars( $nav['menuName'] )."</a></li>";
     }
?>  
      </ul>
    <!-- end .sidebar1 --></div>
  <div class="content">
  <div id="userform"> 
  <form enctype="multipart/form-data" method="post" action=""  id="newuserform">
   <?php 
   if(!empty($message)){
	         echo "<p class=\"message\">" .$message. "</p>";   
			 }  
   ?>
       <h1 id="caption" style="color:">Sign Up Form </h1> 	
       <label>Username:</label>
       <input id="u-name" type="text" name="username" class="f_input" placeholder="username" 
       value="<?php if(!empty($usernamevalue)){echo $usernamevalue; } else{ echo "username";}?>"/>
       <?php if(!empty($umessage)){echo "<div style=\"color:#09f\">".$umessage ."</div>"; } ?>
       <label>Password:</label>
       <input id="password" type="password" name="password" class="f_input" placeholder="*********" />
       <?php if(!empty($pmessage)){echo "<div style=\"color:#09f\">".$pmessage ."</div>" ; } ?>
       <label>Confirm Password:</label>
       <input id="password" type="password" name="confirmpassword" class="f_input" placeholder="*********" />
       <?php if(!empty($pcmessage)){echo "<div style=\"color:#09f\">".$pcmessage ."</div>" ; } ?>
       <label>Email Address<span class="note"> (Your email will not be displayed to the public)</span> :</label>
       <?php if(!empty($emessage)){echo "<div style=\"color:#09f\">".$emessage ."</div>" ; } ?>
       <input id="subject" type="email" name="email" class="f_input" placeholder="youraddress@domain.com" 
       value="<?php if(!empty($emailvalue)){echo $emailvalue; } else{ echo "youraddress@domain.com";}?>"/>
       
       <input type="submit" name= "signup" value="Sign Up" class="sign-up"/>
  </form>
  </div>
    <!-- end .content --></div>
<?php include "include/footer.php" ;?>