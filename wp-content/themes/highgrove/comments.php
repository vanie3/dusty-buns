<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Highgrove
 * @since Highgrove 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<section id="comments" class="section comments-area">

    <?php if ( have_comments() ) : ?>

        <header class="section-header">
            <h2 class="section-title comments-title">
                <?php
                printf( _n( 'Comment', 'Comments (%1$s)', get_comments_number(), 'highgrove' ),
                    number_format_i18n( get_comments_number() ), get_the_title() );
                ?>
            </h2>
        </header>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'highgrove' ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'highgrove' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'highgrove' ) ); ?></div>
            </nav><!-- #comment-nav-above -->
        <?php endif; // Check for comment navigation. ?>

        <ol class="comment-list">
            <?php
            wp_list_comments( array(
                'style' => 'ol',
                'callback' => 'highgrove_comment',
                'short_ping' => true,
                'avatar_size'=> 96,
            ) );
            ?>
        </ol><!-- .comment-list -->

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'highgrove' ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'highgrove' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'highgrove' ) ); ?></div>
            </nav><!-- #comment-nav-below -->
        <?php endif; // Check for comment navigation. ?>

        <?php if ( ! comments_open() ) : ?>
            <p class="no-comments"><?php _e( 'Comments are closed.', 'highgrove' ); ?></p>
        <?php endif; ?>

    <?php endif; // have_comments() ?>

    <?php

    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );

    $args = array(
        'fields' => array(
            'author' => '<div class="row"><div class="col-lg-6"><p class="comment-form-author"><label class="sr-only" for="author">' . __( 'Name', 'highgrove' ) . '</label> ' .
                '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                '" placeholder="' . __( 'Name', 'highgrove' ) . '"' . $aria_req . ' /></p></div>',
            'email' => '<div class="col-lg-6"><p class="comment-form-email"><label class="sr-only" for="email">' . __( 'Email', 'highgrove' ) . '</label> ' .
                '<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                '" placeholder="' . __( 'Email', 'highgrove' ) . '"' . $aria_req . ' /></p></div>',
            'url' => '<div class="col-lg-12"><p class="comment-form-url"><label class="sr-only" for="url">' . __( 'Website', 'highgrove' ) . '</label>' .
                '<input id="url" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
                '" placeholder="' . __( 'Website', 'highgrove' ) . '" /></p></div></div>',
        ),
        'comment_field' => '<div class="row"><div class="col-lg-12"><p class="comment-form-comment"><label class="sr-only" for="comment">' . _x( 'Comment', 'noun', 'highgrove' ) . '</label><textarea id="comment" class="form-control" name="comment" rows="6" placeholder="' . __( 'Message', 'highgrove' ) . '" aria-required="true"></textarea></p></div></div>',
        'comment_notes_after' => '',
        'id_submit' => 'submit-comment',
    ); ?>

    <?php comment_form( $args ); ?>

</section><!-- #comments -->