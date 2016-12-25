<?php
/*
Template Name: Contact Page
Template Post Type: post, page, portfolio
*/
// Page code here...

?>

<h1>show the contacts page </h1>

<?php while (have_posts()) : the_post(); ?>

    <h1>Single Portolio</h1>

    <header>
        <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <article <?php post_class(); ?>>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
        <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </article>
    <div class="post_info_footer">
        <?php Roots\Sage\Extras\porto_tags(); ?>
        <div class="post_bt">
            <a href="#/" class="ct-btn">Back to top <i class="icon icon-arrow-up"></i></a>
        </div>
    </div>
    <footer>
        <?php comments_template('/templates/comments.php'); ?>
    </footer>

<?php endwhile; ?>
