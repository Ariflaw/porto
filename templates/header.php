<?php
/*
 * Global Variable
 */
global $porto;

?>
<div id="main_header" class="main_header">
    <div class="container clearfix">
        <div class="brand">
            <a class="logo logo_white" href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo get_template_directory_uri(); ?>/dist/images/Logo.png" /></a>
            <a class="logo logo_black" href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo get_template_directory_uri(); ?>/dist/images/logo-black.png" /></a>
        </div>
        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbar">
            <i class="icon-menu icons"></i>
        </button>
        <div class="nav_primary collapse navbar-toggleable-lg" id="navbar">
        <?php
            wp_nav_menu( array(
                'menu'            => 'primary',
                'theme_location'  => 'primary_navigation',
                'menu_id'         => false,
                'menu_class'      => 'nav navbar-nav',
                'depth'           => 1,
                // 'fallback_cb'     => 'navwalker::fallback',
                // 'walker'          => new navwalker(),
            ));
        ?>
        </div>
        <!-- <div id="main-nav" class="stellarnav">
            <?php
                wp_nav_menu( array(
                    'menu'            => 'primary',
                    'theme_location'  => 'primary_navigation',
                    'container'       => 'nav',
                    'container_id'    => false,
                    'container_class' => false,
                    'menu_class'      => false,
                    'menu_id'         => false,
                    'depth'           => 3,
                ));
            ?>
        </div> -->
    </div>
</div>

<header id="hero" class="hero_header" <?php header_img_bg(); ?>>
    <div class="container">
        <?php if ( is_blog_page() ) : ?>
            <div class="hero_content">
                <h1 class="page_title"><?php echo esc_html( $porto['hb-heading'] ); ?></h1>
                <?php if( !empty( $porto['hb-sub-heading'] ) ) : ?>
                <p class="page_des"><?php echo $porto['hb-sub-heading']; ?></p>
                <?php endif; ?>
            </div>

            <div class="hero_profile">
                <?php echo get_avatar( 'nurariflaw@gmail.com', 120 ); ?>
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
                    <span class="dot">
                        <i class="icon icon-eye"></i> <?php echo getPostViews(get_the_ID()); ?>
                    </span>
                </div>
            </div>

        <?php elseif( is_page_template( 'page-contact.php' ) ) : ?>
            <div class="hero_content">
                <h1 class="page_title"><?php echo $porto['hc-heading']; ?></h1>
                <div class="divider"></div>
                <p class="page_des"><?php echo $porto['hc-sub-heading']; ?></p>
            </div>
        <?php else : ?>
            <h1 class="page_title"><?php echo __('Title Page'); ?></h1>
        <?php endif; ?>

    </div>
</header>
