<?php

function highgrove_container( $atts, $content = null ) {

    $container = shortcode_atts( array(
        'type'  => 'default',
        'class' => null,
    ), highgrove_normalize_atts( $atts ) );

    $class  = 'container' . ( $container['type'] == 'default' ? '' : '-' . $container['type'] );
    $class .= ( $container['class'] ) ? ' ' . $container['class'] : '';

    $output  = '<div class="' . esc_attr( $class ) . '">';
    $output .= do_shortcode( $content );
    $output .= '</div>';

    return $output;
}
add_shortcode( 'container', 'highgrove_container' );

function highgrove_header( $atts, $content = null ) {

    $header = shortcode_atts( array(
        'type'          => null,
        'title'         => null,
        'level'         => 'p',
        'size'          => null,
        'style'         => null,
        'image'         => null,
        'dark'          => false,
        'container'     => false,
        'overlay'       => false,
        'break'         => false,
        'class'         => null,
        'title_class'   => null,
    ), highgrove_normalize_atts( $atts ) );

    if ( ! $header['title'] && ! $content ) {
        return;
    }

    if ( ! has_shortcode( $content, 'title' ) && $header['title'] ) {
        $content = '[title type="' . $header['type'] . '" level="' . $header['level'] . '"' . ( $header['size'] ? ' size="' . $header['size'] . '"' : '' ) . ( $header['title_class'] ? ' class="' . $header['title_class'] . '"' : '' ) . ']' . $header['title'] . '[/title]' . $content;
    }

    $content .= ( $header['break'] === true ) ? '<img src="' . esc_url( get_template_directory_uri() . '/img/hr.png' ) . '" alt="Break">' : '';

    if ( $header['container'] === true ) {
        $content = '[container]' . $content . '[/container]';
    }

    if ( $header['overlay'] === true ) {
        $content = '<div class="overlay"></div>' . $content;
    }

    $tag = ( $header['type'] == 'section' ) ? 'header' : 'div';

    if ( $header['type'] ) {
        $class = ( $header['type'] == 'panel' ) ? 'panel-heading' : $header['type'] . '-header';
    } else {
        $class = 'header';
    }
    $class .= ( $header['style'] ) ? ' bg-' . $header['style'] : '';
    $class .= ( $header['dark'] === true ) ? ' bg-dark' : '';
    $class .= ( $header['class'] ) ? ' ' . $header['class'] : '';

    $style = ( $header['style'] == 'image' && $header['image'] ) ? 'background-image: url(' . esc_url( wp_get_attachment_url( $header['image'] ) ) . ');' : '';
    $style = ( $style == '' ) ? '' : ' style="' . esc_attr( $style ) . '"';

    $output  = '<' . $tag . ' class="' . esc_attr( $class ) . '"' . $style . '>';
    $output .= do_shortcode( $content );
    $output .= '</' . $tag . '>';

    return $output;
}
add_shortcode( 'header', 'highgrove_header' );

function highgrove_title( $atts, $content = null ) {

    $title = shortcode_atts( array(
        'type' => null,
        'level' => 'p',
        'size' => null,
        'text' => null,
        'class' => null,
    ), highgrove_normalize_atts( $atts ) );

    $class  = ( $title['type'] ) ? $title['type'] . '-title' : 'title';
    $class .= ( $title['size'] ) ? ' title-' . $title['size'] : '';
    $class .= ( $title['class'] ) ? ' ' . $title['class'] : '';

    if ( $title['text'] ) {
        $output = '<' . $title['level'] . ' class="' . esc_attr( $class ) . '">' . $title['text'] . $content . '</' . $title['level'] . '>';
    } else {
        $output = '<' . $title['level'] . ' class="' . esc_attr( $class ) . '">' . $content . '</' . $title['level'] . '>';
    }

    return do_shortcode( $output );
}
add_shortcode( 'title', 'highgrove_title' );

function highgrove_footer( $atts, $content = null ) {

    $footer = shortcode_atts( array(
        'type' => null,
        'break' => false,
        'class' => null,
    ), highgrove_normalize_atts( $atts ) );

    if ( $footer['type'] ) {
        $class = $footer['type'] . '-footer';
    } else {
        $class = 'footer';
    }

    $output  = '<footer class="' . esc_attr( $class ) . '">';
    $output .= do_shortcode( $content );
    $output .= ( $footer['break'] === true ) ? '<hr>' : '';
    $output .= '</footer>';

    return $output;
}
add_shortcode( 'footer', 'highgrove_footer' );

