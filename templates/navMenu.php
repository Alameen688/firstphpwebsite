<?php include "include/header.php" ?>
 <ul class="nav">
 <?php
$menu_ok = get_all_nav();
while($nav = mysql_fetch_array($menu_ok)){
echo"<a href=\".?action=navmenu&amp;subjid=".urlencode($nav['id'])."\"><li>".htmlspecialchars( $nav['menuName'] )."</li></a>";
}
?>   
 </ul>
</div><!--sidebar1 closed -->
 <div class="content">
  <div id="storyplatform"> 
  <?php
  if($navresult){
  ?>
      <h2 id="topic"><?php echo htmlspecialchars( $navresult['heading'] )?></h2>
     <!--<div style="width: 75%; font-style: italic;"><?php echo htmlspecialchars( $navresult['menuName'] )?></div>-->
     <?php echo $navresult['content']?>
<?php } ?>
      <p><a href="./">Return to Homepage</a></p>
  </div>
 </div>

<?php include "include/footer.php" ?>
