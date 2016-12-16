<?php namespace Roots\Sage\Extras; ?>
<div class="main_header">
    <div class="container clearfix">
        <div class="brand">
            <a class="logo logo_white" href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo get_template_directory_uri(); ?>/dist/images/Logo.png" /></a>
            <a class="logo logo_black" href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo get_template_directory_uri(); ?>/dist/images/logo-black.png" /></a>
        </div>
        <nav class="nav_primary">
            <?php
            if (has_nav_menu('primary_navigation')) :
                wp_nav_menu([
                    'theme_location' => 'primary_navigation',
                    'menu_class'     => 'nav'
                ]);
            endif;
            ?>
        </nav>
    </div>
</div>

<header id="hero" class="hero_header" <?php header_img_bg(); ?>>
    <div class="container">
        <?php if ( is_blog_page() ): ?>
            <div class="hero_content">
                <h1 class="page_title"><?php echo esc_html('Blog'); ?></h1>
                <p class="page_des"><?php echo esc_html( 'What I think here.' ); ?></p>
            </div>

            <div class="hero_profile">
                <img src="<?php echo get_template_directory_uri(); ?>/dist/images/profile.png" alt="Avatar">
            </div>
        <?php elseif ( is_single() ): ?>
            <div class="hero_content_single">
                <div class="icon_post"><i class="icon icon-fire"></i></div>
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <div class="hero_post_info">
                    <time class="updated" datetime="<?= get_post_time('c', true); ?>">
                        <i class="icon icon-clock"></i>
                        <?= __('Post on ', 'porto'); ?><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?>
                    </time>
                    <span class="comment_info dot">
                        <i class="icon icon-bubbles"></i>
                        <?php printf( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'porto' ), number_format_i18n( get_comments_number() ) ); ?>
                    </span>
                    <!-- <span class="post_likes dot">
                        <i class="icon icon-heart"></i>
                        50 Likes
                        <?php echo legal_station_post_love_display() ?>
                    </span> -->
                    <span class="dot">
                        <i class="icon icon-eye"></i> <?php echo getPostViews(get_the_ID()); ?>
                    </span>
                </div>
            </div>
        <?php endif; ?>

    </div>
</header>
