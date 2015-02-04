<?php
/**
 * The template for displaying all pages
 *
 * @package WordPress
 * @subpackage Highgrove
 * @since Highgrove 1.0
 */

get_header(); ?>

    <main id="main" class="site-main" role="main">

        <?php

        while ( have_posts() ) : the_post();

            get_template_part( 'content', 'page' );

        endwhile;

        ?>

    </main>

<?php get_footer();