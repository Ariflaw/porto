<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');


/**
 * Clean up the_excerpt()
 * https://developer.wordpress.org/reference/functions/the_excerpt/
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '" class="read_more" rel="nofollow">' . __('Read more', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', __NAMESPACE__ . '\\excerpt_length', 999 );


if ( ! function_exists( 'porto_categories' ) ) :
/**
 * Prints HTML with category and tags for current post.
 *
 * Create your own porto_entry_taxonomies() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 */
function porto_categories() {

    if ( is_single() ) {
    	$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'porto' ) );
    	if ( $categories_list && porto_categorized_blog() ) {
    		printf( '<div class="cat-links dot"><span>%1$s </span>%2$s</div>',
    			__( 'Post in', 'Used before category names.', 'porto' ),
    		   $categories_list
    		);
            // echo $categories_list;
    	}
    } else {
        // Category Background with ACF
        // http://wordpress.stackexchange.com/questions/219820/single-php-category-entries-not-showing-right-colours
        $post_categories = get_the_category();
        if ( $post_categories ) {
            $separator = ' ';
            $output    = '';

            $output .= '<ul class="cat-links">';
            foreach( $post_categories as $post_category ) {
                $category_color = get_field( 'category_color', $post_category );
                $output .= '<li>';
                    $output .= '<a style="background-color:' . $category_color . ';" href="' . esc_url( get_category_link( $post_category ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'mytheme' ), $post_category->name ) ) . '">' . esc_html( $post_category->name ) . '</a>' . $separator;
                $output .= '</li>';
            }
            $output .= '</ul>';

            echo trim( $output, $separator );
        }
    }

}
endif;


if ( ! function_exists( 'porto_categorized_blog' ) ) :
/**
 * Determines whether blog/site has more than one category.
 *
 * Create your own twentysixteen_categorized_blog() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @return bool True if there is more than one category, false otherwise.
 */
function porto_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'porto_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'porto_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so twentysixteen_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so twentysixteen_categorized_blog should return false.
		return false;
	}
}
endif;

/**
 * Flushes out the transients used in twentysixteen_categorized_blog().
 *
 * @since Twenty Sixteen 1.0
 */
function porto_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'twentysixteen_categories' );
}
add_action( 'edit_category', __NAMESPACE__ . '\\porto_category_transient_flusher' );
add_action( 'save_post',     __NAMESPACE__ . '\\porto_category_transient_flusher' );


if ( ! function_exists( 'porto_tags' ) ) :
/**
 * Prints HTML with tags for current post.
 *
 * Create your own porto_tags() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 */
function porto_tags() {
	$tags_list = get_the_tag_list( '', _x( '', 'Used between list items, there is a space after the comma.', 'twentysixteen' ) );
	if ( $tags_list ) {
		printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
			_x( 'Tags', 'Used before tag names.', 'twentysixteen' ),
			$tags_list
		);
	}
}
endif;


if ( ! function_exists( 'porto_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 *
 * @since Twenty Fourteen 1.0
 * @since Twenty Fourteen 1.4 Was made 'pluggable', or overridable.
 */
function porto_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}
	?>
	<a class="post_thumbnail_link" href="<?php the_permalink(); ?>" aria-hidden="true">
	    <?php the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) ); ?>
	</a>
	<?php
}
endif;


if ( ! function_exists( 'pagination_nav' ) ) :
/*
 * How to add numeric pagination in your WordPress theme
 * http://www.wpbeginner.com/wp-themes/how-to-add-numeric-pagination-in-your-wordpress-theme/
 */
function pagination_nav() {
    if( is_singular() )
        return;
    global $wp_query;
    /* Stop the code if there is only a single page page */
    if( $wp_query->max_num_pages <= 1 )
        return;
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
    /*Add current page into the array */
    if ( $paged >= 1 )
        $links[] = $paged;
    /*Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
    echo '<div class="navigation"><ul>' . "\n";
    /*Display Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link( esc_html('Prev') ) );
    /*Display Link to first page*/
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }
    /* Link to current page */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        // printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
    /* Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li><span>…</span></li>' . "\n";
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link( esc_html('Next') ) );
    echo '</ul></div>' . "\n";
}
endif;

/**
 * ============================================================================
 *
 * COOMENTS FORM CUSTOM
 * https://gist.github.com/codingfriendsnippets/a5245bc1f231211074e1
 *
 * ============================================================================
 */
