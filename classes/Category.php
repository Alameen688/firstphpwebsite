<?php
function getCatById( $id ) {
    global $connection;
    $sql = "SELECT * FROM categories WHERE id = $id";
    $cat_set = mysql_query($sql,$connection);
    confirm_query($cat_set);
	return $cat_set ;
  }
function getCatList( $numRows=1000000 ) {
    global $connection;
    $query = "SELECT * FROM categories
            ORDER BY name ASC LIMIT $numRows";
 	$cat_list = mysql_query($query,$connection);
    confirm_query($cat_list);
		return $cat_list;
	
    }  
/*	
function insert_cat() {
    global $connection;
    $sql = "INSERT INTO categories ( name, description ) VALUES ( $name, $description )";
    $page_set = mysql_query($sql,$connection);
    confirm_query($page_set);
	return $page_set ;
  }
  	
function update_cat() {
    global $connection;
    $sql = "UPDATE categories SET name=$name, description=$description WHERE id = $id";
    $page_set = mysql_query($sql,$connection);
    confirm_query($page_set);
	return $page_set ;
  }
function delete_cat() {
    global $connection;
    $sql = "DELETE FROM categories WHERE id = $id LIMIT 1";
    $page_set = mysql_query($sql,$connection);
    confirm_query($page_set);
	return $page_set ;
  }
	*/

/**
  * Inserts the current Category object into the database, and sets its ID property.
  

 function insert() {

    // Does the Category object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "Category::insert(): Attempt to insert a Category object that already has its ID property set (to $this->id).", E_USER_ERROR );

    // Insert the Category
    $conn = new PDO( DB_DSN, DB_USERNAME );
    $sql = "INSERT INTO categories ( name, description ) VALUES ( :name, :description )";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":name", $this->name, PDO::PARAM_STR );
    $st->bindValue( ":description", $this->description, PDO::PARAM_STR );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }


  /**
  * Deletes the current Category object from the database.
  

 function delete() {

    // Does the Category object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Category::delete(): Attempt to delete a Category object that does not have its ID property set.", E_USER_ERROR );

    // Delete the Category
    $conn = new PDO( DB_DSN, DB_USERNAME );
    $st = $conn->prepare ( "DELETE FROM categories WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
  */
		
?>