<?php
   
  /*By Ameen on 29/3/2014 */
function mysql_prep($value){
	       $magic_quotes_active = get_magic_quotes_gpc();
		   $new_enough_php = function_exists("mysql_real_escape_string"); /* i.e if server uses PHP >= v4.3.0 */
		   if($new_enough_php){
			   /* if server uses PHP version  v4.3.0 or higher undo the magic quotes effect so that mysql_real_escape_string can work*/
			   if($magic_quotes_active){
				   $value = stripslashes($value);
				   }
			  $value = mysql_real_escape_string($value);	   
		   }
          else{ /* For PHP version  before v4.3.0 :- If magic quotes aren't already on then  addslashes manually */
		  if(!$magic_quotes_active){
			       $value = addslashes($value);
				  /* If magic quotes are active,  then the slashes already exist*/
			  }
		  }
		  return $value;
}  
function get_all_nav() 
{        global $connection;
     $query = "SELECT * 
	           FROM navigation 
			   ORDER BY position ASC";
	
	$subject_set = mysql_query($query,$connection);
    confirm_query($subject_set);
	return $subject_set;
}



function getMenuById( $subjId )
 {        
   global $connection;
          $query ="SELECT * FROM navigation WHERE id = $subjId LIMIT 1" ;
				  
   $menu_set = mysql_query($query,$connection);
    confirm_query($menu_set);
	
	return $menu_set;
}

function __construct( $data=array() ) {
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
	if ( isset( $data['subjId'] ) ) $this->subjId = (int) $data['subjId'];
    if ( isset( $data['publicationDate'] ) ) $this->publicationDate = (int) $data['publicationDate'];
    if ( isset( $data['title'] ) ) $this->title = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['title'] );
	if ( isset( $data['heading'] ) ) $this->heading = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['heading'] );
    if ( isset( $data['summary'] ) ) $this->summary = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['summary'] );
    if ( isset( $data['content'] ) ) $this->content = $data['content'];
	if ( isset( $data['menuName'] ) ) $this->menuName = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['menuName'] );
  }
  /**
  * Sets the object's properties using the edit form post values in the supplied array
  *
  * @param assoc The form post values
  */

function storeFormValues ( $publicationDate ) {

    // Store all the parameters 
	// NOTe CHECK all parameters WITH preg_replace or preg_  to avoid injection;
    // $this->__construct( $params );

    // Parse and store the publication date
    //if ( isset($params['publicationDate']) ) 
	if ( isset($publicationDate) ){
      
	  $publicationDateset = explode ( '-', $publicationDate);

      if ( count($publicationDateset) == 3 ) {
        list ( $y, $m, $d ) = $publicationDateset;
        $publicationDateset = mktime ( 0, 0, 0, $m, $d, $y );
	  }
	}
	return $publicationDateset;
}


  /**
  * Returns an Article object matching the given article ID
  *
  * @param int The article ID
  * @return Article|false The article object, or false if the record was not found or there was a problem
  */

function getById( $id ) {
    global $connection;
    $sql = "SELECT *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM articles WHERE id = $id";
    $page_set = mysql_query($sql,$connection);
    confirm_query($page_set);
	return $page_set ;
  }

function confirm_query($result_set){
          if(!$result_set){
		  die("Database Connection Failed" .mysql_error());	  
		}
}
  /**
  * Returns all (or a range of) Article objects in the DB
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the articles (default="publicationDate DESC")
  * @return Array|false A two-element array : results => array, a list of Article objects; totalRows => Total number of articles
  */
  /*nots:1000000 is the default value for $numRows*/

function getList( $numRows=1000000, $categoryId=null ) {
    global $connection;
	$categoryClause = $categoryId ? "WHERE categoryId = $categoryId" : "";
    $query = "SELECT articles.id,articles.publicationDate,articles.categoryId,
	          articles.title,articles.summary,articles.content,articles.articleImage,
			  categories.name, 
			  UNIX_TIMESTAMP(publicationDate) AS publicationDate 
	          FROM articles 
			  INNER JOIN categories 
			   ON articles.categoryId = categories.id
			  $categoryClause
              ORDER BY publicationDate DESC LIMIT $numRows";
 	$article_set = mysql_query($query,$connection);
    confirm_query($article_set);
		return $article_set;
	
    }
/*
function getList( $numRows=1000000, $categoryId=null ) {
	 global $connection;
    $query = "SELECT * ,UNIX_TIMESTAMP(publicationDate) AS publicationDate 
	          FROM articles 
              ORDER BY publicationDate DESC LIMIT $numRows";
 	$article_set = mysql_query($query,$connection);
    confirm_query($article_set);
		return $article_set;
}
*/
	
