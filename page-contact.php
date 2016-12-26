<?php
/*
Template Name: Contact Page
Template Post Type: post, page, portfolio
*/
// Page code here...

?>
<div class="row">
    <?php while (have_posts()) : the_post(); ?>
    <div class="contact_content col-md-8">
        <h4 class="contact_title"><?php echo __( 'Send me a Message...' ); ?></h4>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    </div>
    <div class="contact_info col-md-4">
        <h4 class="contact_title"><?php echo __( 'Contact Information' ); ?></h4>
        <?php if( !empty( $porto['contact-email'] ) ) : ?>
            <div class="contact_info_details">
                <h6><?php echo __( 'Email', 'porto' ) ?></h6>
                <a href="mailto:<?php echo $porto['contact-email']; ?>" target="_top"><?php echo esc_attr__( $porto['contact-email'] ); ?></a>
            </div>
        <?php endif; ?>
        <?php if( !empty( $porto['contact-skype'] ) ): ?>
            <div class="contact_info_details">
                <h6><?php echo __( 'Skype' ); ?></h6>
                <a href="skype:<?php echo $porto['contact-skype']; ?>?chat" target="_top"><?php echo esc_attr__( $porto['contact-skype'] ); ?></a>
            </div>
        <?php endif; ?>
        <?php if( !empty( $porto['contact-call'] ) ) : ?>
            <div class="contact_info_details">
                <h6><?php echo __( 'Call' ); ?></h6>
                <a href="tel:<?php echo $porto['contact-call']; ?>"><?php echo esc_attr__( $porto['contact-call'] ); ?></a>
            </div>
        <?php endif; ?>
        <?php if( !empty( $porto['contact-address'] ) ) : ?>
            <div class="contact_info_details">
                <h6><?php echo __( 'Home' ); ?></h6>
                <span><?php echo esc_textarea( $porto['contact-address'] ); ?></span>
            </div>
        <?php endif; ?>
        <p class="thanks"><?php echo __( 'Thank you.' ); ?></p>
    </div>

    <?php endwhile; ?>
</div>
