<?php
/**
 * The template used for displaying careers content in career.php
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
<!--==========Modified by greg===========-->
            <?php the_excerpt(); ?>
<!--==================================-->
            <?php if ( get_field( '_lg_header_break' ) == '1' ) : ?><hr><?php endif; ?>

		</div>

	</header>
    <?php endif; ?>

    <?php if ( $container = get_field( '_lg_container' ) == '1' ) : ?>
    <div class="<?php echo 'container' . ( get_field( '_lg_container_type' ) == 'default' ? '' : '-' . esc_attr( get_field( '_lg_container_type' ) ) ); ?>">
    <?php endif; ?>
        <div class="container">
            <div class="row">
                <div class="col-md-9 marg">
                    <?php the_content(); ?>
                </div>
                <div class="col-md-3">
<!--ADDS THE CAREERS POST TYPE TO THE CAREER TEMPLATE PAGE-->
			        <?php

			            //get the event custom post types
			            $type = 'career';
			            $args = array(
			                'post_type'        => $type,
			                'post_status'      => 'publish',
			                'order'            => 'ASC',
			                'orderby'          => 'meta_value_num',
			                'posts_per_page'   => -1,

			            );

			            $my_query = null;
			            $my_query = new WP_Query($args);
					?>
		            <?php if ($my_query->have_posts()): while($my_query->have_posts()): $my_query->the_post();?>


		                   <!--  <div class="row"> -->
		                        <h2><?php the_title(); ?></h2>
		                        <p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_excerpt();?></a></p>
		                    	<hr>
		                    <!-- </div> -->
		                
		            <?php endwhile; endif; wp_reset_postdata(); ?>
<!--================================-->
				</div>
            </div>
        </div>
    <?php if ( $container ) : ?>
    </div>
    <?php endif; ?>

</article>