function highgrove_body( $atts, $content = null ) {

    $body = shortcode_atts( array(
        'type' => 'section',
    ), highgrove_normalize_atts( $atts ) );

    $class = $body['type'] . '-body';

    $output  = '<div class="' . esc_attr( $class ) . '">';
    $output .= do_shortcode( $content );
    $output .= '</div>';

    return $output;
}
add_shortcode( 'body', 'highgrove_body' );

function highgrove_section( $atts, $content = null ) {

    $section = shortcode_atts( array(
        'id' => null,
        'style' => 'default',
        'image' => null,
        'dark' => false,
        'overlay' => false,
        'container' => true,
        'container_type' => 'default',
        'header' => true,
        'title' => null,
        'deck' => null,
        'header_style' => null,
        'header_image' => null,
        'header_dark' => false,
        'header_overlay' => false,
        'header_break' => false,
        'footer' => false,
        'class' => null,
        'container_class' => null,
        'header_class' => null,
        'title_class' => null,
    ), highgrove_normalize_atts( $atts ) );

    if ( $section['container'] === true ) {

        $container_class  = 'container' . ( $section['container_type'] == 'default' ? '' : '-' . $section['container_type'] );
        $container_class .= ( $section['container_class'] ) ? ' ' . $section['container_class'] : '';

        $content = '<div class="' . esc_attr( $container_class ) . '">' . $content . '</div>';
    }

    if ( $section['header'] === true ) {
        // if a custom shortcode isn't included
        if ( ! has_shortcode( $content, 'section-header' ) ) {
            $args  = '';
            $args .= ( $section['title'] ) ? ' title="' . $section['title'] . '"' : '';
            $args .= ( $section['deck'] ) ? ' deck="' . $section['deck'] . '"' : '';
            $args .= ( $section['header_style'] ) ? ' style="' . $section['header_style'] . '"' : '';
            $args .= ( $section['header_image'] ) ? ' image="' . $section['header_image'] . '"' : '';
            $args .= ( $section['header_dark'] === true ) ? ' dark="true"' : '';
            $args .= ( $section['header_overlay'] === true ) ? ' overlay="true"' : '';
            $args .= ( $section['header_break'] === true ) ? ' break="true"' : '';
            $args .= ( $section['header_class'] ) ? ' class="' . $section['header_class'] . '"' : '';
            $args .= ( $section['title_class'] ) ? ' title_class="' . $section['title_class'] . '"' : '';

            $content = '[section-header' . $args . ']' . $content;
        }
    }

    if ( $section['footer'] === true ) {
        if ( !has_shortcode( $content, 'section-footer' ) ) {
            $args  = '';

            $content .= '[section-footer' . $args . ']';
        }
    }

    $content = ( $section['overlay'] === true ? '<div class="overlay"></div>' : '' ) . $content;

    $class  = 'section';
    $class .= ( $section['style'] ) ? ' bg-' . $section['style'] : '';
    $class .= ( $section['dark'] ) ? ' bg-dark' : '';
    $class .= ( $section['header'] === true ) ? ' has-header' : '';
    $class .= ( $section['class'] ) ? ' ' . $section['class'] : '';

    $style  = '';
    $style .= ( $section['style'] == 'image' && $section['image'] ) ? 'background-image: url(' . esc_url( wp_get_attachment_url( $section['image'] ) ) . ');' : '';
    $style  = ( $style == '' ) ? '' : ' style="' . esc_attr( $style ) . '"';

    ob_start();
    include( locate_template( 'content-highgrove_section.php' ) );
    $output = ob_get_clean();

    return $output;
}
add_shortcode( 'section', 'highgrove_section' );

function highgrove_section_header( $atts, $content = null ) {

    $header = shortcode_atts( array(
        'title' => null,
        'level' => 'h2',
        'size' => null,
        'deck' => null,
        'style' => null,
        'image' => null,
        'dark' => false,
        'container' => false,
        'overlay' => false,
        'break' => false,
        'class' => null,
        'title_class' => null,
    ), highgrove_normalize_atts( $atts ) );

    $args  = ' type="section"';
    $args .= ( $header['title'] ) ? ' title="' . $header['title'] . '"' : '';
    $args .= ' level="' . $header['level'] . '"';
    $args .= ( $header['size'] ) ? ' size="' . $header['size'] . '"' : '';
    $args .= ( $header['style'] ) ? ' style="' . $header['style'] . '"' : '';
    $args .= ( $header['image'] ) ? ' image="' . $header['image'] . '"' : '';
    $args .= ( $header['dark'] === true ) ? ' dark="true"' : '';
    $args .= ( $header['container'] === true ) ? ' container="true"' : '';
    $args .= ( $header['overlay'] === true ) ? ' overlay="true"' : '';
    $args .= ( $header['break'] === true ) ? ' break="true"' : '';
    $args .= ( $header['class'] ) ? ' class="' . $header['class'] . '"' : '';
    $args .= ( $header['title_class'] ) ? ' title_class="' . $header['title_class'] . '"' : '';

    $deck = ( $header['deck'] ) ? '<p>' . $header['deck'] . '</p>' : '';

    return do_shortcode( '[header' . $args . ']' . $deck . $content . '[/header]' );
}
add_shortcode( 'section-header', 'highgrove_section_header' );

