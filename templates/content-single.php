<?php while (have_posts()) : the_post(); ?>
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
        <?php porto_tags(); ?>
        <div class="post_bt">
            <a href="#/" class="ct-btn">Back to top <i class="icon icon-arrow-up"></i></a>
        </div>
    </div>
    <?php get_template_part('templates/author_info'); ?>
    <footer>
        <?php comments_template('/templates/comments.php'); ?>
    </footer>

<?php endwhile; ?>
<?php the_post_navigation(); ?>

<?php setPostViews(get_the_ID()); ?>
