<?php
/**
 * Template Name: Homepage
 */
?>

<?php

    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

    $args = array(
        'post_type' => 'freebies',
        'posts_per_page' => 1,
        'paged' => $paged
    );

    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ) :
        while ( $loop->have_posts() ) : $loop->the_post(); ?>

        <h2>Plugin Template homepage</h2>

        <article <?php post_class( ); ?>>
            <?php if ( has_post_thumbnail() ): ?>
                <div class="post_thumbnail col-md-6">
                    <?php porto_post_thumbnail(); ?>
                </div>
            <?php endif; ?>
            <div class="post_content <?php echo $grid; ?>">
                <?php Roots\Sage\Extras\porto_categories(); ?>
                <header>
                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php get_template_part('templates/entry-meta'); ?>
                </header>
                <div class="entry-summary">
                    <?php the_excerpt(); ?>
                </div>
            </div>
        </article>

        <?php endwhile; ?>

        <!-- pagination here -->
        <?php
            if ( function_exists('custom_pagination') ) {
                custom_pagination( $loop->max_num_pages, "", $paged);
            }
        ?>

        <?php wp_reset_postdata(); ?>

    <?php else:  ?>
        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php endif; ?>
