<?php

// $al_cat_slug = get_queried_object()->slug;
// $al_cat_name = get_queried_object()->name;

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$args = array(
    'post_type'         => 'portfolio',
    'posts_per_page'    => 5,
    'paged'             => $paged
);

$loop = new WP_Query( $args );
if ( $loop->have_posts() ) :
    while ( $loop->have_posts() ) : $loop->the_post(); ?>

    <article <?php post_class( 'row' ); ?>>
        <?php if ( has_post_thumbnail() ): ?>
            <div class="portfo_thumbnail col-md-6">
                <?php porto_post_thumbnail(); ?>
            </div>
        <?php endif; ?>
        <div class="portfo_content col-md-6">
            <header>
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            </header>
            <div class="entry-summary">
                <?php the_excerpt(); ?>
            </div>
        </div>
    </article>

    <?php endwhile; ?>

    <!-- pagination here -->
    <?php
        if ( function_exists('porto_pagination') ) {
            porto_pagination( $loop->max_num_pages, "", $paged);
        }
    ?>

    <?php wp_reset_postdata(); ?>

<?php else:  ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
