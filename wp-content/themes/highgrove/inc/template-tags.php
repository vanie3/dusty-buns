<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage Highgrove
 */

if ( ! function_exists( 'highgrove_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function highgrove_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'highgrove' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'highgrove' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'highgrove' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'highgrove_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function highgrove_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

    if ( ! is_single() ) {
        return;
    }

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'highgrove' ); ?></h1>
		<div class="nav-links">

			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">Previous Post</span><br>%title', 'Previous post link', 'highgrove' ) );
				next_post_link( '<div class="nav-next">%link</div>', _x( '<span class="meta-nav">Next Post</span><br>%title', 'Next post link', 'highgrove' ) );
			?>
			
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'highgrove_entry_categories' ) ) :
/**
 * Prints HTML with meta information for the categories.
 */
function highgrove_entry_categories() {
    // Hide category text for pages.
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list( __( ', ', 'highgrove' ) );

        if ( $categories_list && highgrove_categorized_blog() ) {
            printf( '<span class="cat-links">%1$s</span>', $categories_list );
        }
    }
}
endif;

if ( ! function_exists( 'highgrove_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function highgrove_posted_on( $template = null ) {

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated hidden" datetime="%3$s">%4$s</time>';
	}

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        get_the_date(),
        esc_attr( get_the_modified_date( 'c' ) ),
        get_the_modified_date()
    );

    if ( get_post_format() && ! isset( $template ) ) {
        printf( '<li class="entry-format"> %s</li>', get_post_format() );
    }

	$posted_on = sprintf(
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$bypostauthor = sprintf(
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

    printf( '<li class="posted-on"> %s</li>', $posted_on );

    if ( ! isset( $template ) ) {
        printf( '<li class="bypostauthor"> %s</li>', $bypostauthor );
    }
}
endif;

if ( ! function_exists( 'highgrove_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the tags and comments.
 */
function highgrove_entry_footer() {

	// Hide tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', ' ' );
		if ( $tags_list ) {
			printf( '<span class="tags-links">%1$s</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link hidden">';
		comments_popup_link( __( 'Leave a comment', 'highgrove' ), __( '1 Comment', 'highgrove' ), __( '% Comments', 'highgrove' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'highgrove' ), '<span class="edit-link hidden">', '</span>' );
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( __( 'Category: %s', 'highgrove' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag: %s', 'highgrove' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', 'highgrove' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Year: %s', 'highgrove' ), get_the_date( _x( 'Y', 'yearly archives date format', 'highgrove' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Month: %s', 'highgrove' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'highgrove' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', 'highgrove' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'highgrove' ) ) );
	} elseif ( is_tax( 'post_format', 'post-format-aside' ) ) {
		$title = _x( 'Asides', 'post format archive title', 'highgrove' );
	} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
		$title = _x( 'Galleries', 'post format archive title', 'highgrove' );
	} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
		$title = _x( 'Images', 'post format archive title', 'highgrove' );
	} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
		$title = _x( 'Videos', 'post format archive title', 'highgrove' );
	} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
		$title = _x( 'Quotes', 'post format archive title', 'highgrove' );
	} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
		$title = _x( 'Links', 'post format archive title', 'highgrove' );
	} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
		$title = _x( 'Statuses', 'post format archive title', 'highgrove' );
	} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
		$title = _x( 'Audio', 'post format archive title', 'highgrove' );
	} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
		$title = _x( 'Chats', 'post format archive title', 'highgrove' );
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'highgrove' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'highgrove' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', 'highgrove' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function highgrove_categorized_blog() {

	if ( false === ( $all_the_cool_cats = get_transient( 'highgrove_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'highgrove_categories', $all_the_cool_cats );
	}
	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so highgrove_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so highgrove_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in highgrove_categorized_blog.
 */
function highgrove_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'highgrove_categories' );
}
add_action( 'edit_category', 'highgrove_category_transient_flusher' );
add_action( 'save_post',     'highgrove_category_transient_flusher' );

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 *
 * @since Highgrove 1.0
 */
function highgrove_post_thumbnail( $template = null ) {
    if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
        return;
    }

    if ( get_post_type() == 'highgrove_dish' ) :
        the_post_thumbnail( 'highgrove-small', array( 'class' => 'img-responsive img-circle img-thumbnail' ) );
    elseif ( is_single() ) :
        the_post_thumbnail( 'highgrove-large', array( 'class' => 'img-responsive' ) );
    else : ?>
<!-- Commented out these lines because I didn't want an anchor tag on the image -->
        <!-- <a href="<?php the_permalink(); ?>">
            <i class="fa fa-link"></i> -->
            <?php
            if ( $template == 'simple' ) {
                the_post_thumbnail( 'highgrove-medium', array( 'class' => 'img-responsive' ) );
            } else {
                the_post_thumbnail( 'highgrove-large', array( 'class' => 'img-responsive' ) );
            }
            ?>
       <!--  </a> -->
    <?php endif;
}

function highgrove_comment( $comment, $args, $depth ) {

    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard">
        <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        <?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
    </div>
    <?php if ( $comment->comment_approved == '0' ) : ?>
        <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'highgrove' ); ?></em>
        <br />
    <?php endif; ?>

    <div class="comment-meta commentmetadata">
        <?php
        /* translators: 1: date, 2: time */
        printf( __('%1$s at %2$s', 'highgrove'), get_comment_date(),  get_comment_time() ); ?><?php edit_comment_link( __( 'Edit', 'highgrove' ), ' // ', '' );
        ?>
    </div>

    <div class="comment-content">
        <?php comment_text(); ?>
    </div>

    <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
        </div>
    <?php endif; ?>
<?php
}