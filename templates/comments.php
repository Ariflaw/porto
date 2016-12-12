<?php
if (post_password_required()) {
    return;
}
?>

<section id="comments" class="comments">
    <?php if (have_comments()) : ?>
        <h3 class="comments_title"><?php printf(_nx('One Comments', '%1$s Comments', get_comments_number(), 'porto'), number_format_i18n(get_comments_number()) ); ?></h3>

        <ol class="comment-list">
            <?php wp_list_comments([
                    'style'          => 'ol',
                    'short_ping'     => true,
                    'avatar_size'    => 50,
                    'format'         => 'html5', // or 'xhtml' if no 'HTML5' theme support
                ]);
            ?>
        </ol>

            <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
                <nav>
                    <ul class="pager">
                        <?php if (get_previous_comments_link()) : ?>
                            <li class="previous"><?php previous_comments_link(__('<i class="icon icon-arrow-left"></i> Older comments', 'porto')); ?></li>
                        <?php endif; ?>
                        <?php if (get_next_comments_link()) : ?>
                            <li class="next"><?php next_comments_link(__('Newer comments <i class="icon icon-arrow-right"></i>', 'porto')); ?></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        <?php endif; // have_comments() ?>

        <?php if (!comments_open() && get_comments_number() != '0' && post_type_supports(get_post_type(), 'comments')) : ?>
            <div class="alert alert-warning">
                <?php _e('Comments are closed.', 'porto'); ?>
            </div>
        <?php endif; ?>

        <?php comment_form(); ?>
    </section>
