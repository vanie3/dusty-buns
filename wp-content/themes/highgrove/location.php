<?php
/**
 * Template Name: Location
 *
 * @package WordPress
 * @subpackage Highgrove
 * @since Highgrove 1.0
 */

get_header(); ?>

    <main id="main" class="site-main" role="main">

        <?php

        while ( have_posts() ) : the_post();
        	

            get_template_part( 'content', 'location' );

        endwhile;

        ?>

    </main>

<?php get_footer();