<ul class="et-social-icons">

<?php if ( 'on' === et_get_option( 'divi_show_weibo_icon', 'on' ) ) : ?>
	<li class="et-social-icon et-social-weibo">
		<a href="<?php echo esc_url( et_get_option( 'divi_weibo_url', '#' ) ); ?>" class="icon">
			<span><?php esc_html_e( '新浪微博', 'Divi' ); ?></span>
		</a>
	</li>
<?php endif; ?>

<?php if ( 'on' === et_get_option( 'divi_show_tqq_icon', 'on' ) ) : ?>
	<li class="et-social-icon et-social-tqq">
		<a href="<?php echo esc_url( et_get_option( 'divi_tqq_url', '#' ) ); ?>" class="icon">
			<span><?php esc_html_e( '腾讯微博', 'Divi' ); ?></span>
		</a>
	</li>
<?php endif; ?>

<?php if ( 'on' === et_get_option( 'divi_show_renren_icon', 'on' ) ) : ?>
	<li class="et-social-icon et-social-renren">
		<a href="<?php echo esc_url( et_get_option( 'divi_renren_url', '#' ) ); ?>" class="icon">
			<span><?php esc_html_e( '人人网', 'Divi' ); ?></span>
		</a>
	</li>
<?php endif; ?>

<?php if ( 'on' === et_get_option( 'divi_show_weixin_icon', 'on' ) ) : ?>
	<li class="et-social-icon et-social-weixin">
		<a href="<?php echo esc_url( et_get_option( 'divi_weixin_url', '#' ) ); ?>" class="icon">
			<span><?php esc_html_e( '微信', 'Divi' ); ?></span>
		</a>
	</li>
<?php endif; ?>

<?php if ( 'on' === et_get_option( 'divi_show_facebook_icon', 'on' ) ) : ?>
	<li class="et-social-icon et-social-facebook">
		<a href="<?php echo esc_url( et_get_option( 'divi_facebook_url', '#' ) ); ?>" class="icon">
			<span><?php esc_html_e( 'Facebook', 'Divi' ); ?></span>
		</a>
	</li>
<?php endif; ?>
<?php if ( 'on' === et_get_option( 'divi_show_twitter_icon', 'on' ) ) : ?>
	<li class="et-social-icon et-social-twitter">
		<a href="<?php echo esc_url( et_get_option( 'divi_twitter_url', '#' ) ); ?>" class="icon">
			<span><?php esc_html_e( 'Twitter', 'Divi' ); ?></span>
		</a>
	</li>
<?php endif; ?>
<?php if ( 'on' === et_get_option( 'divi_show_google_icon', 'on' ) ) : ?>
	<li class="et-social-icon et-social-google-plus">
		<a href="<?php echo esc_url( et_get_option( 'divi_google_url', '#' ) ); ?>" class="icon">
			<span><?php esc_html_e( 'Google', 'Divi' ); ?></span>
		</a>
	</li>
<?php endif; ?>
<?php if ( 'on' === et_get_option( 'divi_show_rss_icon', 'on' ) ) : ?>
<?php
	$et_rss_url = '' !== et_get_option( 'divi_rss_url' )
		? et_get_option( 'divi_rss_url' )
		: get_bloginfo( 'rss2_url' );
?>
	<li class="et-social-icon et-social-rss">
		<a href="<?php echo esc_url( $et_rss_url ); ?>" class="icon">
			<span><?php esc_html_e( 'RSS', 'Divi' ); ?></span>
		</a>
	</li>
<?php endif; ?>

</ul>