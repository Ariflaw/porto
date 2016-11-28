<header id="hero" class="hero_header">
    <div class="container">
        <div class="main_header clearfix">
            <div class="brand">
                <a class="logo" href="<?php esc_url(home_url('/')); ?>"><img src="<?php echo get_template_directory_uri(); ?>/dist/images/Logo.png" /></a>
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

        <div class="hero_content">
            <h1 class="page_title">Blog</h1>
            <p class="page_des">What I think here.</p>
        </div>

        <div class="hero_profile">
            <img src="<?php echo get_template_directory_uri(); ?>/dist/images/profile.png" alt="Avatar">
        </div>
    </div>
</header>
