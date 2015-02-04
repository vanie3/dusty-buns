<?php
/**
 * The template for displaying all events
 *
 * @package WordPress
 * @subpackage Highgrove
 * @since Highgrove 1.0
 */

get_header(); ?>

    <main id="main" class="site-main" role="main">

        <?php

        while ( have_posts() ) : the_post();

            get_template_part( 'content', 'highgrove_event' );

        endwhile;

        ?>

    </main>

<?php get_footer();