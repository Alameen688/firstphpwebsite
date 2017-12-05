<?php
    if(isset($_POST['editcategory'])){
		 if ( !$category = getCatById( (int)$_POST['categoryId'] ) ) {
                 header( "Location: admin.php?action=listCategories&error=categoryNotFound" );
                 return;
		 }
	
		 $id = mysql_prep((int)$_GET['categoryId']);
         $name = mysql_prep($_POST['name']);
	     $description = mysql_prep($_POST['description']);
		 
  /**
  * Updates the current Category object in the database.
  */
	    $sql = "UPDATE categories SET 
		        name = '{$name}', 
				description = '{$description}'
		        WHERE id = $id";
				
		 $result = mysql_query($sql);
			       confirm_query($result);	
		
		if(mysql_affected_rows() == 1){
				   //success
				   header( "Location: admin.php?action=listCategories&status=changesSaved" );
				   }
			   else{
					//failed
					echo "The Category Update failed";
					echo "<br />". mysql_error();
					}  
		   			
	}
	elseif ( isset( $_POST['cancel'] ) ) {

    // User has cancelled their edits: return to the category list
   header( "Location: admin.php?action=listCategories" );
  }
	
?>
<?php include "templates/include/header.php" ?>
<?php include "templates/admin/include/header.php" ?>

      <h1><?php echo $pageTitle?></h1>

      <form action="" method="post">
        <input type="hidden" name="categoryId" value="<?php echo $categorytoedit['id'] ?>"/>

<?php if ( isset( $errorMessage ) ) { ?>
        <div class="errorMessage"><?php echo $errorMessage ?></div>
<?php } ?>
<?php
     $catresult = getCatById((int)$_GET['categoryId']);
	 $categorytoedit = mysql_fetch_array($catresult);
?>	 
        <ul>

          <li>
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" placeholder="Name of the category" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $categorytoedit['name'])?>" />
          </li>

          <li>
            <label for="description">Description</label>
            <textarea name="description" id="description" placeholder="Brief description of the category" required maxlength="1000" style="height: 5em;"><?php echo htmlspecialchars( $categorytoedit['description'] )?></textarea>
          </li>

        </ul>

        <div class="buttons">
          <input type="submit" name="editcategory" value="Save Changes" />
          <input type="submit" formnovalidate name="cancel" value="Cancel" />
        </div>

      </form>

<?php if ( $categorytoedit['id']) { ?>
      <p><a href="admin.php?action=deleteCategory&amp;categoryId=<?php echo  $categorytoedit['id'] ?>" onclick="return confirm('Delete This Category?')">Delete This Category</a></p>
<?php } ?>

<?php include "templates/include/footer.php" ?>