function highgrove_section_footer( $atts, $content = null ) {

    $footer = shortcode_atts( array(
        'break' => false,
    ), highgrove_normalize_atts( $atts ) );

    $args  = ' type="section"';
    $args .= ( $footer['break'] === true ) ? ' break="true"' : '';

    return do_shortcode( '[footer' . $args . ']' . $content . '[/footer]' );
}
add_shortcode( 'section-footer', 'highgrove_section_footer' );

function highgrove_column( $atts, $content = null ) {

    $column = shortcode_atts( array(
        'small' => null,
        'medium' => null,
        'large' => null,
        'large_offset' => null,
        'first' => false,
        'last' => false,
        'class' => null,
    ), highgrove_normalize_atts( $atts ) );

    $class  = 'col';
    $class .= ( $column['small'] ) ? ' col-sm-' . $column['small'] : '';
    $class .= ( $column['medium'] ) ? ' col-md-' . $column['medium'] : '';
    $class .= ( $column['large'] ) ? ' col-lg-' . $column['large'] : '';
    $class .= ( $column['large_offset'] ) ? ' col-lg-offset-' . $column['large_offset'] : '';
    $class .= ( $column['class'] ) ? ' ' . $column['class'] : '';

    $output = '<div class="' . esc_attr( $class ) . '">' . do_shortcode( $content ) . '</div>';
    if ( $column['first'] === true ) {
        $output = '<div class="row">' . $output;
    }
    if ( $column['last'] === true ) {
        $output = $output . '</div>';
    }

    return $output;
}
add_shortcode( 'column', 'highgrove_column' );

function highgrove_break( $atts ) {

    $break = shortcode_atts( array(
        'class' => null,
    ), highgrove_normalize_atts( $atts ) );

    $class  = '';
    $class .= ( $break['class'] ) ? ' ' . $break['class'] : '';
    $class  = ( $class == '' ) ? '' : ' class="' . esc_attr( substr( $class, 1 ) ) . '"';

    return '<br' . $class . '>';
}
add_shortcode( 'break', 'highgrove_break' );

function highgrove_line( $atts ) {

    $line = shortcode_atts( array(
        'class' => null,
    ), highgrove_normalize_atts( $atts ) );

    $class  = '';
    $class .= ( $line['class'] ) ? ' ' . $line['class'] : '';
    $class  = ( $class == '' ) ? '' : ' class="' . esc_attr( substr( $class, 1 ) ) . '"';

    return '<hr' . $class . '>';
}
add_shortcode( 'line', 'highgrove_line' );

function highgrove_lead( $atts, $content = null ) {

    return '<p class="lead">' . do_shortcode( $content ) . '</p>';
}
add_shortcode( 'lead', 'highgrove_lead' );

function highgrove_address( $atts, $content = null ) {

    global $highgrove;

    $output  = '<address>';
    $output .= ( $highgrove['opt-contact-address'] ) ? '<i class="fa fa-home"></i>' . $highgrove['opt-contact-address'] . '<br>' : '';
    $output .= ( $highgrove['opt-contact-phone'] ) ? '<i class="fa fa-phone"></i>' . $highgrove['opt-contact-phone'] . '<br>' : '';
    $output .= ( $highgrove['opt-contact-mobile'] ) ? '<i class="fa fa-fax"></i>' . $highgrove['opt-contact-mobile'] . '<br>' : '';
    $output .= ( $highgrove['opt-contact-email'] ) ? '<i class="fa fa-envelope"></i><a href="mailto:' . $highgrove['opt-contact-email'] . '">' . $highgrove['opt-contact-email'] . '</a><br>' : '';
    $output .= ( $highgrove['opt-contact-skype'] ) ? '<i class="fa fa-skype"></i>' . $highgrove['opt-contact-skype'] . '<br>' : '';
    $output .= '</address>';

    return $output;
}
add_shortcode( 'address', 'highgrove_address' );

