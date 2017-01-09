<?php while (have_posts()) : the_post(); ?>
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

<div class="ps_pagination">
    <li class="prev_nav"><?php previous_post_link( '%link', '<i class="icon-arrow-left"></i> Prev <span>%title</span>' ); ?></li>
    <li><a href="<?php echo get_post_type_archive_link( 'portfolio' ); ?>"><i class="icon-grid"></i></a></li>
    <li class="next_nav"><?php next_post_link( '%link', 'Next Portfolio <i class="icon-arrow-right"></i>' ); ?></li>
</div>


<?php setPostViews(get_the_ID()); ?>
