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
<?php include "templates/admin/include/header.php" ?>


      <h1>All Articles</h1>

<?php if ( isset( $errorMessage ) ) { ?>
        <div class="errorMessage"><?php echo $errorMessage ?></div>
<?php } ?>


<?php if ( isset(  $statusMessage ) ) { ?>
        <div class="statusMessage"><?php echo  $statusMessage ?></div>
<?php } ?>

      <table>
        <tr>
          <th>Publication Date</th>
          <th>Article</th>
        </tr>

<?php  $articleresult = getList();//getById( (int)$_POST["articleId"] );
       while ( $list = mysql_fetch_array($articleresult) ) { ?>

        <tr onclick="location='admin.php?action=editArticle&amp;articleId=<?php echo $list["id"]?>'">
          <td><?php echo date('j M Y', $list["publicationDate"])?></td>
          <td>
            <?php echo $list["title"]?>
          </td>
        </tr>

<?php } ?>

      </table>
<?php  if ( $numlist = mysql_num_rows($articleresult) ) { ?>

      <p><?php echo $numlist ?> article<?php echo ( $numlist != 1 ) ? 's' : '' ?> in total.</p>
<?php } ?>
      <p><a href="admin.php?action=newArticle">Add a New Article</a></p>
</div>
<?php include "templates/include/footer.php" ?>

