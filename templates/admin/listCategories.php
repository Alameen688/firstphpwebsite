<?php include "templates/include/header.php" ?>
<?php include "templates/admin/include/header.php" ?>

      <h1>Article Categories</h1>

<?php if ( isset( $errorMessage ) ) { ?>
        <div class="errorMessage"><?php echo $errorMessage ?></div>
<?php } ?>


<?php if ( isset( $statusMessage ) ) { ?>
        <div class="statusMessage"><?php echo $statusMessage ?></div>
<?php } ?>

      <table>
        <tr>
          <th>Category</th>
        </tr>

<?php  while ( $catlist = mysql_fetch_array( $categorylist ) ) { ?>

        <tr onclick="location='admin.php?action=editCategory&amp;categoryId=<?php echo $catlist['id']?>'">
          <td>
            <?php echo $catlist['name']?>
          </td>
        </tr>

<?php } ?>

      </table>
<?php  if ( $catlistsum = mysql_num_rows($categorylist) ) { ?>
      <p><?php echo $catlistsum ?> categor<?php echo ( $catlistsum != 1 ) ? 'ies' : 'y' ?> in total.</p>

      <p><a href="admin.php?action=newCategory">Add a New Category</a></p>
<?php } ?>
<?php include "templates/include/footer.php" ?>

