<footer class="site-footer">

        <!-- <?php dynamic_sidebar('sidebar-footer'); ?> -->

    <div class="footer_content">
        <div class="container">
            <div class="footer_logo">
                <img src="<?php echo get_template_directory_uri(); ?>/dist/images/logo-black.png" alt="Ariflaw Logo Black">
            </div>
            <ul class="footer_social">
                <li><a href="#" class="dribble">Dribbble</a></li>
                <li><a href="#" class="facebook dot">Facebook</a></li>
                <li><a href="#" class="github dot">Github</a></li>
                <li><a href="#" class="linkedin dot">Linkedin</a></li>
            </ul>
        </div>
    </div>

    <div class="site-info">
        <?php echo esc_html_e( 'Copyright &copy; Design and develop by ', 'porto' ) ?><a href="<?php echo esc_url( 'http://www.ariflaw.com' ); ?>" rel="Arifaw"><?php echo esc_html_e( 'Ariflaw', 'porto' ) ?></a>, <?php echo the_date( 'Y' ); ?>. <?php echo esc_html_e( 'Made with happines in Indonesia', 'porto' ); ?>
    </div><!-- .site-info -->
</footer>
