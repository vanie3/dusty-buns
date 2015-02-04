<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Highgrove
 * @since Highgrove 1.0
 */

get_header(); ?>

    <div class="container">

        <div class="row">

            <div class="col-lg-9">

                <main id="main" class="site-main" role="main">

                    <section class="section error-404 not-found">

                        <header class="section-header">
                            <h1 class="section-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'highgrove' ); ?></h1>
                        </header>

                        <div class="section-content">
                            <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'highgrove' ); ?></p>

                            <?php //get_search_form(); ?>
                        </div>

                    </section>

                </main>

            </div>

            <div class="col-lg-3">
                <?php get_sidebar( 'content' ); ?>
            </div>

        </div>

    </div>

<?php get_footer();