function highgrove_social( $atts, $content = null ) {

    global $highgrove;

    $output  = '<address>';
    $output .= ( $highgrove['opt-facebook'] ) ? '<i class="fa fa-facebook"></i><a href="' . esc_url( $highgrove['opt-facebook'] ) . '" target="_blank">' . __( 'Facebook', 'highgrove' ) . '</a><br>' : '';
    $output .= ( $highgrove['opt-twitter'] ) ? '<i class="fa fa-twitter"></i><a href="' . esc_url( $highgrove['opt-twitter'] ) . '" target="_blank">' . __( 'Twitter', 'highgrove' ) . '</a><br>' : '';
    $output .= ( $highgrove['opt-google-plus'] ) ? '<i class="fa fa-google-plus"></i><a href="' . esc_url( $highgrove['opt-google-plus'] ) . '" target="_blank">' . __( 'Google+', 'highgrove' ) . '</a><br>' : '';
    $output .= ( $highgrove['opt-instagram'] ) ? '<i class="fa fa-instagram"></i><a href="' . esc_url( $highgrove['opt-instagram'] ) . '" target="_blank">' . __( 'Instagram', 'highgrove' ) . '</a><br>' : '';
    $output .= ( $highgrove['opt-youtube'] ) ? '<i class="fa fa-youtube"></i><a href="' . esc_url( $highgrove['opt-youtube'] ) . '" target="_blank">' . __( 'YouTube', 'highgrove' ) . '</a><br>' : '';
    $output .= ( $highgrove['opt-tumblr'] ) ? '<i class="fa fa-tumblr"></i><a href="' . esc_url( $highgrove['opt-tumblr'] ) . '" target="_blank">' . __( 'Tumblr', 'highgrove' ) . '</a><br>' : '';
    $output .= ( $highgrove['opt-pinterest'] ) ? '<i class="fa fa-pinterest"></i><a href="' . esc_url( $highgrove['opt-pinterest'] ) . '" target="_blank">' . __( 'Pinterest', 'highgrove' ) . '</a><br>' : '';
    $output .= ( $highgrove['opt-linkedin'] ) ? '<i class="fa fa-linkedin"></i><a href="' . esc_url( $highgrove['opt-linkedin'] ) . '" target="_blank">' . __( 'LinkedIn', 'highgrove' ) . '</a><br>' : '';
    $output .= '</address>';

    return $output;
}
add_shortcode( 'social', 'highgrove_social' );

function highgrove_blockquote( $atts, $content = null ) {

    $blockquote = shortcode_atts( array(
        'reverse'   => false,
        'user'      => null,
    ), highgrove_normalize_atts( $atts ) );

    $header = '';
    if ( $blockquote['user'] ) {

        $user = get_userdata( $blockquote['user'] );

        $header .= '<header>';
        $header .= get_avatar( $user->ID, 128 );
        $header .= '<h4 class="title">' . ( $user->first_name ? $user->first_name . ' ' . $user->last_name : 'The Chef' ) . '</h4>';
        $header .= '<p>' . get_the_author_meta( 'nickname', $user->ID ) . '</p>';
        $header .= '</header>';
    }

    return '<blockquote>' . $header . do_shortcode( $content ) . '</blockquote>';
}
add_shortcode( 'blockquote', 'highgrove_blockquote' );

function highgrove_dropcap( $atts, $content = null ) {

    $dropcap = shortcode_atts( array(
        'inverse' => false,
    ), highgrove_normalize_atts( $atts ) );

    $class  = 'dropcap';
    $class .= ( $dropcap['inverse'] === true ) ? ' dropcap-inverse' : '';

    return '<p class="' . esc_attr( $class ) . '">' . do_shortcode( $content ) . '</p>';
}
add_shortcode( 'dropcap', 'highgrove_dropcap' );

function highgrove_button( $atts, $content = null ) {

    $button = shortcode_atts( array(
        'type' => 'button',
        'style' => 'default',
        'size' => null,
        'shape' => null,
        'block' => false,
        'icon' => false,
        'href' => '#',
        'class' => null,
    ), highgrove_normalize_atts( $atts ) );

    $icon = ( $button['icon'] ) ? '<i class="' . esc_attr( 'fa fa-' . $button['icon'] ) . '"></i>' : '';

    $class  = 'btn btn-' . $button['style'];
    $class .= ( $button['size'] ) ? ' btn-' . $button['size'] : '';
    $class .= ( $button['shape'] ) ? ' btn-' . $button['shape'] : '';
    $class .= ( $button['block'] === true ) ? ' btn-block' : '';
    $class .= ( $button['class'] ) ? ' ' . $button['class'] : '';

    $output = '';
    if ( $button['type'] == 'button' ) {
        $output = '<button class="' . esc_attr( $class ) . '" type="button">' . $icon . $content . '</button>';
    } elseif ( $button['type'] == 'link' ) {
        $output = '<a class="' . esc_attr( $class ) . '" href="' . esc_url( $button['href'] ) . '" role="button">' . $icon . $content . '</a>';
    } elseif ( $button['type'] == 'input' ) {
        $output = '<input class="' . esc_attr( $class ) . '" type="button" value="' . esc_attr( $content ) . '">';
    } elseif ( $button['type'] == 'submit' ) {
        $output = '<input class="' . esc_attr( $class ) . '" type="submit" value="' . esc_attr( $content ) . '">';
    }

    return $output;
}
add_shortcode( 'button', 'highgrove_button' );

