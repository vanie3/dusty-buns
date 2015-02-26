<?php
/**
 * The template used for displaying page sections.
 *
 * @package WordPress
 * @subpackage Highgrove
 */
?>

<!-- I added '#' before the php section reference and then took it off because its not needed -->
<!--==============================================-->
<section id="<?php echo esc_attr( $section['id'] ); ?>" class="<?php echo esc_attr( $class ); ?>"<?php echo $style; ?>>
<!--==============================================-->
<!--==============================================-->

    <?php

    if ( has_shortcode( $content, 'embed' ) ) {

        global $wp_embed;

        $content = $wp_embed->run_shortcode( $content );
    }

    echo do_shortcode( $content );

    ?>

</section>