<?php
 if ( isset( $_POST['createarticle'] ) ) {
   if(isset($_POST['title']))
	  {
		//the user name exists
		
		/*if(!ctype_alnum($_POST['title']))
		{
			$tmessage = 'The title can only contain letters and digits.';
		}*/
		if(strlen($_POST['title']) > 100)
		{
			$tmessage = 'The title cannot be longer than 100 characters.';
			
		}
		if(empty($_POST['title'])){
			$tmessage = 'The title field must not be empty.';
			}
	}
	if(isset($_POST['summary']))
	{
		//the user name exists
		
		/*if(!ctype_alnum($_POST['summary']))
		{
			$smessage = 'The summary can only contain letters and digits.';
		}*/
		if(strlen($_POST['summary']) > 1000)
		{
			$smessage = 'The summary cannot be longer than 1000 characters.';
			
		}
		if(empty($_POST['summary'])){
			$smessage = 'The summary field must not be empty.';
			}
	}
	if(isset($_POST['content']))
	{
		//the user name exists
		/*if(!ctype_alnum($_POST['content']))
		{
			$cmessage = 'The content can only contain letters and digits.';
		}*/
		if(strlen($_POST['content']) > 100000)
		{
			$cmessage = 'The content cannot be longer than 100000 characters.';
			
		}
		if(empty($_POST['content'])){
			$cmessage = 'The content field must not be empty.';
			}
	}
	if ( isset($_POST['publicationDate']) ){
      
	  $publicationDateset = explode ( '-', $_POST['publicationDate']);

      if ( count($publicationDateset) == 3 ) {
        list ( $y, $m, $d ) = $publicationDateset;
        $publicationDateset = mktime ( 0, 0, 0, $m, $d, $y );
	  if(empty($_POST['publicationDate'])){
			$pmessage = 'The publication date field must not be empty.';
			}
	  }
	}
	if(isset($_POST['categoryId']))
	{
		
		if($_POST['categoryId']==0){
			$catmessage = 'Please select a category for the article.';
			}
	}
	
	 if(empty($_FILES['articleimage']['name'])){
		  $imgmessage = 'Please select an image for the article..';
	
		 }
	 $avatar_size = $_FILES['articleimage']['size'];
	 if($avatar_size < 0 || $avatar_size >= 300000){
		 $imgmessage = "File size must not be more than" .(AV_MAXFILESIZE/1024). "kb in size";
		
		 }
	if ( isset( $_FILES['articleimage'] ) ) storeUploadedArticleImage( $_FILES['articleimage'] );	
	
	$imageExtension = strtolower( strrchr( $_FILES['articleimage']['name'], '.' ) ); 
	$categoryId = mysql_prep((int)$_POST['categoryId']);
	$title = mysql_prep($_POST['title']);
	$summary =  mysql_prep($_POST['summary']);
    $content = mysql_prep($_POST['content']);
	$articleImage = mysql_prep($title.$imageExtension);
    // User has posted the article edit form: save the new article
    
	if(empty($tmessage) && empty($smessage) && empty($cmessage) && empty($pmessage) && empty($catmessage) && empty($imgmessage)){
		 
             $sql = "INSERT INTO articles ( publicationDate, categoryId, title, summary, content, articleImage ) 
			         VALUES ( FROM_UNIXTIME($publicationDateset ), {$categoryId}, '{$title}', '{$summary}', '{$content}', '{$articleImage}' )";
                      $result = mysql_query($sql);
					  if($result){header( "Location: admin.php?status=changesSaved" );
					  }
					  else{echo"failed".mysql_error();}
	
  } elseif ( isset( $_POST['cancel'] ) ) {

    // User has cancelled their edits: return to the article list
    header( "Location: admin.php" );
  }
 }
else{
	  $title = "";
	  $summary = "";
	  $content = "";
	  $publicationDate ="";
	  
	} 
	/*$sql2 =  "INSERT INTO images ( imageName, aId ) 
			         VALUES (  '{$imageName}',{$aId} )";
					 $result2 = mysql_query($sql);
					  if($result2){header( "Location: admin.php?status=changesSaved" );
					  }
					  else{echo"failed".mysql_error();}
					  */
?>
