<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage Highgrove
 * @since Highgrove 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-thumbnail">
        <?php highgrove_post_thumbnail(); ?>
    </div>

    <div class="entry-body">

        <header class="entry-header">

            <div class="entry-meta">
                <?php highgrove_entry_categories(); ?>
            </div>

            <?php
            if ( is_single() ) :
                the_title( '<h1 class="entry-title">', '</h1>' );
            else :
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            endif;
            ?>

            <?php if ( 'post' == get_post_type() ) : ?>
            <ul class="entry-meta list-inline">
                <?php highgrove_posted_on(); ?>
            </ul>
            <?php endif; ?>

        </header>

        <div class="entry-content">
            <?php
            /* translators: %s: Name of current post */
            the_content( sprintf(
                __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'highgrove' ),
                the_title( '<span class="screen-reader-text">"', '"</span>', false )
            ) );
            ?>

            <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'highgrove' ),
                'after'  => '</div>',
            ) );
            ?>
        </div>

        <footer class="entry-footer">
            <div class="entry-meta">
                <?php highgrove_entry_footer(); ?>
            </div>
        </footer>

        <?php

        // Previous/next post navigation.
        highgrove_post_nav();

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) {
            comments_template();
        }

        ?>

    </div>

</article>