/*function login($user_name , $password){
	     $hashed_password =  sha1($password);
           global $connection;
		   $query= "SELECT id, userName
	           FROM users 
			   WHERE userName = '{$user_name}'
			   AND hashedPassword = '{$hashed_password}'
			   LIMIT 1";
		
		$user_set = mysql_query($query,$connection);
	    confirm_query($user_set);
		 return $user_set;
}
*/
/*SELECT *, UNIX_TIMESTAMP(commentDate) AS commentDate*/
function get_article_comments($aId){
	        global $connection;
  $query2= "SELECT comments.id,comments.commentDate,comments.commentBy,
                   comments.commentContent,comments.aId,
				   users.id,users.userName,users.avatar
	           ,UNIX_TIMESTAMP(comments.commentDate) AS commentDate FROM comments
			   INNER JOIN users 
			   ON comments.commentBy=users.userName 
			   WHERE aId = $aId
			   ORDER BY comments.id DESC ";
			  
	
	$com_set = mysql_query($query2,$connection);
	
	confirm_query($com_set);
	return $com_set;
}
function user_profile($user_session){
	       global $connection;
        $sql= "SELECT *
	           FROM users 
			   WHERE userName = '{$user_session}'
			   LIMIT 1";
		$user_set = mysql_query($sql,$connection);	
		confirm_query($user_set);
		return  $user_set;
	}

function user_commented_on($user_session){
	       global $connection;
        $sql2= "SELECT *
	           FROM comments 
			   WHERE commentBy = '{$user_session}'";
		$user_com_set = mysql_query($sql2,$connection);	
		confirm_query($user_com_set);
		return  $user_com_set;
	}
function storeUploadedImage( $image ){
	if($image['error'] == UPLOAD_ERR_OK){
		
	 deleteImages();
	 
	$imageExtension = strtolower( strrchr( $image['name'], '.' ) );
	
     $tempFilename = trim( $image['tmp_name'] );
	 
   if ( is_uploaded_file ( $tempFilename ) ) {
	     if ( !( move_uploaded_file( $tempFilename,getImagePath() ) ) ){ 
	           $amessage = "Couldn't move uploaded file. ".mysql_error();
	       }
	     if ( !( chmod(getImagePath(), 0666 ) ) ) { 
	           $amessage = "Couldn't set permissions on uploaded file. ".mysql_error();
           }
	        // Get the image size and type
               $attrs = getimagesize ( getImagePath() );
               $imageWidth = $attrs[0];
               $imageHeight = $attrs[1];
               $imageType = $attrs[2];
	  
      switch ( $imageType ) {
        case IMAGETYPE_GIF:
          $imageResource = imagecreatefromgif ( getImagePath() );
          break;
        case IMAGETYPE_JPEG:
          $imageResource = imagecreatefromjpeg ( getImagePath() );
          break;
        case IMAGETYPE_PNG:
          $imageResource = imagecreatefrompng ( getImagePath() );
          break;
        default:
          $amessage = "Unhandled or unknown image type ($imageType) ".mysql_error();
	  }
	  
	  // Copy and resize the image to create the thumbnail
      $thumbHeight = intval ( $imageHeight / $imageWidth * AV_THUMB_WIDTH );
      $thumbResource = imagecreatetruecolor ( AV_THUMB_WIDTH, $thumbHeight );
      imagecopyresampled( $thumbResource, $imageResource, 0, 0, 0, 0, AV_THUMB_WIDTH, $thumbHeight, $imageWidth, $imageHeight );

      // Save the thumbnail
      switch ( $imageType ) {
        case IMAGETYPE_GIF:
          imagegif ( $thumbResource, getImagePath() );
          break;
        case IMAGETYPE_JPEG:
          imagejpeg ( $thumbResource, getImagePath(), JPEG_QUALITY );
          break;
        case IMAGETYPE_PNG:
          imagepng ( $thumbResource, getImagePath() );
          break;
        default:
          $amessage = "Unhandled or unknown image type ($imageType) ".mysql_error();
	  }
   }
	}
}
/**
  * Deletes any images and/or thumbnails associated with the article
  */
function deleteImages() {

    // Delete all thumbnail images for this article
    foreach (glob( AV_UPLOAD_PATH . $_SESSION['useridentity']. ".*") as $filename) {
      unlink( $filename ) ;
    }

    // Remove the image filename extension from the object
    $imageExtension = "";
  }	
function getImagePath() {
	$imageExtension = strtolower( strrchr( $_FILES['avatar']['name'], '.' ) );
    return (AV_UPLOAD_PATH . $_SESSION['useridentity'] . $imageExtension );
  }		

  /**
  * Deletes the current Article object from the database.
  */