function highgrove_icon( $atts, $content = null ) {

    $icon = shortcode_atts( array(
        'name' => null,
        'size' => null,
        'inverse' => false,
        'class' => null,
    ), highgrove_normalize_atts( $atts ) );

    if ( empty( $icon['name'] ) ) {
        return;
    }

    $class  = 'fa fa-' . $icon['name'];
    $class .= ( $icon['size'] ) ? ' fa-' . $icon['size'] : '';
    $class .= ( $icon['inverse'] ) ? ' fa-inverse' : '';
    $class .= ( $icon['class'] ) ? ' ' . $icon['class'] : '';

    $output = '<i class="' . esc_attr( $class ) . '"></i>';

    return $output;
}
add_shortcode( 'icon', 'highgrove_icon' );

function highgrove_nav( $atts, $content = null ) {

    global $highgrove_nav;

    $highgrove_nav = shortcode_atts( array(
        'type' => 'tabs',
        'toggle' => null,
        'class' => null,
    ), highgrove_normalize_atts( $atts ) );

    $class  = 'nav nav-' . $highgrove_nav['type'];
    $class .= ( $highgrove_nav['class'] ) ? ' ' . $highgrove_nav['class'] : '';

    $output  = '<ul class="' . esc_attr( $class ) . '">';
    $output .= do_shortcode( $content );
    $output .= '</ul>';

    return $output;
}
add_shortcode( 'nav', 'highgrove_nav' );

function highgrove_nav_item( $atts, $content = null ) {

    global $highgrove_nav;

    $item = shortcode_atts( array(
        'target' => null,
        'active' => false,
        'filter' => null,
        'class' => null,
    ), highgrove_normalize_atts( $atts ) );

    $target = ( $item['target'] ) ? $item['target'] : '#';

    $class  = '';
    $class .= ( $item['class'] ) ? ' ' . $item['class'] : '';
    $class .= ( $item['active'] === true ) ? ' active' : '';
    $class  = ( $class == '' ) ? '' : ' class="' . esc_attr( substr( $class, 1 ) ) . '"';

    $data = '';
    $data .= ( $highgrove_nav['toggle'] ) ? ' role="' . esc_attr( $highgrove_nav['toggle'] ) . '" data-toggle="' . esc_attr( $highgrove_nav['toggle'] ) . '"' : '';
    $data .= ( $item['filter'] ) ? ' data-filter="' . esc_attr( $item['filter'] ) . '"' : '';

    return '<li' . $class . '><a href="' . esc_url( $target ) . '"' . $data . '>' . do_shortcode( $content ) . '</a></li>';
}
add_shortcode( 'nav-item', 'highgrove_nav_item' );

function highgrove_label( $atts, $content = null ) {

    $label = shortcode_atts( array(
        'style' => 'default'
    ), highgrove_normalize_atts( $atts ) );

    return '<span class="' . esc_attr( 'label label-' . $label['style'] ) . '">' . $content . '</span>';
}
add_shortcode( 'label', 'highgrove_label' );

