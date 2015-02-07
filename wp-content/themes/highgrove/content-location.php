<?php
/**
 * The template used for displaying location content in location.php
 *
 * @package WordPress
 * @subpackage Highgrove
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( get_field( '_lg_header' ) == '1' ) : ?>
    <header class="entry-header bg-<?php echo esc_attr( get_field( '_lg_header_style' ) ); ?><?php if ( get_field( '_lg_header_dark' ) == '1' ) echo ' bg-dark'; ?><?php echo ( ( $header_class = get_field( '_lg_header_class' ) ) ? ' ' . esc_attr( $header_class ) : '' ); ?>"<?php if ( get_field( '_lg_header_style' ) == 'image' ) : ?> style="background-image: url('<?php echo esc_url( wp_get_attachment_url( get_field( '_lg_header_image' ) ) ); ?>')"<?php endif; ?>>

        <?php if( get_field( '_lg_header_overlay' ) == '1' ) : ?>
        <div class="overlay"></div>
        <?php endif; ?>

		<div class="container">

            <h1 class="entry-title<?php if ( $title_class = get_field( '_lg_title_class' ) ) echo ' ' . esc_attr( $title_class ); ?>"><?php echo ( ( $title_text = get_field( '_lg_title_text' ) ) ? $title_text : get_the_title() ); ?></h1>
            <?php
                echo types_render_field("excerpt", array("output"=>"value1"));
            ?>
            <?php if ( get_field( '_lg_header_break' ) == '1' ) : ?><hr><?php endif; ?>

		</div>

	</header>
    <?php endif; ?>

    <?php if ( $container = get_field( '_lg_container' ) == '1' ) : ?>
    <div class="<?php echo 'container' . ( get_field( '_lg_container_type' ) == 'default' ? '' : '-' . esc_attr( get_field( '_lg_container_type' ) ) ); ?>">
    <?php endif; ?>
        <div class="container">
            <div class="row">
                <div class="entry-content col-md-3">
                    <?php the_content(); ?>
                </div>
                <div class="col-md-9">
                    <?php echo do_shortcode('[menu]'); ?>
                </div>
            </div>
        </div>
    <?php if ( $container ) : ?>
    </div>
    <?php endif; ?>

</article>