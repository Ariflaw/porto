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
            <?php if( ! empty(rwmb_meta( 'client-description' )) ) : ?>
            <h3 class="entry-description"><?php echo rwmb_meta( 'client-description' ); ?></h3>
            <?php endif; ?>

            <?php if( rwmb_meta( 'client-info-show' ) == 1 ): ?>
            <ul class="folio_info">
                <?php if( ! empty( rwmb_meta('client-folio')) ) : ?>
                <li class="folio_info_client">
                    <label><?php echo _e( 'Client', 'porto' ); ?></label>
                    <span><?php echo rwmb_meta( 'client-folio' ); ?></span>
                </li>
                <?php endif; ?>
                <?php if( ! empty( rwmb_meta('star-project-folio')) ) : ?>
                <li class="folio_info_date">
                    <label><?php echo _e( 'Date', 'porto' ); ?></label>
                    <span><?php echo rwmb_meta( 'star-project-folio' ); ?></span>
                </li>
                <?php endif; ?>
                <?php if( ! empty( rwmb_meta('url-project')) ) : ?>
                <li class="folio_info_url">
                    <label><?php echo _e( 'Website', 'porto' ); ?></label>
                    <span><a href="<?php echo rwmb_meta( 'url-project' ) ?>" rel="nofollow" target="_blank"><?php echo rwmb_meta( 'url-project' ) ?></a></span>
                </li>
                <?php endif; ?>
                <li class="folio_info_service">
                    <label><?php echo _e( 'Category' ); ?></label>
                    <?php echo category_post_type( 'portfolio-category' ); ?>
                </li>
            </ul>
            <?php endif; ?>
        </div>
    <?php else : ?>
        <div class="hero_content">
            <h1 class="entry-title"><?php echo __('Portfolio.'); ?></h1>
        </div>
    <?php endif; ?>
</header>
