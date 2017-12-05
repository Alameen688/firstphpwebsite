<?php
ini_set( "display_errors", true );
date_default_timezone_set( "Australia/Sydney" );  // http://www.php.net/manual/en/timezones.php
//constant for cms
define("DB_SERVER","localhost");
define( "DB_USERNAME", "root" );
define( "DB_PASSWORD", "ogundiran2315" );//
define("DB_NAME","cms");
/*define("DB_SERVER","mysql6.000webhost.com");
define( "DB_USERNAME", "a1447037_ameen" );
define( "DB_PASSWORD", "ogundiran2315" );
define("DB_NAME","a1447037_cms");
*/
define( "CLASS_PATH", "classes" );
define( "TEMPLATE_PATH", "templates" );
define('AV_UPLOAD_PATH', 'images/avatar/');
define('AV_MAXFILESIZE', '153600');//150kb
define( "AV_THUMB_WIDTH", 80 );
define( "JPEG_QUALITY", 85 );
define( "HOMEPAGE_NUM_ARTICLES", 10 );
define( "ADMIN_USERNAME", "alameen688" );
define( "ADMIN_PASSWORD", "ogundiran2315" );
define( "ARTICLE_IMAGE_PATH", "images/articles" );
define( "IMG_TYPE_FULLSIZE", "fullsize" );
define( "IMG_TYPE_THUMB", "thumb" );
define( "ARTICLE_THUMB_WIDTH", 120 );
//creating database connection
 $connection = mysql_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD);
 if(!$connection){
	 die ("Database Connection Failed" . mysql_error());
	 } 
//selecting a database to use
 $db_select = mysql_select_db(DB_NAME,$connection);
 if(!$db_select){
	 die ("Database Connection Failed" . mysql_error());
	 } 
require( CLASS_PATH . "/Functions.php" );
require( CLASS_PATH . "/Category.php" );

?>
