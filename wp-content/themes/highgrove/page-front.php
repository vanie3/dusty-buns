<?php
/**
 * Template Name: Front Page
 *
 * The template for displaying the front page
 *
 * @package WordPress
 * @subpackage Highgrove
 * @since Highgrove 1.0
 */

get_header(); ?>

    <main id="main" class="site-main" role="main">

        <?php

        $args = array(
            'post_type' => 'highgrove_section',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'nopaging' => true,
        );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) :

            while ( $query->have_posts() ) : $query->the_post();

                if ( $post->menu_order < 1 ) {
                    continue;
                }

                $content = get_the_content();

                if ( $post->menu_order == 1 && isset( $_GET['home'] ) ) {
                    $content = str_replace( 'home', $_GET['home'], $content );
                }

                $args  = ' id="' . $post->post_name . '"';
                $args .= ' style="' . get_post_meta( get_the_ID(), '_lg_section_style', true ) . '"';
                $args .= ( get_post_meta( get_the_ID(), '_lg_section_dark', true ) == '1' ) ? ' dark="true"' : '';
                $args .= ( $image = get_post_meta( get_the_ID(), '_lg_section_image', true ) ) ? ' image="' . $image . '"' : '';
                //$args .= ( $parallax_image = get_post_meta( get_the_ID(), '_section_parallax_image', true ) ) ? ' parallax_image="' . $parallax_image . '"' : '';
                //$args .= ( $parallax_speed = get_post_meta( get_the_ID(), '_section_parallax_speed', true ) ) ? ' parallax_speed="' . $parallax_speed . '"' : '';
                $args .= ( get_post_meta( get_the_ID(), '_lg_overlay', true ) == '1' ) ? ' overlay="true"' : '';
                //$args .= ( $overlay_style = get_post_meta( get_the_ID(), '_overlay_style', true ) ) ? ' overlay_style="' . $overlay_style . '"' : '';
                $args .= ( get_post_meta( get_the_ID(), '_lg_container', true ) == '1' ) ? '' : ' container="false"';
                $args .= ( $container_type = get_post_meta( get_the_ID(), '_lg_container_type', true ) ) ? ' container_type="' . $container_type . '"' : '';
                $args .= ( get_post_meta( get_the_ID(), '_lg_header', true ) == '0' ) ? ' header="false"' : '';
                $args .= ' title="' . ( ( $title_text = get_post_meta( get_the_ID(), '_lg_title_text', true ) ) ? $title_text : get_the_title() ) . '"';
                $args .= ( has_excerpt() ) ? ' deck="' . get_the_excerpt() . '"' : '';
                $args .= ( $header_style = get_post_meta( get_the_ID(), '_lg_header_style', true ) ) ? ' header_style="' . $header_style . '"' : '';
                $args .= ( $header_image = get_post_meta( get_the_ID(), '_lg_header_image', true ) ) ? ' header_image="' . $header_image . '"' : '';
                $args .= ( get_post_meta( get_the_ID(), '_lg_header_dark', true ) == '1' ) ? ' header_dark="true"' : '';
                $args .= ( get_post_meta( get_the_ID(), '_lg_header_overlay', true ) == '1' ) ? ' header_overlay="true"' : '';
                $args .= ( get_post_meta( get_the_ID(), '_lg_header_break', true ) == '1' ) ? ' header_break="true"' : '';
                //$args .= ( get_post_meta( get_the_ID(), '_footer_visible', true ) == '1' ) ? ' footer="true"' : '';
                $args .= ( $section_class = get_post_meta( get_the_ID(), '_lg_section_class', true ) ) ? ' class="' . $section_class . '"' : '';
                $args .= ( $container_class = get_post_meta( get_the_ID(), '_lg_container_class', true ) ) ? ' container_class="' . $container_class . '"' : '';
                $args .= ( $header_class = get_post_meta( get_the_ID(), '_lg_header_class', true ) ) ? ' header_class="' . $header_class . '"' : '';
                $args .= ( $title_class = get_post_meta( get_the_ID(), '_lg_title_class', true ) ) ? ' title_class="' . $title_class . '"' : '';

                echo do_shortcode( '[section' . $args . ']' . $content . '[/section]' );

            endwhile;

            wp_reset_postdata();

        endif;

        ?>

    </main>

<?php get_footer();