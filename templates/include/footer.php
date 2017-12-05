      <div class="sidebar2">
       <div class="box_right">
      <form role="search" method="post" id="searchform" action="<?php echo ".?action=search" ?>">
                    <label id="search"><b>Enter Your Search Keyword here:</b></label> 
					<input name="searchkeyword" class="search_input" type="text">
					<input id="button1" value="Search" name="search" type="submit">
	  </form>  
    </div>
    <p>&nbsp;</p>
    <div id="subscribe"><center><b>Subscribe to My Newsletter</b></center></div>
     <div id="subscribelayer">
     <form class="bl_form input" action="" method="post">
     <?php 
   if(!empty($success)){
			   echo '<p style="color:#F00">'.$success.'</p>';
			 }
   if(!empty($emessage)){
			   echo '<p style="color:#F00">'.$emessage.'</p>';
			 }	
   if(!empty($nmessage)){
			   echo '<p style="color:#F00">'.$nmessage.'</p>';
			 }				 	 
   ?>
     Get Free Updates, Post and Losts of Freebies by Subscribing to the Newsletter.
     <div id="e-message">
   <?php 
   if(!empty($emailmessage)){
			   echo $emailmessage;
			 }
   ?>
   </div>
    <input type="text" class="subscribeinput" value="Full Name" name="fullname" maxlength="200" />
    <input type="email" class="subscribeinput" value="Email Address" name="email" maxlength="100"/>
    <input type="submit" value="subscribe" id="subscribebut" name="subscribe" />
   </form>
   </div>
    <div class="ads">
    <img src="images/111134-1339689433.png">
    </div>
     </div><!-- end .sidebar2 -->

      <div class="footer">
        <center>Widget News &copy; 2014. All rights reserved. <a href="admin.php">Site Admin</a></center>
      </div>
    </div>
  </body>
</html>
<?php 
if(isset($connection)){
	    mysql_close($connection);
}
?>
