<?php require_once( "includes/authorize.php" );?>
<?php
require( "config.php" );
session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
$username = isset( $_SESSION['username'] ) ? $_SESSION['username'] : "";

if ( $action != "login" && $action != "logout" && !$username ) {
  login();
  exit;
}

switch ( $action ) {
  case 'login':
    login();
    break;
  case 'logout':
    logout();
    break;
  case 'newArticle':
    newArticle();
    break;
  case 'editArticle':
    editArticle();
    break;
  case 'deleteArticle':
    deleteArticle();
    break;
  case 'listCategories':
    listCategories();
    break;
  case 'newCategory':
    newCategory();
    break;
  case 'editCategory':
    editCategory();
    break;
  case 'deleteCategory':
    deleteCategory();
    break;	
  default:
    listArticles();
}


function login() {

  $results = array();
  $pageTitle = "Admin Login | Widget News";

  if ( isset( $_POST['login'] ) ) {

    // User has posted the login form: attempt to log the user in

    if ( $_POST['username'] == ADMIN_USERNAME && $_POST['password'] == ADMIN_PASSWORD ) {

      // Login successful: Create a session and redirect to the admin homepage
      $_SESSION['username'] = ADMIN_USERNAME;
      header( "Location: admin.php" );

    } else {

      // Login failed: display an error message to the user
      $errorMessage = "Incorrect username or password. Please try again.";
      require( TEMPLATE_PATH . "/admin/loginForm.php" );
    }

  } else {

    // User has not posted the login form yet: display the form
    require( TEMPLATE_PATH . "/admin/loginForm.php" );
  }

}


function logout() {
  unset( $_SESSION['username'] );
  header( "Location: admin.php" );
}


function newArticle() {
  $pageTitle = "New Article";
  $category = getCatList();
    // User has not posted the article edit form yet: display the form
    require( TEMPLATE_PATH . "/admin/newArticle.php" );
}


function editArticle() {

  $pageTitle = "Edit Article";
    // User has not posted the article edit form yet: display the form
   // $editarticle = getById( (int)$_GET["articleId"] );$articletoedit = mysql_fetch_array( $editarticle );	
    require( TEMPLATE_PATH . "/admin/editArticle.php" );


}


function deleteArticle() {

  if ( !$article = getById( (int)$_GET["articleId"] )) {
    header( "Location: admin.php?error=articleNotFound" );
    return;
  }

  delete((int)$_GET["articleId"]);
  header( "Location: admin.php?status=articleDeleted" );
}


function listArticles() {	
  $pageTitle = "All Articles";

  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "articleNotFound" ) $errorMessage = "Error: Article not found.";
  }

  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) $statusMessage = "Your changes have been saved.";
    if ( $_GET['status'] == "articleDeleted" ) $statusMessage = "Article deleted.";
  }

  require( TEMPLATE_PATH . "/admin/listArticles.php" );
}

function listCategories() {
  $categorylist = getCatList();
  $pageTitle = "Article Categories";

  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "categoryNotFound" ) $errorMessage = "Error: Category not found.";
    if ( $_GET['error'] == "categoryContainsArticles" ) $errorMessage = "Error: Category contains articles. Delete the articles, or assign them to another category, before deleting this category.";
  }

  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) $statusMessage = "Your changes have been saved.";
    if ( $_GET['status'] == "categoryDeleted" ) $statusMessage = "Category deleted.";
  }

  require( TEMPLATE_PATH . "/admin/listCategories.php" );
}

function newCategory() {

  
  $pageTitle = "New Article Category";
  $formAction = "newCategory";


    // User has not posted the category edit form yet: display the form
   
    require( TEMPLATE_PATH . "/admin/newCategory.php" );

}

function editCategory() {

  $pageTitle  = "Edit Article Category";
    // User has not posted the category edit form yet: display the form
    require( TEMPLATE_PATH . "/admin/editCategory.php" );

}
?>
