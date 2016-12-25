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
if( !function_exists( 'custom_pagination' ) ) :
    // Custom WordPress Loop With Pagination
    // http://callmenick.com/post/custom-wordpress-loop-with-pagination

    function custom_pagination( $numpages = '', $pagerange = '', $paged='' ) {

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
            'prev_text'       => __('&laquo;'),
            'next_text'       => __('&raquo;'),
            'type'            => 'plain',
            'add_args'        => false,
            'add_fragment'    => ''
        );

        $paginate_links = paginate_links($pagination_args);

        if ($paginate_links) {
            echo "<nav class='custom-pagination'>";
            echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
            echo $paginate_links;
            echo "</nav>";
        }

    }

endif;