function highgrove_panel( $atts, $content = null ) {

    global $highgrove_panel;

    $highgrove_panel = shortcode_atts( array(
        'id' => null,
        'title' => null,
        'level' => 'h3',
        'collapse' => false,
        'parent' => null,
        'href' => null,
        'style' => 'default',
        'size' => null,
        'image' => null,
        'icon' => null,
        'icon_inverse' => false,
        'button' => null,
        'class' => null,
        'effect' => null,
        'effect_rel' => null,
        'effect_delay' => null,
    ), highgrove_normalize_atts( $atts ) );

    $header = '';
    if ( ! has_shortcode( $content, 'panel-header' ) ) {
        if ( $highgrove_panel['title'] ) {
            $image = ( $highgrove_panel['image'] ) ? ' image="' . $highgrove_panel['image'] . '"' : '';
            $icon_inverse = ( $highgrove_panel['icon_inverse'] === true ) ? ' icon_inverse="true"' : '';
            $icon = ( $highgrove_panel['icon'] ) ? ' icon="' . $highgrove_panel['icon'] . '"' . $icon_inverse : '';
            $header = '[panel-header title="' . $highgrove_panel['title'] . '" level="' . $highgrove_panel['level'] . '"' . $image . $icon . ']';
        }
        $content = '[body type="panel"]' . $content . '[/body]';
        if ( $highgrove_panel['collapse'] === true ) {
            $content = '[panel-collapse]' . $content . '[/panel-collapse]';
        }
    }

    $footer = '';
    if ( ! has_shortcode( $content, 'panel-footer' ) ) {
        if ( $highgrove_panel['button'] ) {
            $footer .= '[footer type="panel"]';
            $footer .= '[button type="link" size="sm" href="' . $highgrove_panel['href'] . '"]' . $highgrove_panel['button'] . '[/button]';
            $footer .= '[/footer]';
        }
    }

    $content = $header . $content . $footer;

    $id = ( $highgrove_panel['id'] ) ? ' id="' . esc_attr( $highgrove_panel['id'] ) . '"' : '';

    $class  = 'panel panel-' . $highgrove_panel['style'];
    $class .= ( $highgrove_panel['size'] ) ? ' panel-' . $highgrove_panel['size'] : '';
    $class .= ( $highgrove_panel['class'] ) ? ' ' . $highgrove_panel['class'] : '';

    $data  = '';
    $data .= ( $highgrove_panel['effect'] ) ? ' data-effect="' . esc_attr( $highgrove_panel['effect'] ) . '"' : '';
    $data .= ( $highgrove_panel['effect_rel'] ) ? ' data-effect-rel="' . esc_attr( $highgrove_panel['effect_rel'] ) . '"' : '';
    $data .= ( $highgrove_panel['effect_delay'] ) ? ' data-effect-delay="' . esc_attr( $highgrove_panel['effect_delay'] ) . '"' : '';

    $output  = '<div' . $id . ' class="' . esc_attr( $class ) . '"' . $data . '>';
    $output .= do_shortcode( $content );
    $output .= '</div>';

    return $output;
}
add_shortcode( 'panel', 'highgrove_panel' );

function highgrove_panel_header( $atts, $content = null ) {

    $header = shortcode_atts( array(
        'title' => null,
        'level' => 'h3',
        'image' => null,
        'icon' => null,
        'icon_inverse' => false,
    ), highgrove_normalize_atts( $atts ) );

    $image = ( $header['image'] ) ? wp_get_attachment_image( $header['image'], 'full', false, array( 'class' => 'img-circle img-thumbnail' ) ) : '';

    $icon_inverse = ( $header['icon_inverse'] === true ) ? ' inverse="true"' : '';
    $icon = ( $header['icon'] ) ? '[icon name="' . $header['icon'] . '"' . $icon_inverse . ' class="img-circle img-thumbnail"]' : '';

    return do_shortcode( '[header type="panel"]' . $image . $icon . '[panel-title level="' . $header['level'] . '"]' . $header['title'] . '[/panel-title]' . $content . '[/header]' );
}
add_shortcode( 'panel-header', 'highgrove_panel_header' );

function highgrove_panel_title( $atts, $content = null ) {

    global $highgrove_panel;

    $title = shortcode_atts( array(
        'level' => 'h3',
        'text' => null,
        'icon' => null,
    ), highgrove_normalize_atts( $atts ) );

    if ( $highgrove_panel['collapse'] === true ) {
        if ( $title['text'] ) {
            $content = '<a href="#" data-toggle="collapse" data-parent="' . esc_attr( $highgrove_panel['parent'] ) . '" data-target="#' . esc_attr( $highgrove_panel['id'] ) . '-collapse">' . $title['text'] . '</a>' . $content;
            $title['text'] = '';
        } else {
            $content = '<a href="#" data-toggle="collapse" data-parent="' . esc_attr( $highgrove_panel['parent'] ) . '" data-target="#' . esc_attr( $highgrove_panel['id'] ) . '-collapse">' . $content . '</a>';
        }
    }

    $icon = ( $title['icon'] ) ? '[icon name="' . $title['icon'] . '"]' : '';

    return do_shortcode( '[title type="panel" level="' . $title['level'] . '" text="' . $title['text'] . '"]' . $icon . $content . '[/title]' );
}
add_shortcode( 'panel-title', 'highgrove_panel_title' );

