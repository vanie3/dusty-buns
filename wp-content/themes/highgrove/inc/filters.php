<?php

function highgrove_nav_menu_css_class( $classes, $item ) {

    if ( in_array( 'menu-item-has-children', $classes ) ) {
        $classes[] = 'dropdown';
    }

    return $classes;

}
add_filter( 'nav_menu_css_class', 'highgrove_nav_menu_css_class', 10, 2 );

function highgrove_nav_menu_link_attributes( $atts, $item, $args ) {

    if ( in_array( 'menu-item-has-children', $item->classes ) ) {
        $atts['href'] = '#';
        $atts['class'] = 'dropdown-toggle';
        $atts['data-toggle'] = 'dropdown';
        $atts['role'] = 'button';
        $atts['aria-expanded'] = 'false';
    }

    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'highgrove_nav_menu_link_attributes', 10, 3 );

function highgrove_walker_nav_menu_start_el( $item_output, $item, $depth, $args ){

    if ( $item && in_array( 'menu-item-has-children', $item->classes ) && $depth == 0 ){
        $item_output = str_replace( '</a>', ' <b class="caret"></b></a>', $item_output );
    }

    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'highgrove_walker_nav_menu_start_el', 10, 4 );

function highgrove_widget_tag_cloud_args($args) {

    $args['smallest'] = 13;
    $args['largest'] = 13;
    $args['unit'] = 'px';

    return $args;
}
add_filter( 'widget_tag_cloud_args', 'highgrove_widget_tag_cloud_args' );

function highgrove_get_avatar( $avatar, $id_or_email, $size, $default, $alt ) {

    $avatar = str_replace( 'avatar avatar-128', 'img-circle img-thumbnail avatar avatar-128', $avatar );

    return $avatar;
}
add_filter( 'get_avatar' , 'highgrove_get_avatar', 10, 5 );

add_filter( 'widget_text', 'do_shortcode' );