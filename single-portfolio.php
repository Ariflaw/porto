<?php while (have_posts()) : the_post(); ?>
    <header class="sf-info">
        <div class="client_info">
            <span>b2evolution</span>
        </div>
        <div class="start_project">
            <time>10-06-2016</time>
        </div>
    </header>
    <article <?php post_class(); ?>>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
        <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </article>
    <div class="post_info_footer">
        <?php porto_tags(); ?>
        <div class="post_bt">
            <a href="#/" class="ct-btn">Back to top <i class="icon icon-arrow-up"></i></a>
        </div>
    </div>
    <footer>
        <?php comments_template('/templates/comments.php'); ?>
    </footer>
<?php endwhile; ?>
<?php the_post_navigation(); ?>

<?php setPostViews(get_the_ID()); ?>
