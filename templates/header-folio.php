<div id="main_header" class="main_header header_folio">
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
    </div>
</div>


<header class="hero_header_folio">
    <?php if ( is_single() ): ?>
        <div class="header_folio_single">
            <!-- <?php the_post_thumbnail('full') ?> -->
            <div class="icon_post"><i class="icon icon-ghost"></i></div>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <h3 class="entry-description">Awesome html template with fully customize</h3>

            <ul class="folio_info">
                <li class="folio_info_client">
                    <span>Client: </span>
                    Ariflaw
                </li>
                <li class="folio_info_date">
                    <span>Date: </span>
                    Desember 2016
                </li>
                <li class="folio_info_url">
                    <span>Website: </span>
                    www.ariflaw.com
                </li>
                <li class="folio_info_service">
                    <span>Service: </span>
                    Wordpress, Web Design
                </li>
            </ul>
            <!-- <img src="http://localhost/ariflaw/wp-content/uploads/2016/12/Macup.jpg" alt=""> -->
        </div>
    <?php else : ?>
        <div class="hero_content">
            <h1 class="entry-title"><?php echo __('Portfolio.'); ?></h1>
        </div>
    <?php endif; ?>
</header>
