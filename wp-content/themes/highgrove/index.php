<?php
/**
 * The main template file
 *
 * @package WordPress
 * @subpackage Highgrove
 * @since Highgrove 1.0
 */

get_header();

$container = ( isset( $_GET['container'] ) ? $_GET['container'] : $highgrove['opt-blog-container'] );
$type = ( isset( $_GET['type'] ) ? $_GET['type'] : $highgrove['opt-blog-type'] );
$cols = ( isset( $_GET['cols'] ) ? $_GET['cols'] : $highgrove['opt-blog-cols'] );
$sidebar = ( isset( $_GET['sidebar'] ) ? $_GET['sidebar'] : $highgrove['opt-blog-sidebar'] );

?>

    <div class="<?php echo 'container' . ( $container == 'full' ? '-fluid' : '' ); ?>">

        <?php if ( $sidebar != '0' && (string)$sidebar != 'false' ) : ?>
        <div class="row">

            <div class="col-lg-9">
            <?php endif; ?>

                <main id="main" class="site-main" role="main">

                    <section class="section section-archive">

                        <?php if ( is_archive() ) : ?>
                        <header class="section-header">
                            <?php
                            the_archive_title( '<h1 class="section-title">', '</h1>' );
                            the_archive_description( '<div class="taxonomy-description">', '</div>' );
                            ?>
                        </header>
                        <?php endif; ?>

                        <?php

                        if ( have_posts() ) :

                            // if masonry or timeline
                            if ( $type == 'masonry' ) :

                                echo do_shortcode( '[isotope cols="' . $cols . '"]' );

                            else :

                                while ( have_posts() ) : the_post();

                                    get_template_part( 'content', get_post_format() );

                                endwhile;

                                the_posts_pagination( array(
                                    'mid_size'           => 0,
                                    'prev_text'          => __( 'Previous page', 'highgrove' ),
                                    'next_text'          => __( 'Next page', 'highgrove' ),
                                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'highgrove' ) . ' </span>',
                                ) );

                            endif;

                        else :

                            get_template_part( 'content', 'none' );

                        endif;

                        ?>

                    </section>

                </main>

            <?php if ( $sidebar != '0' && (string)$sidebar != 'false' ) : ?>
            </div>

            <div class="col-lg-3 visible-lg-block">
                <?php get_sidebar( 'content' ); ?>
            </div>

        </div>
        <?php endif; ?>

    </div>

<?php get_footer();