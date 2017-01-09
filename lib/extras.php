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
 * ============================================================================
 * CUSTOME BASE TEMPLATE FOR CUSTOM POST TYPE
 * ============================================================================
 */
 add_filter('sage/wrap_base', __NAMESPACE__ . '\\sage_wrap_base_cpts'); // Add our function to the sage/wrap_base filter

 function sage_wrap_base_cpts($templates) {
   $cpt = get_post_type(); // Get the current post type
   if ($cpt) {
      array_unshift($templates, 'base-' . $cpt . '.php'); // Shift the template to the front of the array
   }
   return $templates; // Return our modified array with base-$cpt.php at the front of the queue
 }


 function portfolio_wrapper($templates) {
     $template_slug = get_page_template_slug(); // Get the current page template slug
     switch ($template_slug) :
         case 'template-portfolio.php' :
             array_unshift($templates, 'base-portfolio.php'); // Shift the template to the front of the array
     endswitch;

     return $templates; // Return our modified array with the desired base-*.php at the front of the queue
 }
 add_filter('roots/wrap_base', __NAMESPACE__ . '\\portfolio_wrapper');


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
 * ============================================================================
 * CUSTOM FUNCTION
 * ============================================================================
 */
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
// add_filter( 'body_class', function( $classes ) {
//     if ( is_tag() && isset( $classes['tag'] ) ) {
//         unset( $classes['tag'] );
//     }
//     return $classes;
// } );
