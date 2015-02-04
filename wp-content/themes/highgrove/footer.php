<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Highgrove
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

        <?php get_sidebar( 'footer' ); ?>

		<div class="site-info">
            <div class="overlay"></div>
			<div class="container">
                <div class="pull-<?php echo ( is_rtl() ? 'right' : 'left' ); ?>"><?php printf( '<strong><a href="%1$s">%2$s</a></strong>', esc_url( home_url( '/' ) ), get_bloginfo( 'name' ) ); ?><?php _e( '2015. All rights reserved.', 'highgrove' ); ?></div>
                <div class="pull-<?php echo ( is_rtl() ? 'left' : 'right' ); ?>"><a href="http://themeforest.net/user/LivelyGreen" target="_blank" rel="designer"><img src="<?php echo esc_url( get_template_directory_uri() . '/img/lg.png' ); ?>" alt="Lively Green"></a></div>
			</div>
		</div>

	</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>
