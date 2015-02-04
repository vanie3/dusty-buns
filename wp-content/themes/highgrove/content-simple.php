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

            <?php if ( has_category() ) : ?>
            <div class="entry-meta">
                <?php highgrove_entry_categories(); ?>
            </div>
            <?php endif; ?>

            <?php
            if ( is_post_type_archive( 'highgrove_dish' ) ) :
                the_title( '<h2 class="entry-title">', '</h2>' );
            elseif ( is_archive() || is_home() ) :
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            else :
                the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
            endif;
            ?>

            <?php if ( 'post' == get_post_type() ) : ?>
            <ul class="entry-meta list-inline">
                <?php highgrove_posted_on( 'simple' ); ?>
            </ul>
            <?php endif; ?>

        </header>

        <div class="entry-content">
            <?php
            the_content();
            ?>

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