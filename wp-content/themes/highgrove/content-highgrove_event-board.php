<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-thumbnail">
        <?php the_post_thumbnail( ( $item['size'] == 'lg' ? 'highgrove-event-tall' : 'highgrove-event' ), array( 'class' => 'img-responsive' ) ); ?>
    </div>

    <div class="entry-body">

        <header class="entry-header">

            <?php if ( $item['icon'] ) : ?>
            <i class="<?php echo esc_attr( 'fa fa-' . $item['icon'] ); ?>"></i>
            <?php endif; ?>

            <?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>

            <hr>

        </header>

        <div class="entry-content">
            <?php echo do_shortcode( $content ); ?>
        </div>

    </div>

</article>