function highgrove_carousel( $atts, $content = null ) {

    global $highgrove_carousel;
    static $instance = 0;

    $highgrove_carousel = shortcode_atts( array(
        'id' => null,
        'indicators' => false,
        'controls' => false,
        'include' => null,
    ), highgrove_normalize_atts( $atts ) );

    $highgrove_carousel['size'] = 0;

    $id = ( $highgrove_carousel['id'] ) ? $highgrove_carousel['id'] : 'gallery-' . $instance++;

    ob_start();
    include( locate_template( 'comp/carousel.php' ) );
    $highgrove_carousel = ob_get_clean();

    return $highgrove_carousel;
}
add_shortcode( 'carousel', 'highgrove_carousel' );

function highgrove_carousel_item( $atts, $content = null ) {

    global $highgrove_carousel;

    $item = shortcode_atts( array(
        'id' => null,
        'active' => false,
    ), highgrove_normalize_atts( $atts ) );

    $item['index'] = $highgrove_carousel['size'];
    $highgrove_carousel['size']++;
    $class = 'item';

    if ( $item['active'] === true ) {
        $highgrove_carousel['active'] = $item['index'];
        $class .= ' active';
    }

    if ( $item['id'] ) {

        switch( get_post_type( $item['id'] ) ) {

            case 'attachment':
                $content = wp_get_attachment_image( $item['id'], 'xlarge' );
                break;

            default:
                break;
        }
    }

    $output  = '<div class="' . esc_attr( $class ) . '">';
    $output .= do_shortcode( $content );
    $output .= '</div>';

    return $output;
}
add_shortcode( 'carousel-item', 'highgrove_carousel_item' );

function highgrove_reel( $atts, $content = null ) {

    $reel = shortcode_atts( array(
        'id' => null,
        'order' => 'desc',
        'limit' => 12
    ), highgrove_normalize_atts( $atts ) );

    $args['meta_query'] = array( array( 'key' => '_thumbnail_id' ) );
    $args['order'] = strtoupper( $reel['order'] );
    $args['posts_per_page'] = $reel['limit'];

    ob_start();
    include( locate_template( 'comp/reel.php' ) );
    $output = ob_get_clean();

    return $output;
}
add_shortcode( 'reel', 'highgrove_reel' );

function highgrove_isotope( $atts, $content = null ) {

    if ( ! empty( $atts['columns'] ) ) {
        $atts['cols'] = $atts['columns'];
    }

    $isotope = shortcode_atts( array(
        'id' => null,
        'cols' => 4,
        'columns' => null,
        'compact' => false,
        'filters' => false,
        'filters_tags' => null,
        'post_type' => null,
        'dish_category' => null,
    ), highgrove_normalize_atts( $atts ) );

    if ( ! $content ) {

        global $post;

        $args = array(
            'post_type' => $isotope['post_type'],
            'nopaging'  => true,
        );

        if ( ! empty( $isotope['dish_category'] ) ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'highgrove_dish_category',
                    'field' => 'slug',
                    'terms' => $isotope['dish_category']
                )
            );
        }

        $posts = get_posts( $args );

        $content = '';
        foreach ( $posts as $post ) {

            setup_postdata( $post );

            $background = ( get_field( '_lg_header_style' ) == 'parallax' ) ? 'image' : get_field( '_lg_header_style' );
            $dark = ( get_field( '_lg_header_dark' ) == '1' ) ? ' dark="true"' : '';

            $class = '';
            //$class = implode( ' ', wp_get_post_terms( get_the_ID(), array( 'tier', 'stage', 'weekday' ), array( 'fields' => 'slugs' ) ) );

            $content .= '[isotope-item post="' . get_the_ID() . '"' . ' background="' . $background . '"' . $dark . ' class="' . $class . '"]';

        }
        wp_reset_postdata();
    }

    $nav = '';
    if ( $isotope['filters'] === true || ! empty( $isotope['filters_tags'] ) ) {

        global $highgrove;

        $tags = ( ! empty( $isotope['filters_tags'] ) ) ? $isotope['filters_tags'] : $highgrove['opt-menu-filters-tags'];
        $tags = str_replace( ' ', '', $tags );
        $tags = explode( ',', $tags );

        $nav = '[nav type="pills" class="nav-isotope hidden-xs"]';
        foreach ( $tags as $tag ) {
            $nav .= '[nav-item filter=".' . $tag . '"]<i class="fa fa-' . ( ( $icon = get_field( '_lg_post_tag_icon', get_term_by( 'name', $tag, 'post_tag' ) ) ) ? $icon : 'cutlery' ) . '"></i>' . $tag . '<hr>[/nav-item]';
        }
        $nav .= '[/nav]';
    }

    $class  = 'isotope';
    $class .= ' isotope-col-lg-' . ( 12 / $isotope['cols'] );
    $class .= ( $isotope['compact'] === true ) ? ' isotope-compact' : '';

    $output  = do_shortcode( $nav );
    $output .= '<div class="' . esc_attr( $class ) . '">';
    $output .= '<div class="column-sizer"></div>';
    $output .= '<div class="gutter-sizer"></div>';
    $output .= do_shortcode( $content );
    $output .= '</div>';

    return $output;
}
add_shortcode( 'isotope', 'highgrove_isotope' );

