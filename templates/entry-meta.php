<div class="entry-info">
    <?php if( ! is_single() ): ?>
        <time class="updated" datetime="<?= get_post_time('c', true); ?>">
            <?= __('Post on ', 'porto'); ?><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?>
        </time>
        <span class="comment_info dot">
            <a href="<?php echo get_comments_link( $post->ID ); ?>" rel="nofollow">
            <?php printf( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'porto' ), number_format_i18n( get_comments_number() ) ); ?>
            </a>
        </span>
        <p class="byline author vcard hidden">
            <?= __('By', 'porto'); ?> <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?= get_the_author(); ?></a>
        </p>
    <?php else : ?>
        <div class="info_author">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 40 ); ?>
            <p class="byline author vcard">
                <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?= get_the_author(); ?></a>
            </p>

            <?php Roots\Sage\Extras\porto_categories(); ?>

            <?php
            if( class_exists( 'WP_MinsToRead' ) ) : ?>
            <div class="post_read">
                <i class="icon icon-book-open"></i>
                <?php echo '<strong>' . WP_MinsToRead::get_mtr( get_the_ID() ) . '</strong>'; ?>
            </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