function delete($aId) {
      global $connection;
    // Does the Article object have an ID?
    if ( is_null($aId) ) {echo "Attempt to delete an Article object that does not have its ID property set.".mysql_error();}

    // Delete the Article
    if(intval($aId) == 0){
     header( "Location: admin.php?error=articleNotFound" );
   }
 	
	$id = mysql_prep($aId);
  $query = "DELETE FROM articles WHERE id ={$id} LIMIT 1";
  
  $result = mysql_query($query,$connection);
   if(mysql_affected_rows()==1){
    header( "Location: admin.php?articleDeleted" );
   }
   else{ //failed
	   $errorMessage = "<p> Unable to delete article </p>";
	   $errorMessage = "<p>".mysql_error()."</P>";
	   }
	 $sql = "DELETE FROM comments WHERE aId ={$aId}";
	         $result = mysql_query($sql,$connection);
  }

 function storeUploadedArticleImage( $image ) {
    if ( $image['error'] == UPLOAD_ERR_OK )
    {
      // Does the Article object have an ID?

      // Delete any previous image(s) for this article
      deleteArticleImages();

      // Get and store the image filename extension
      $imageExtension = strtolower( strrchr( $image['name'], '.' ) );

      // Store the image

      $tempFilename = trim( $image['tmp_name'] ); 
       $articletitle = $_POST['title'];
      if ( is_uploaded_file ( $tempFilename ) ) {
        if ( !( move_uploaded_file( $tempFilename, getArticleImagePath() ) ) ) {
			/*$amessage=*/ echo "Couldn't move uploaded file. ".mysql_error();}
        if ( !( chmod( getArticleImagePath(), 0666 ) ) ) {
			/*$amessage=*/ echo "Couldn't set permissions on uploaded file. ".mysql_error();}
      }

      // Get the image size and type
      $attrs = getimagesize ( getArticleImagePath() );
      $imageWidth = $attrs[0];
      $imageHeight = $attrs[1];
      $imageType = $attrs[2];

      // Load the image into memory
      switch ( $imageType ) {
        case IMAGETYPE_GIF:
          $imageResource = imagecreatefromgif ( getArticleImagePath() );
          break;
        case IMAGETYPE_JPEG:
          $imageResource = imagecreatefromjpeg ( getArticleImagePath() );
          break;
        case IMAGETYPE_PNG:
          $imageResource = imagecreatefrompng ( getArticleImagePath() );
          break;
        default:
          /*$amessage=*/ echo "Unhandled or unknown image type ($imageType) ".mysql_error();
      }

      // Copy and resize the image to create the thumbnail
      $thumbHeight = intval ( $imageHeight / $imageWidth * ARTICLE_THUMB_WIDTH );
      $thumbResource = imagecreatetruecolor ( ARTICLE_THUMB_WIDTH, $thumbHeight );
      imagecopyresampled( $thumbResource, $imageResource, 0, 0, 0, 0, ARTICLE_THUMB_WIDTH, $thumbHeight, $imageWidth, $imageHeight );

      // Save the thumbnail
      switch ( $imageType ) {
        case IMAGETYPE_GIF:
          imagegif ( $thumbResource, getArticleImagePath( IMG_TYPE_THUMB ) );
          break;
        case IMAGETYPE_JPEG:
          imagejpeg ( $thumbResource, getArticleImagePath( IMG_TYPE_THUMB ), JPEG_QUALITY );
          break;
        case IMAGETYPE_PNG:
          imagepng ( $thumbResource, getArticleImagePath( IMG_TYPE_THUMB ) );
          break;
        default:
          echo "Unhandled or unknown image type ($imageType) ".mysql_error();
      }
    }
  }


  /**
  * Deletes any images and/or thumbnails associated with the article
  */

 function deleteArticleImages() {
 $articletitle = $_POST['title'];
    // Delete all fullsize images for this article
      if ( !@unlink( ARTICLE_IMAGE_PATH . "/" . IMG_TYPE_FULLSIZE . "/" . $articletitle ) ) {
		  echo "deleteImages(): Couldn't delete image file. " .mysql_error() ;
    }
    
    // Delete all thumbnail images for this article
   // foreach (glob( ARTICLE_IMAGE_PATH . "/" . IMG_TYPE_THUMB . "/" . $articletitle . ".*") as $filename) 
      if ( !unlink( ARTICLE_IMAGE_PATH . "/" . IMG_TYPE_THUMB . "/" . $articletitle ) ){
		   echo "deleteImages(): Couldn't delete thumbnail file." .mysql_error();
    }

    // Remove the image filename extension from the object
    $imageExtension = "";
  }


  /**
  * Returns the relative path to the article's full-size or thumbnail image
  *
  * @param string The type of image path to retrieve (IMG_TYPE_FULLSIZE or IMG_TYPE_THUMB). Defaults to IMG_TYPE_FULLSIZE.
  * @return string|false The image's path, or false if an image hasn't been uploaded
  */

 function getArticleImagePath( $type=IMG_TYPE_FULLSIZE ) {
	  $articletitle = $_POST['title'];
	 $imageExtension = strtolower( strrchr( $_FILES['articleimage']['name'], '.' ) );
    return ( ARTICLE_IMAGE_PATH . "/$type/" . $articletitle . $imageExtension );
  }
  
 function imageSrc( $size=IMG_TYPE_FULLSIZE ) {
    return ( ARTICLE_IMAGE_PATH . "/$size/");
  }
?>
<?php
       function checkIfDataExist($tablename,$columname,$value){
		              $query ="SELECT * FROM $tablename 
					           WHERE $columname = $value 
							   LIMIT 1" ;
				  
        $value_set = mysql_query($query,$connection);
    confirm_query($value_set);
	
	return $menu_set;
		   }
?>
