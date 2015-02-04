<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Highgrove
 * @since Highgrove 1.0
 */

get_header();

$sidebar = ( isset( $_GET['sidebar'] ) ? $_GET['sidebar'] : $highgrove['opt-blog-sidebar'] );

?>

    <div class="container">

        <?php if ( $sidebar != '0' && (string)$sidebar != 'false' ) : ?>
        <div class="row">

            <div class="col-lg-9">
            <?php endif; ?>

                <main id="main" class="site-main" role="main">

                    <?php

                    while ( have_posts() ) : the_post();

                        get_template_part( 'content', get_post_format() );

                    endwhile;

                    ?>

                </main>

            <?php if ( $sidebar != '0' && (string)$sidebar != 'false' ) : ?>
            </div>

            <div class="col-lg-3">
                <?php get_sidebar( 'content' ); ?>
            </div>

        </div>
        <?php endif; ?>

    </div>

<?php get_footer();