<?php
if ( ( is_single() || is_page() ) && 'et_full_width_page' === get_post_meta( get_the_ID(), '_et_pb_page_layout', true ) )
	return;

if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="sidebar">
	    <?php if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
			dynamic_sidebar( 'woocommerce' );
			}else{ 
		dynamic_sidebar( 'sidebar-1' );
			}
		?>
	</div> <!-- end #sidebar -->
<?php endif; ?>