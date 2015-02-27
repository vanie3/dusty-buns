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
<!-- Added thi after the wp_footer so the pop up can be relative to the body -->
<?php if (is_front_page()): ?>
	    <div class="container">
        <?php
            //get the alert custom post types
            $type = 'alert';
            $args = array(
                'post_type'        => $type,
                'post_status'      => 'publish',
                'order'            => 'ASC',
                'orderby'          => 'date',
                'posts_per_page'   => 1,
            );

            $my_query = null;
            $my_query = new WP_Query($args);
        ?>
        <div class="hidden-xs">
	        <?php if ($my_query->have_posts()): while($my_query->have_posts()): $my_query->the_post();?>
	            
	                <div class="box">
	                    <button>&#10006;</button>
	                    <h3 class="h3"><?php the_title(); ?></h3>
	                    <div class="content">
	                        <?php the_content(); ?>
	                    </div>
	                </div>
	            
	        <?php endwhile; endif; wp_reset_postdata(); ?>	
        </div>

    </div>

    <script>
        $(document).ready(function(){
            $("button").click(function(){
                $(".box").hide();
            });
        });
         
    </script>
<?php endif; ?>

</body>
</html>
