<?php require "include/user_login.php"; ?>
<?php include "include/header.php"; ?>
<ul class="nav">
<?php
$menu_ok = get_all_nav();
while($nav = mysql_fetch_array($menu_ok)){
echo"<a href=\".?action=navmenu&amp;subjid=".urlencode($nav['id'])."\"><li>".htmlspecialchars( $nav['menuName'] )."</li></a>";
}
?>  
 </ul>
</div><!--sidebar1 closed -->
 <div class="content">
  <div id="storyplatform">
    <?php  
	if($page){	
	?>
      <h2 id="topic"><?php echo htmlspecialchars( $page['title'] )?></h2>
     <?php echo htmlspecialchars( $page['summary'] )."."?>
     <br />
     <?php
           $imagepath = imageSrc().$page['articleImage'];
			echo "<div id=\"articleimage\"><img src=\"".$imagepath."\"></div>"; 
	?>
    <br />
     <?php echo $page['content']?>
      <p class="pubDate">Published on <?php echo date('j F Y', $page['publicationDate'])?></p>
	  <?php  $category_ok = getCatById( $page['categoryId'] );
	         $category= mysql_fetch_array($category_ok);
	          if ( $category ) { ?>
        in <a href="./?action=archive&amp;categoryid=<?php echo $category['id']?>"><?php echo htmlspecialchars( $category['name'] ) ?>
        </a>
  <?php } ?>
  <?php } ?>
      <p><a href="./">Return to Homepage</a></p>
  </div>
  
  <div id="commentlayer">
  <?php
if(isset($_SESSION['useridentity']))
  { 
    echo "<div id=\"notification\">You are logged in <span>" .$_SESSION["useridentity"]. "</span> ! You can now post comments. OR 
	      <a href=\".?action=logout\">Log Out</a><br />You may also want to <a href=\".?action=profilelogin\">view your profile</a></div><br />";
	   if(!empty($cmessage)){
		     echo  $cmessage;
		   }
	?>
   <div id="commentzone">
	      <div id="user">
		  <img src="images/user.gif">
		  </div>
	      <form action="" method="post">
          <br />
	      <textarea name="com_content" id="com_box">
		  </textarea>
		  <input type="submit" name="postcomment" value="Post Comment" id="button3">
	      </form>
	     </div>
 <?php	
 }else {
	   ?>
	    Please Log in to post a comment OR <?php echo "<a href=\".?action=signup\">";?>Create an account</a> in less than a minute <br />
		 <div id="error">
		 <?php if(!empty($message)){echo $message;} ?>
		</div> 
		 <form action="" method="POST" id="logform"> <br />
		 <label>Username:</label>
		       <input type="text" name="username" class="forminput" placeholder="username">
			   <br /> 
			   <br />  
		       <label>Password:</label>
			   <input type="password" name="password" class="forminput" placeholder="*********">
			   <br />
			   <input type="submit" name="login" value="Log In" id="login">
		</form>	   
 	
   <p>&nbsp;</p>
<?php }
 $com_ok = get_article_comments((int)$_GET["articleid"]); 
  while($posts = mysql_fetch_array($com_ok)){
	     	echo "<div class=\"pointer\"></div>";
			echo "<div class=\"avatar\"><img src=\"".AV_UPLOAD_PATH.$posts['avatar']."\"></div>";
			echo "<div id=\"posts\">";
			echo "<div class=\"post-by\">";
			echo htmlspecialchars($posts['commentBy']);
			echo "</div>";
			echo "<div class=\"post-date\">";
			echo "<p>".date('j F Y', $posts['commentDate'])."</p>";
			echo "</div>";
			echo "<div class=\"post-content\">".htmlspecialchars($posts['commentContent'])."</div>";
			echo "</div>";	  	
		}	
if(mysql_num_rows($com_ok)==0){
	   echo "<p><center><h4 style=\"color:#F36\">No comments yet, tell us what's on your mind</h4></center></p>";
	  }
?>
  
  </div>
  <!--commentlayer-->
  
 </div>
<?php include "include/footer.php"; ?>