if ( ! function_exists('customize_comment_form_fields') ) {
    function customize_comment_form_fields( $fields ) {
        $commenter = wp_get_current_commenter();
        $req      = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;

        $fields   =  array(
            'author' => '<div class="row"><div class="form-group comment-form-author col-md-4">' . '<label for="author" class="hidden">' . __( 'Name ', 'text_domain' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
            '<input class="form-control" id="author" placeholder="Name *" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
            'email'  => '<div class="form-group comment-form-email col-md-4"><label for="email" class="hidden">' . __( 'Email', 'text_domain' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
            '<input class="form-control" id="email" placeholder="Email *" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
            'url'    => '<div class="form-group comment-form-url col-md-4"><label for="url" class="hidden">' . __( 'Website', 'text_domain' ) . '</label> ' .
            '<input class="form-control" id="url" placeholder="Website" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div></div>',
        );

        return $fields;
    }
    add_filter( 'comment_form_default_fields', __NAMESPACE__ . '\\customize_comment_form_fields' );
}

if ( ! function_exists('customize_comment_form') ) {
    function customize_comment_form( $args ) {
        $args['id_submit'] = 'delete-submit';
        $args['comment_field'] = '<div class="form-group comment-form-comment">
        <label for="comment" class="hidden">' . _x( 'Comment', 'text_domain' ) . '</label>
        <textarea class="form-control" id="comment" placeholder="Messages..." name="comment" cols="45" rows="10" aria-required="true"></textarea>
        </div>';
        return $args;
    }
    add_filter( 'comment_form_defaults', __NAMESPACE__ . '\\customize_comment_form' );
}

function wpb_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}

add_filter( 'comment_form_fields', __NAMESPACE__ . '\\wpb_move_comment_field_to_bottom' );



/**
 * WordPress' missing is_blog_page() function.  Determines if the currently viewed page is
 * one of the blog pages, including the blog home page, archive, category/tag, author, or single
 * post pages.
 *
 * @return bool
 */
function is_blog_page() {

    global $post;

    //Post type must be 'post'.
    $post_type = get_post_type($post);

    //Check all blog-related conditional tags, as well as the current post type,
    //to determine if we're viewing a blog page.
    return (
        ( is_home() || is_archive() || is_author() || is_category() || is_tag() )
        && ($post_type == 'post')
    ) ? true : false ;

}


function header_img_bg() {

    if ( is_single() && has_post_thumbnail( ) ) {
        echo 'style="background-image: url('. get_the_post_thumbnail_url() .');"';
    } elseif ( is_single() ) {
        echo '';
    }else {
        echo "style=\"background-image: url('". esc_url( get_header_image() ) ."');\"";
    }

}

/**
 * ============================================================================
 * CUSTOM FUNCTION
 * ============================================================================
 */

// function to display number of posts.
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

function setPostViews($postID) {
    // http://wordpress.stackexchange.com/questions/65222/views-count-with-time-limit-per-ip

    $user_ip = $_SERVER['REMOTE_ADDR']; //retrieve the current IP address of the visitor
    $key = $user_ip . 'x' . $postID; //combine post ID & IP to form unique key
    $value = array($user_ip, $postID); // store post ID & IP as separate values (see note)
    $visited = get_transient($key); //get transient and store in variable

    //check to see if the Post ID/IP ($key) address is currently stored as a transient
    if ( false === ( $visited ) ) {

        //store the unique key, Post ID & IP address for 12 hours if it does not exist
        set_transient( $key, $value, 60*60*12 );

        // now run post views function
        $count_key = 'views';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        }else{
            $count++;
            update_post_meta($postID, $count_key, $count);
        }


    }

}


function legal_station_post_love_display( ) {
    $love_text = '';
    $love = get_post_meta( get_the_ID(), 'post_love', true );
    $love = ( empty( $love ) ) ? 0 : $love;
    $love_text = '<p class="love-received">
                    <a class="love-button" href="' . admin_url( 'admin-ajax.php?action=post_love_add_love&post_id=' . get_the_ID() ) . '" data-id="' . get_the_ID() . '">
                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                        <span id="love-count-'.get_the_ID().'">'.$love.' </span>
                    </a>
                 </p>';
    return $love_text;
}

add_action( 'wp_ajax_nopriv_legal_station_post_love_add_love', __NAMESPACE__ . '\\legal_station_post_love_add_love' );
add_action( 'wp_ajax_legal_station_post_love_add_love', __NAMESPACE__ . '\\legal_station_post_love_add_love' );
function legal_station_post_love_add_love() {
    $love = get_post_meta( $_POST['post_id'], 'post_love', true );
    $love++;
    if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
        update_post_meta( $_POST['post_id'], 'post_love', $love );
        echo $love;
    }
    die();
}


// http://wpsites.org/like-button-without-plugin-10570/
// function legal_station_post_love_display( ) {
//     global $post;
//     $like_text = '';
//     if ( is_single() ) {
//         $nonce = wp_create_nonce( 'pt_like_it_nonce' );
//         $link = admin_url('admin-ajax.php?action=pt_like_it&post_id='.$post->ID.'&nonce='.$nonce);
//         $likes = get_post_meta( get_the_ID(), '_pt_likes', true );
//         $likes = ( empty( $likes ) ) ? 0 : $likes;
//         $like_text = '
//                     <div class="pt-like-it">
//                         <a class="like-button" href="'.$link.'" data-id="' . get_the_ID() . '" data-nonce="' . $nonce . '">' .
//                         __( 'Like it' ) .
//                         '</a>
//                         <span id="like-count-'.get_the_ID().'" class="like-count">' . $likes . '</span>
//                     </div>';
//     }
//     return $like_text;
// }
//
//
// add_action( 'wp_ajax_nopriv_pt_like_it', __NAMESPACE__ . '\\pt_like_it' );
// add_action( 'wp_ajax_pt_like_it', __NAMESPACE__ . '\\pt_like_it' );
// function pt_like_it() {
//
//     if ( ! wp_verify_nonce( $_REQUEST['nonce'], 'pt_like_it_nonce' ) || ! isset( $_REQUEST['nonce'] ) ) {
//         exit( "No naughty business please" );
//     }
//
//     $likes = get_post_meta( $_REQUEST['post_id'], '_pt_likes', true );
//     $likes = ( empty( $likes ) ) ? 0 : $likes;
//     $new_likes = $likes + 1;
//
//     update_post_meta( $_REQUEST['post_id'], '_pt_likes', $new_likes );
//
//     if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
//         echo $new_likes;
//         die();
//     }
//     else {
//         wp_redirect( get_permalink( $_REQUEST['post_id'] ) );
//         exit();
//     }
// }

// Removes a class from the body_class array.
add_filter( 'body_class', function( $classes ) {
    if ( is_tag() && isset( $classes['tag'] ) ) {
        unset( $classes['tag'] );
    }
    return $classes;
} );
