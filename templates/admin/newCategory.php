<?php
 if ( isset( $_POST['createcategory'] ) ) {
   if(isset($_POST['name']))
	  {
		
		if(strlen($_POST['name']) > 225)
		{
			$nmessage = 'The name cannot be longer than 225 characters.';
			
		}
		if(empty($_POST['name'])){
			$nmessage = 'The name field must not be empty.';
			}
	}
	if(isset($_POST['description']))
	{
		//the user name exists
		/*if(!ctype_alnum($_POST['content']))
		{
			$cmessage = 'The content can only contain letters and digits.';
		}*/
		if(strlen($_POST['description']) > 1000)
		{
			$dmessage = 'The description cannot be longer than 1000 characters.';
			
		}
		if(empty($_POST['description'])){
			$dmessage = 'The description field must not be empty.';
			}
	}
	
	 $name = mysql_prep($_POST['name']);
	 $description = mysql_prep($_POST['description']);
    // User has posted the article edit form: save the new article
    
	if( empty($nmessage) && empty($dmessage) ){
		 
             $sql = "INSERT INTO categories ( name, description ) VALUES ( '{$name}', '{$description}' )";
                     
					  $cat_set = mysql_query($sql);
					 
					  if($cat_set){
						  header( "Location: admin.php?action=listCategories&status=changesSaved"  );
					  }
					  else{
						  echo "Category creation failed".mysql_error();
						  }
	
  } elseif ( isset( $_POST['cancel'] ) ) {

    // User has cancelled their edits: return to the article list
    // User has cancelled their edits: return to the category list
    header( "Location: admin.php?action=listCategories" );
  }
 }
else{
	  $name = "";
	  $summary = "";	  
	} 
?>
<?php include "templates/include/header.php" ?>
<?php include "templates/admin/include/header.php" ?>

      <h1><?php echo $pageTitle?></h1>

      <form action="admin.php?action=<?php echo $formAction ?>" method="post">

<?php if ( isset( $errorMessage ) ) { ?>
        <div class="errorMessage"><?php echo $errorMessage ?></div>
<?php }?>

        <ul>

          <li>
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" placeholder="Name of the category" required autofocus maxlength="255" />
          </li>

          <li>
            <label for="description">Description</label>
            <textarea name="description" id="description" placeholder="Brief description of the category" required maxlength="1000" style="height: 5em;"></textarea>
          </li>

        </ul>

        <div class="buttons">
          <input type="submit" name="createcategory" value="Save Changes" />
          <input type="submit" formnovalidate name="cancel" value="Cancel" />
        </div>

      </form>

<?php include "templates/include/footer.php" ?>

