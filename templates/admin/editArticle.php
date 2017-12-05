<?php
    if(isset($_POST['editarticle'])){
		if ( !$article = getById( (int)$_POST['articleId'] ) ) {
         header( "Location: admin.php" );
         return;
        }
			
	if ( isset($_POST['publicationDate']) ){
      
	  $publicationDateset = explode ( '-', $_POST['publicationDate']);

      if ( count($publicationDateset) == 3 ) {
        list ( $y, $m, $d ) = $publicationDateset;
        $publicationDateset = mktime ( 0, 0, 0, $m, $d, $y );
	  }
	}
   if(isset($_POST['title'])){
	   if(strlen($_POST['title']) > 100)
		{
			$tmessage = 'The title cannot be longer than 100 characters.';
			
		}
		if(empty($_POST['title'])){
			$tmessage = 'The title field must not be empty.';
		}
	}
	if(isset($_POST['summary'])){
		if(strlen($_POST['summary']) > 1000){
			$smessage = 'The summary cannot be longer than 1000 characters.';
		}
		if(empty($_POST['summary'])){
			$smessage = 'The summary field must not be empty.';
		}
	}
	if(isset($_POST['content'])){
		if(strlen($_POST['content']) > 100000)
		{
			$cmessage = 'The content cannot be longer than 100000 characters.';	
		}
		if(empty($_POST['content'])){
			$cmessage = 'The content field must not be empty.';
		}
	}
	     if(isset($_POST['categoryId'])){
		      if($_POST['categoryId']==0){
			       $catmessage = 'Please select a category for the article.';
			  }
		 }
		 if(isset($_FILES['articleimage'])){
		  if(!empty($_FILES['articleimage'])){
		          /*store the uploaded image first so that users can see the results immediately*/
				  $fileext = strtolower( strrchr( $_FILES['articleimage']['name'], '.' ) );
			       $filename =  mysql_prep($_POST['title']).$fileext;
	              $id = mysql_prep((int)$_GET['articleId']);
	               $sql = "UPDATE articles SET 
				           articleImage = '{$filename }'
						   WHERE id = $id";
			
		      
			       $file_store = mysql_query($sql);
			       confirm_query($file_store);
	               header("location:.?action=changesSaved");
				      
					/* NOW UPDATE THE FILE NAME IN THE DATABASE this happens faster */    
			       storeUploadedArticleImage( $_FILES['articleimage'] );
	          
		  }
		 }
	 
		 $id = mysql_prep((int)$_GET['articleId']);
		 $categoryId = mysql_prep((int)$_POST['categoryId']);
         $title = mysql_prep($_POST['title']);
	     $summary = mysql_prep($_POST['summary']);
	     $content = mysql_prep($_POST['content']);
		 
	  if(empty($tmessage) && empty($smessage) && empty($cmessage) && empty($catmessage)){	 
	    $sql = "UPDATE articles SET 
		        publicationDate=FROM_UNIXTIME($publicationDateset),
				categoryId = {$categoryId}, 
		        title = '{$title}', 
		        summary = '{$summary}', 
		        content = '{$content}'
		        WHERE id = $id";
				
		 $result = mysql_query($sql);
			       confirm_query($result);	
		
		if(mysql_affected_rows() == 1){
				   //success
				   header( "Location: admin.php?status=changesSaved" );
				   }
			   else{
					//failed
					echo "The Page Update failed";
					echo "<br />". mysql_error();
					}  
		   			
	  }	
		  
	}
	elseif ( isset( $_POST['cancel'] ) ) {

    // User has cancelled their edits: return to the article list
    header( "Location: admin.php" );
  }
	
?>
<?php include "templates/include/header.php" ?>
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

      <form action="" enctype="multipart/form-data" method="post" id="editarticle">
        <input type="hidden" name="articleId" value="<?php echo $articletoedit['id'] ?>"/>

<?php if ( isset( $errorMessage ) ) { ?>
        <div class="errorMessage"><?php echo $errorMessage ?></div>
<?php } ?>
<?php 
      $articleidset = getById( (int)$_GET["articleId"] ); 
      $articletoedit = mysql_fetch_array($articleidset);
	  $category = getCatList();
?>
        <ul>

          <li>
            <label for="title">Article Title</label>
            <input type="text" name="title" id="title" placeholder="Name of the article" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $articletoedit["title"] )?>" />
            <?php if(!empty($tmessage)){echo "<div style=\"color:#09f\">".$tmessage ."</div>"; } ?>
          </li>

          <li>
            <label for="summary">Article Summary</label>
            <textarea name="summary" id="summary" placeholder="Brief description of the article" required maxlength="1000" style="height: 5em;"><?php echo htmlspecialchars( $articletoedit["summary"] )?></textarea>
            <?php if(!empty($smessage)){echo "<div style=\"color:#09f\">".$smessage ."</div>"; } ?>
          </li>

          <li>
            <label for="content">Article Content</label>
            <textarea name="content" id="content" placeholder="The HTML content of the article" required maxlength="100000" style="height: 30em;"><?php echo htmlspecialchars( $articletoedit["content"] )?></textarea>
            <?php if(!empty($cmessage)){echo "<div style=\"color:#09f\">".$cmessage ."</div>"; } ?>
          </li>
 
           <li>
            <label for="categoryId">Article Category</label>
            <select name="categoryId">
              <option value="0"<?php echo !$articletoedit['categoryId'] ? " selected" : ""?>>(none)</option>
            <?php while( $category_options = mysql_fetch_array($category) ) { ?>
              <option value="<?php echo $category_options['id']?>"<?php echo ( $category_options['id'] == $articletoedit['categoryId'] ) ? " selected" : ""?>><?php echo htmlspecialchars($category_options['name'] )?></option>
            <?php } ?>
            </select>
            <?php if(!empty($catmessage)){echo "<div style=\"color:#09f\">".$catmessage ."</div>"; } ?>
          </li>
         
          <li>
            <label for="publicationDate">Publication Date</label>
            <input type="date" name="publicationDate" id="publicationDate" placeholder="YYYY-MM-DD" required maxlength="10" value="<?php echo            $articletoedit['publicationDate'] ? date( "Y-m-d", $articletoedit["publicationDate"] ) : "" ?>" />
          </li>
          
          <?php if ($imagefolder = imageSrc()) {
			  if ($imagelink = $imagefolder.$articletoedit['articleImage']) { 
		  ?>
          <li>
            <label>Current Image</label>
            <img id="articleImage" src="<?php echo $imagelink ?>" alt="Article Image" />
          </li>

          <li>
            <label for="deleteImage">Delete This image</label>
          </li>
          <li>
            <input type="checkbox" name="deleteImage" id="deleteImage" value="yes"/ >
          </li>
          <?php } 
		  }
		  ?>
          <br />
          <li>
            <label for="image">New Image</label>
            <input type="file" name="articleimage" id="image" placeholder="Choose an image to upload" maxlength="255" />
          </li>
         
         
        </ul>

        <div class="buttons">
          <input type="submit" name="editarticle" value="Save Changes" />
          <input type="submit" name="cancel" value="Cancel" />
        </div>
      </form>

<?php if ( $articletoedit ) { ?>
      <p><a href="admin.php?action=deleteArticle&amp;articleId=<?php echo $articletoedit['id'] ?>" onclick="return confirm('Delete This Article?')">Delete This Article</a></p>
<?php } ?>
</div>

<?php include "templates/include/footer.php" ?>

