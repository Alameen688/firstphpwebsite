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

<?php   
$article_ok = getList( HOMEPAGE_NUM_ARTICLES );
while($article = mysql_fetch_array($article_ok)){
            echo "<div class=\"clayer\">";
			echo "<h2 class=\"story\">
			<a href=\".?action=viewarticle&amp;articleid=".urlencode($article['id'])."\">".htmlspecialchars($article['title'])."</a></h2>";
            echo "<span style=\"color:#F63\"> filed under&nbsp;<a href=\".?action=archive&amp;categoryid=".$article['categoryId']."\">"
		   .htmlspecialchars($article['name'] )."</a>&nbsp;&nbsp;</span>";
		   echo "<span class=\"pubDate\">on&nbsp;&nbsp;".date('j F Y', $article['publicationDate'])."</span>";
			echo "<br />";
			echo htmlspecialchars($article['summary'])."...";
			echo "<br />";
			$imagepath = imageSrc().$article['articleImage'];
			echo "<a href=\".?action=viewarticle&amp;articleid=".urlencode($article['id'])."\"><img src=\"".$imagepath."\"></a>";
			echo "<p>&nbsp;</p>";
			echo "</div>";
}
 ?>      
 
      </div>
<?php include "include/footer.php" ?>