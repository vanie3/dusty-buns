<?php
/**
 * The default template for displaying content in isotope component
 *
 * @package WordPress
 * @subpackage Highgrove
 * @since Highgrove 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'template-simple' ); ?>>

    <div class="entry-thumbnail">
        <?php highgrove_post_thumbnail( 'simple' ); ?>
    </div>

    <div class="entry-body">

        <header class="entry-header">

<!--             <?php if ( has_category() ) : ?>
            <div class="entry-meta">
                <?php highgrove_entry_categories(); ?>
            </div>
            <?php endif; ?> -->

            <?php
/*=== Added this so the post will redirect to an external link if it exists ===*/            
            $isLink = types_render_field('external-link', array('output' => 'raw'));
            if ($isLink) {
                $theLink = $isLink;
            } else {
                $theLink = get_permalink();
            }
/*============================================================================*/
            if ( is_post_type_archive( 'highgrove_dish' ) ) :
                the_title( '<h2 class="entry-title">', '</h2>' );
            else :
                the_title( '<h3 class="entry-title"><a href="' . esc_url( $theLink ) . '" rel="bookmark">', '</a></h3>' );
            endif;
            ?>
<!-- Commenting this out so the date doesn't show -->
<!--             <?php if ( 'post' == get_post_type() ) : ?>
            <ul class="entry-meta list-inline">
                <?php highgrove_posted_on( 'simple' ); ?>
            </ul>
            <?php endif; ?> -->
<!-- ============================================ -->
        </header>

        <div class="entry-content">
<!--Changed this from excerpt to content to be able to input content from dashboard easily-->
            
            <?php 
            the_excerpt(); 
            ?>
<!--======================================================================================-->
            <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'highgrove' ),
                'after'  => '</div>',
            ) );
            ?>
        </div>

        <?php if ( 'highgrove_dish' == get_post_type() ) : ?>
        <footer class="entry-footer">
            <?php echo '<b class="price">$ ' . number_format( get_field( '_lg_dish_price' ), 2 ) . '</b>'; ?>
        </footer>
        <?php endif; ?>

    </div>

</article>