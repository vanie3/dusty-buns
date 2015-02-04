<div id="<?php echo esc_attr( $id ); ?>" class="carousel slide" data-ride="carousel">

    <div class="carousel-inner">
        <?php echo do_shortcode( $content ); ?>
    </div>

    <?php if ( $highgrove_carousel['indicators'] === true ) : ?>
    <ol class="carousel-indicators">
        <?php for ( $i = 0; $i < $highgrove_carousel['size']; $i++ ) : ?>
            <li data-target="#<?php echo esc_attr( $id ); ?>" data-slide-to="<?php echo esc_attr( $i ); ?>"<?php echo ( $i == $highgrove_carousel['active'] ? ' class="active"' : '' ); ?>></li>
        <?php endfor; ?>
    </ol>
    <?php endif; ?>

    <?php if( $highgrove_carousel['controls'] === true ) : ?>
    <a class="left carousel-control" href="<?php echo esc_attr( '#' . $id ); ?>" role="button" data-slide="prev">
        <span class="arrow arrow-default arrow-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="<?php echo esc_attr( '#' . $id ); ?>" role="button" data-slide="next">
        <span class="arrow arrow-default arrow-right"></span>
        <span class="sr-only">Next</span>
    </a>
    <?php endif; ?>

</div>