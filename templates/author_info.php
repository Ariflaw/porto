<?php
// Info Author Box
// https://developer.wordpress.org/reference/functions/get_the_author_meta/

global $post;

// Detect if it is a single post with a post author
if ( is_single() && isset( $post->post_author ) ) {
    // Get author's display name
    $display_name = get_the_author_meta( 'display_name', $post->post_author );
    // If display name is not available then use nickname as display name
    if ( empty( $display_name ) )
    $display_name = get_the_author_meta( 'nickname', $post->post_author );
    // Get author's biographical information or description
    $user_description = get_the_author_meta( 'user_description', $post->post_author );
    // Get author's website URL
    $user_website = get_the_author_meta('url', $post->post_author);
    // Get link to the author archive page
    $user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
    $user_link_author = get_author_posts_url( get_the_author_meta( 'ID', $post->post_author ));
}

 ?>
<div class="info_author_box">
    <?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
    <h4 class="author_name"><span>Author</span><a href="<?php echo $user_link_author; ?>"><?php echo $display_name; ?></a></h4>
    <div class="info_author_content">
        <?php if ( ! empty($user_description) ) {
                echo nl2br($user_description);
            } else {
                echo esc_html_e( 'Write your description in the profile page :)' );
            }
        ?>
    </div>
</div>
