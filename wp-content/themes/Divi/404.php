<?php get_header(); ?>
<center><img src="http://www.ziyouwu.com/images/404.jpg" /><br>
抱歉，您打开的页面未能找到。<br /><br /><br /><br /><br />您可以使用本站的搜索框搜索您想要的内容，如有不便深感抱歉！</center> <br>
<div style="text-align:center"><form id="searchform" method="get" action="<?php bloginfo('home'); ?>">
<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" size="30" />
<button type="submit"><?php _e("Search"); ?></button>
</form></div>
<?php get_footer(); ?>