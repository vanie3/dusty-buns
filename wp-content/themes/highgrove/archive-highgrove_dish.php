<?php
/**
 * The template for displaying menu archive
 *
 * @package WordPress
 * @subpackage Highgrove
 * @since Highgrove 1.0
 */

get_header();

$container = ( isset( $_GET['container'] ) ? $_GET['container'] : $highgrove['opt-menu-container'] );
$cols = ( isset( $_GET['cols'] ) ? $_GET['cols'] : $highgrove['opt-menu-cols'] );
$compact = ( isset( $_GET['compact'] ) ? $_GET['compact'] : $highgrove['opt-menu-compact'] );
$filters = ( isset( $_GET['filters'] ) ? $_GET['filters'] : $highgrove['opt-menu-filters'] );

?>

    <div class="<?php echo 'container' . ( $container == 'full' ? '-fluid' : '' ); ?>">

        <main id="main" class="site-main" role="main">

            <section class="section section-archive">

                <?php

                if ( have_posts() ) :

                    echo do_shortcode( '[isotope cols="' . $cols . '" compact="' . ( ( $compact == '0' || (string)$compact == 'false' ) ? 'false' : 'true' ) . '" filters="' . ( ( $filters == '0' || (string)$filters == 'false' ) ? 'false' : 'true' ) . '" post_type="highgrove_dish"]' );

                else :

                    get_template_part( 'content', 'none' );

                endif;

                ?>

            </section>

        </main>

    </div>

<?php get_footer();