<?php
if ( ! function_exists( 'is_blog_page' ) ) :
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
endif;

/**
 * ============================================================================
 * THUMBNAILS
 * ============================================================================
 */
if ( ! function_exists( 'porto_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 *
 * @since Porto 1.0
 * @since Porto 1.4 Was made 'pluggable', or overridable.
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


/**
 * ============================================================================
 * CATEGORY POSTS
 * ============================================================================
 */

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
                $cat_id = $post_category->term_id;
                $cat_data = get_option("category_$cat_id");
                $category_color = $cat_data['catBG'];

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
 * ============================================================================
 * TAGS POSTS
 * ============================================================================
 */
if ( ! function_exists( 'porto_tags' ) ) :
/**
 * Prints HTML with tags for current post.
 *
 * Create your own porto_tags() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 */
function porto_tags() {
	$tags_list = get_the_tag_list( '', _x( '', 'Used between list items, there is a space after the comma.', 'porto' ) );
	if ( $tags_list ) {
		printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
			_x( 'Tags', 'Used before tag names.', 'porto' ),
			$tags_list
		);
	}
}
endif;


/* HEADER IMAGE BACKHROUND
 * ========================================================================== */
if ( ! function_exists( 'header_img_bg' ) ) :
    function header_img_bg() {
        if ( is_single() && has_post_thumbnail( ) ) {
            echo 'style="background-image: url('. get_the_post_thumbnail_url() .');"';
        } elseif ( is_single() ) {
            echo '';
        }else {
            echo "style=\"background-image: url('". esc_url( get_header_image() ) ."');\"";
        }
    }
endif;


/* POST COUNT VIEW
 * ========================================================================== */
 if ( ! function_exists( 'getPostViews' ) ) :

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

endif;

if ( ! function_exists( 'setPostViews' ) ) :
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

endif;


/* Hide ACF admin
 * ========================================================================== */
// 1. customize ACF path
// https://www.advancedcustomfields.com/resources/including-acf-in-a-plugin-theme
// http://stackoverflow.com/questions/19405675/including-acf-in-functions-php-wordpress
// https://id.wordpress.org/plugins/acf-theme-code/

if( class_exists('acf') ) :

    add_filter('acf/settings/path', 'my_acf_settings_path');

    function my_acf_settings_path( $path ) {
        // update path
        $path = get_stylesheet_directory() . '/lib/acf/';
        // return
        return $path;
    }

    // 2. customize ACF dir
    add_filter('acf/settings/dir', 'my_acf_settings_dir');

    function my_acf_settings_dir( $dir ) {
        // update path
        $dir = get_stylesheet_directory_uri() . '/lib/acf/';
        // return
        return $dir;
    }

    // 3. Hide ACF field group menu item
    add_filter('acf/settings/show_admin', '__return_false');

    // 4. Include ACF
    // define( 'ACF_LITE', true );
    include_once( get_stylesheet_directory() . '/lib/acf/acf.php' );

endif;


/* PAGINATION CUSTOM PAGE
 * ========================================================================== */
if( !function_exists( 'porto_pagination' ) ) :
    // Custom WordPress Loop With Pagination
    // http://callmenick.com/post/custom-wordpress-loop-with-pagination

    function porto_pagination( $numpages = '', $pagerange = '', $paged='' ) {

        if (empty($pagerange)) {
            $pagerange = 2;
        }

        /**
        * This first part of our function is a fallback
        * for custom pagination inside a regular loop that
        * uses the global $paged and global $wp_query variables.
        *
        * It's good because we can now override default pagination
        * in our theme, and use this function in default quries
        * and custom queries.
        */
        global $paged;
        if (empty($paged)) {
            $paged = 1;
        }
        if ($numpages == '') {
            global $wp_query;
            $numpages = $wp_query->max_num_pages;
            if(!$numpages) {
                $numpages = 1;
            }
        }

        /**
        * We construct the pagination arguments to enter into our paginate_links
        * function.
        */
        $pagination_args = array(
            'base'            => get_pagenum_link(1) . '%_%',
            'format'          => 'page/%#%',
            'total'           => $numpages,
            'current'         => $paged,
            'show_all'        => False,
            'end_size'        => 1,
            'mid_size'        => $pagerange,
            'prev_next'       => True,
            'prev_text'       => __('<i class="icon-arrow-left"></i> Prev'),
            'next_text'       => __('Next <i class="icon-arrow-right"></i>'),
            'type'            => 'list',
            'add_args'        => false,
            'add_fragment'    => ''
        );

        $paginate_links = paginate_links($pagination_args);

        if ($paginate_links) {
            echo "<nav class='porto_pagination'>";
            // echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
            echo $paginate_links;
            echo "</nav>";
        }

    }

endif;


/**
 * ============================================================================
 * BACKGROUND COLOR FOR CATEGORY
 * http://wordpress.stackexchange.com/questions/112866/adding-colorpicker-field-to-category
 * ============================================================================
 */
/** Add Colorpicker Field to "Add New Category" Form **/
function category_form_custom_field_add( $taxonomy ) { ?>
    <div class="form-field">
        <label for="category_custom_color"><?php _e('Color');  ?></label>
        <input name="cat_meta[catBG]" class="colorpicker" type="text" value="#555555" />
        <p class="description"><?php _e( 'Choose your favorite color' ); ?></p>
    </div>
    <?php
}
add_action('category_add_form_fields', 'category_form_custom_field_add', 10 );

/** Add New Field To Category **/
function extra_category_fields( $tag ) {
    $t_id = $tag->term_id;
    $cat_meta = get_option( "category_$t_id" );
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="meta-color"><?php _e('Background Color'); ?></label></th>
        <td>
            <div id="colorpicker">
                <input type="text" name="cat_meta[catBG]" class="colorpicker" size="3" style="" value="<?php echo (isset($cat_meta['catBG'])) ? $cat_meta['catBG'] : '#555555'; ?>" />
            </div>
            <br />
            <span class="description"><?php _e('Choose your favorite color'); ?></span>
            <br />
        </td>
    </tr>
    <?php
}
add_action('category_edit_form_fields','extra_category_fields');

/** Save Category Meta **/
function save_extra_category_fileds( $term_id ) {

    if ( isset( $_POST['cat_meta'] ) ) {
        $t_id = $term_id;
        $cat_meta = get_option( "category_$t_id");
        $cat_keys = array_keys($_POST['cat_meta']);
        foreach ($cat_keys as $key){
            if (isset($_POST['cat_meta'][$key])){
                $cat_meta[$key] = $_POST['cat_meta'][$key];
            }
        }
        //save the option array
        update_option( "category_$t_id", $cat_meta );
    }
}
add_action('edited_category', 'save_extra_category_fileds');
add_action('created_category', 'save_extra_category_fileds', 11, 1);
