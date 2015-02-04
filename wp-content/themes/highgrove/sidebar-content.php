<?php
/**
 * The Content Sidebar
 *
 * @package WordPress
 * @subpackage Highgrove
 * @since Highgrove 1.0
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
    return;
}
?>
<div id="content-sidebar" class="sidebar sidebar-content widget-area" role="complementary">
    <?php dynamic_sidebar( 'sidebar-2' ); ?>
</div>