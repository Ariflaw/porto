<footer class="site-footer">

        <!-- <?php dynamic_sidebar('sidebar-footer'); ?> -->

    <div class="footer_content">
        <div class="container">
            <div class="footer_logo">
                <img src="<?php echo get_template_directory_uri(); ?>/dist/images/logo-black.png" alt="Ariflaw Logo Black">
            </div>
            <ul class="footer_social">
                <?php

                    global $porto;

                    // Grab the first element using a foreach
                    // http://stackoverflow.com/questions/3957768/php-grab-the-first-element-using-a-foreach
                    $first = true;

                    $social_list = array(
                        'facebook'        => $porto['social-faceboook'],
                        'twitter'         => $porto['social-twitter'],
                        'google'          => $porto['social-google'],
                        'linkedin'        => $porto['social-linkedin'],
                        'github'          => $porto['social-github'],
                        'dribbble'        => $porto['social-dribbble'],
                        'behance'         => $porto['social-behance'],
                        'codepen'         => $porto['social-codepen'],
                        'stackoverflow'   => $porto['social-stackoverflow'],
                        'instagram'       => $porto['social-instagram'],
                    );

                    foreach ($social_list as $title => $account) {
                        if ( ! empty( $account ) && $first ) {
                            echo '<li><a href="'.esc_url($account).'" class="'.$title.'" target="_blank" rel="nofollo">'.esc_html($title).'</a></li>';
                            $first = false;
                        } else if( ! empty( $account ) ) {
                            echo '<li><a href="'.esc_url($account).'" class="'.$title.' dot" target="_blank" rel="nofollo">'.esc_html($title).'</a></li>';
                        }
                    }

                 ?>
            </ul>
        </div>
    </div>

    <div class="site-info">
        <?php
            if ( ! empty( $porto['copyright-text'] ) ) {
                echo esc_html($porto['copyright-text']);
            } else {
                echo esc_html_e( 'Copyright &copy; '.get_the_date( 'Y' ).' '.get_bloginfo( 'name' ), 'porto' ); ?>. <?php echo esc_html_e( 'Made with happines in Indonesia', 'porto' );
            }
        ?>
        <span>
            <?php echo esc_html_e( ' - Design and develop by ', 'porto' ) ?><a href="<?php echo esc_url( 'http://www.ariflaw.com' ); ?>" rel="Arifaw" target="_blank"><?php echo esc_html_e( 'Ariflaw', 'porto' ) ?></a>
        </span>
    </div><!-- .site-info -->
</footer>
