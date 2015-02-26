<?php
/**
 * The Footer Sidebar
 *
 * @package WordPress
 * @subpackage Highgrove
 * @since Highgrove 1.0
 */

if ( ! is_active_sidebar( 'sidebar-3' ) ) {
    return;
}
?>
<?php if (is_front_page()): ?>
	<div id="supplementary" class="site-supplementary">
	    <div class="container">
	    	<div class="row">
		        <!-- <div id="footer-sidebar" class="sidebar sidebar-footer isotope isotope-col-lg-3 widget-area" role="complementary"> -->
		            <div class="column-sizer"></div>
		            <div class="gutter-sizer"></div>
		            <?php dynamic_sidebar( 'sidebar-3' ); ?>
		        <!-- </div>#footer-sidebar -->
		    </div>    
	    </div>
	</div><!-- #supplementary -->
<?php endif; ?>

