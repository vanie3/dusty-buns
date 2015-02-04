<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Highgrove
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( get_field( '_lg_header' ) == '1' ) : ?>
    <header class="entry-header bg-<?php echo esc_attr( get_field( '_lg_header_style' ) ); ?><?php echo ( get_field( '_lg_header_dark' ) == '1' ? ' bg-dark' : '' ); ?><?php echo ( ( $header_class = get_field( '_lg_header_class' ) ) ? ' ' . esc_attr( $header_class ) : '' ); ?>"<?php if ( get_field( '_lg_header_style' ) == 'image' ) : ?> style="background-image: url('<?php echo esc_url( wp_get_attachment_url( get_field( '_lg_header_image' ) ) ); ?>');"<?php endif; ?>>

        <?php if ( get_field( '_lg_header_overlay' ) == '1' ) : ?>
        <div class="overlay"></div>
        <?php endif; ?>

		<div class="container">

            <h1 class="entry-title<?php if ( $title_class = get_field( '_lg_title_class' ) ) echo esc_attr( ' ' . $title_class ); ?>"><?php echo ( ( $title_text = get_field( '_lg_title_text' ) ) ? $title_text : get_the_title() ); ?></h1>
            <?php the_excerpt(); ?>
            <?php if ( get_field( '_lg_header_break' ) == '1' ) : ?><hr><?php endif; ?>

		</div>

	</header>
    <?php endif; ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">

                <div class="entry-body">
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

</article>