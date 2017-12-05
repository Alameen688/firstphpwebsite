<?php require "include/user_login.php"; ?>
<?php require_once'include/avatar_action.php'; ?>
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
		$user_prof_ok = user_profile($_SESSION['useridentity']);
	    while($edit = mysql_fetch_array($user_prof_ok)){ 
  ?>
  <form enctype="multipart/form-data" action="" method="post">
  <!-- the max file size input is not set so that the image`s size (i.e $_FILES['avatar']['size'] will be posted for validation.. 
       If it set it will be validated automatically by HTML and no error message will be displayed 
       <input type="hidden" name="MAX_FILE_SIZE" value="153600" />
   -->
  <label for="your Avatar">Your current avatar:</label>
  <br />
  <?php echo "<img src=\"".AV_UPLOAD_PATH.$edit['avatar']."\">" ;?>
  <br />
  <?php if(!empty($amessage)){echo "<span style=\"color:#f00\">".$amessage."</span><br />";}
  else{ echo "<span style=\"color:#f00\">Note: Any file to be uploaded must be in JPEG(.jpg), GIF or PNG format</span>";}
  ?>
  <input type="file" id="avatar" name="avatar" />
  <br />
  <input type="submit" name="changeavatar" value="Upload File">
  <input type="reset" name="cancel" value="Cancel" />
</form>
<?php } } ?>
</div>
 </div>
  <!--commentlayer-->
  </div>
<?php include "templates/include/footer.php"; ?>  