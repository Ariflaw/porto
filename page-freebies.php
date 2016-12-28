<?php
/**
 * Template Name: Freebies Page
 */
?>
<div class="row">
<?php

    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

    $args = array(
        'post_type' => 'freebies',
        'posts_per_page' => 3,
        'paged' => $paged
    );

    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ) :
        while ( $loop->have_posts() ) : $loop->the_post(); ?>
        <article <?php post_class('col-md-4' ); ?>>
            <?php if ( has_post_thumbnail() ): ?>
                <div class="post_thumbnail">
                    <a class="post_thumbnail_link" href="<?php the_permalink(); ?>" aria-hidden="true">
                	    <?php the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) ); ?>
                	</a>
                </div>
            <?php endif; ?>
            <div class="post_content">
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
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
    </div>
    <?php else:  ?>
        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php endif; ?>


    <ul id="filters">
        <li><a href="#" data-filter="*" class="selected">All</a></li>

        <?php
        // Get post type taxonomies.
        $terms = get_terms( "freebies-category" );

        // $terms = get_the_terms($post->ID, 'freebies-category' ); // get all categories, but you can use any taxonomy
        $count = count( $terms ); //How many are they?
        if ( $count > 0 ){  //If there are more than 0 terms
            foreach ( $terms as $term ) {  //for each term:
                echo "<li><a href='#' data-filter='.".$term->slug."'>" . $term->name . "</a></li>\n";
                //create a list item with the current term slug for sorting, and name for label
            }
        }
        ?>
    </ul>

    <?php

    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

    $args = array(
       'post_type'      => 'freebies',
    //    'posts_per_page' => -1,
       'posts_per_page' => 3,
       'orderby'        => 'menu_order',
       'paged' => $paged
    );

        $the_query = new WP_Query( $args ); //Check the WP_Query docs to see how you can limit which posts to display
    ?>
    <?php if ( $the_query->have_posts() ) : ?>
        <div id="isotope-list">
            <?php while ( $the_query->have_posts() ) : $the_query->the_post();
            $termsArray = get_the_terms( $post->ID, "freebies-category" );  //Get the terms for this particular item
            $termsString = ""; //initialize the string that will contain the terms
            foreach ( $termsArray as $term ) { // for each term
                $termsString .= $term->slug.' '; //create a string that has all the slugs
            }
            ?>
            <div class="<?php echo $termsString; ?> item"> <?php // 'item' is used as an identifier (see Setp 5, line 6) ?>
                <h3><?php the_title(); ?></h3>
                <?php if ( has_post_thumbnail() ) {
                    //   the_post_thumbnail();
                } ?>
            </div> <!-- end item -->
        <?php endwhile;  ?>
    </div> <!-- end isotope-list -->
    <?php
        if ( function_exists('custom_pagination') ) {
            custom_pagination( $loop->max_num_pages, "", $paged);
        }
    ?>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>