function highgrove_isotope_item( $atts, $content = null ) {

    global $post;

    $item = shortcode_atts( array(
        'post' => null,
        'wide' => false,
        'tall' => false,
        'background' => null,
        'dark' => false,
        'overlay' => false,
        'class' => null
    ), highgrove_normalize_atts( $atts ) );

    if ( ! $item['post'] ) {
        return;
    }

    $post = get_post( $item['post'] );

    setup_postdata( $post );

    $class  = 'item';
    $class .= ( $item['wide'] === true ) ? ' item-wide' : '';
    $class .= ( $item['tall'] === true ) ? ' item-tall' : '';
    $class .= ' ' . implode( wp_get_post_tags( get_the_ID(), array( 'fields' => 'names' ) ), ' ' );
    $class .= ( $item['class'] ) ? ' ' . $item['class'] : '';

    $output = '<div class="' . esc_attr( $class ) . '">';
    ob_start();
    include( locate_template( 'content-simple.php' ) );
    $output .= ob_get_clean();
    $output .= '</div>';

    wp_reset_postdata();

    return $output;
}
add_shortcode( 'isotope-item', 'highgrove_isotope_item' );

function highgrove_board( $atts, $content = null ) {

    $board = shortcode_atts( array(
        'id' => null,
    ), highgrove_normalize_atts( $atts ) );

    $output  = '<div class="isotope isotope-compact isotope-col-lg-6 board">';
    $output .= '<div class="column-sizer"></div>';
    $output .= '<div class="gutter-sizer"></div>';
    $output .= do_shortcode( $content );
    $output .= '</div>';

    return $output;
}
add_shortcode( 'board', 'highgrove_board' );

function highgrove_board_item( $atts, $content = null ) {

    global $post;

    $item = shortcode_atts( array(
        'post'      => null,
        'size'      => null,
        'inverse'   => false,
        'style'     => 'alter',
        'icon'      => null,
        'class'     => null,
    ), highgrove_normalize_atts( $atts ) );

    if ( ! $item['post'] ) {
        return;
    }

    $post = get_post( $item['post'] );

    setup_postdata( $post );

    $class  = 'item';
    $class .= ( $item['size'] ) ? ' item-' . $item['size'] : '';
    $class .= ( $item['inverse'] === true ) ? ' item-inverse' : '';
    $class .= ' item-' . $item['style'];
    $class .= ( $item['class'] ) ? ' ' . $item['class'] : '';

    $output = '<div class="' . esc_attr( $class ) . '">';
    ob_start();
    include( locate_template( 'content-highgrove_event-board.php' ) );
    $output .= ob_get_clean();
    $output .= '</div>';

    wp_reset_postdata();

    return $output;
}
add_shortcode( 'board-item', 'highgrove_board_item' );

function highgrove_menu( $atts, $content = null ) {

    if ( ! empty( $atts['columns'] ) ) {
        $atts['cols'] = $atts['columns'];
    }

    $menu = shortcode_atts( array(
        'id' => null,
        'cols' => 3,
        'columns' => null,
        'compact' => true,
        'filters' => true,
        'filters_tags' => null,
        'category' => null,
    ), highgrove_normalize_atts( $atts ) );

    $cols = ' cols="' . $menu['cols'] . '"';
    $compact = ( $menu['compact'] === true ) ? ' compact="true"' : '';
    $filters = ( $menu['filters'] === true ) ? ' filters="true"' : '';
    $filters_tags = ( ! empty( $menu['filters_tags'] ) ) ? ' filters_tags="' . $menu['filters_tags'] . '"' : '';
    $category = ( $menu['category'] ) ? ' dish_category="' . $menu['category'] . '"' : '';

    $output = '[isotope ' . $cols . $compact . $filters . $filters_tags . ' post_type="highgrove_dish"' . $category . ']';

    return do_shortcode( $output );
}
add_shortcode( 'menu', 'highgrove_menu' );

/*
 * Normalize shortcode attributes.
 */
if ( ! function_exists( 'highgrove_normalize_atts' ) ) {
    function highgrove_normalize_atts( $atts ) {
        if ( $atts ) {
            foreach ( $atts as $key => $value ) {
                if ( $value == 'true' ) {
                    $atts[$key] = true;
                } elseif ( $value == 'false' ) {
                    $atts[$key] = false;
                }
            }
        }
        return $atts;
    }
}