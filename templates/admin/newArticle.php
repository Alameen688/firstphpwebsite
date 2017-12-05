<?php require_once "include/newarticleformval.php" ?>
<?php include "templates/include/header.php" ?>
 <script>

      // Prevents file upload hangs in Mac Safari
      // Inspired by http://airbladesoftware.com/notes/note-to-self-prevent-uploads-hanging-in-safari

      function closeKeepAlive() {
        if ( /AppleWebKit|MSIE/.test( navigator.userAgent) ) {
          var xhr = new XMLHttpRequest();
          xhr.open( "GET", "/ping/close", false );
          xhr.send();
        }
      }

      </script>
<ul class="nav">
 <?php
$menu_ok = get_all_nav();
while($nav = mysql_fetch_array($menu_ok)){
echo"<li><a href=\".?action=navMenu&amp;subjId=".urlencode($nav['id'])."\">".htmlspecialchars( $nav['menuName'] )."</a></li>";
}
?>     
 </ul>
</div><!--sidebar1 closed -->
    <div class="content">
      <div id="adminHeader">
        <h2>Widget News Admin</h2>
        <p>You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. 
        <a href="admin.php?action=logout"?>Log out</a></p>
      </div>

      <center><h2 id="topic"><?php echo $pageTitle ?></h2></center>

  <form action="" method="post"  enctype="multipart/form-data" id="editarticle">
    <ul>

      <li>
         <label for="title">Article Title</label>
         <input type="text" name="title" id="title" placeholder="Name of the article" required autofocus maxlength="255" />
         <?php if(!empty($tmessage)){echo "<div style=\"color:#09f\">".$tmessage ."</div>"; } ?>
      </li>

      <li>
         <label for="summary">Article Summary</label>
               <textarea name="summary" id="summary" placeholder="Brief description of the article" required maxlength="1000" 
               style="height: 5em;"></textarea>
          <?php if(!empty($smessage)){echo "<div style=\"color:#09f\">".$smessage ."</div>"; } ?>
          </li>
          
      <li>
           <label for="content">Article Content</label>
           <textarea name="content" id="content" placeholder="The HTML content of the article" required maxlength="100000" 
            style="height: 30em;"></textarea>
            <?php if(!empty($cmessage)){echo "<div style=\"color:#09f\">".$cmessage ."</div>"; } ?>
          </li>
       
           <li>
            <label for="categoryId">Article Category</label>
            <select name="categoryId">
              <option value="0">(none)</option>
            <?php while( $category_options = mysql_fetch_array($category) ) { ?>
              <option value="<?php echo $category_options['id']?>"><?php echo htmlspecialchars($category_options['name'] )?></option>
            <?php } ?>
            </select>
             <?php if(!empty($catmessage)){echo "<div style=\"color:#09f\">".$catmessage ."</div>"; } ?>
          </li>
           
          <li>
            <label for="publicationDate">Publication Date</label>
            <input type="date" name="publicationDate" id="publicationDate" placeholder="YYYY-MM-DD" required maxlength="10" />
            <?php if(!empty($pmessage)){echo "<div style=\"color:#09f\">".$pmessage ."</div>"; } ?>
          </li>
         
         <!-- //use jvascript to handle the number of input file to be displayed
         <li>
            <label for="image">No of Image</label>
            <select name="noImage">
              <option value="0">(Select the number of image for this article)</option>
              <?php
               for($count=1; $count<=10; $count++)
               {
	             echo "<option value=\"{$count}\">{$count}</option>";
                }
              ?>
            </select>
          </li>
       -->
          <li>
            <label for="image">Article Image</label>
            <input type="file" name="articleimage" id="image" placeholder="Choose an image to upload" maxlength="255" />
            <?php if(!empty($imgmessage)){echo "<div style=\"color:#09f\">".$imgmessage ."</div>"; } ?>
          </li>

        </ul>

        <div class="buttons">
          <input type="submit" name="createarticle" value="Create Article" />
          <input type="submit" formnovalidate name="cancel" value="Cancel" />
        </div>

      </form>

</div>

<?php include "templates/include/footer.php" ?>

