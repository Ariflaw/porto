<?php

    /**
     * For full documentation, please visit: http://docs.reduxframework.com/
     * For a more extensive sample-config file, you may look at:
     * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "porto";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        'opt_name'              => 'porto',
        'dev_mode'              => TRUE,
        'use_cdn'               => FALSE,
        'display_name'          => 'Porto Theme Options',
        'display_version'       => 'Version 0.1',
        'page_slug'             => 'porto',
        'page_title'            => 'Theme Options',
        'update_notice'         => TRUE,
        'intro_text'            => 'Welcome to Porto',
        // 'footer_text' => 'Build by Ariflaw',
        'admin_bar'             => TRUE,
        'menu_type'             => 'menu',
        'menu_title'            => 'Theme Options',
        'allow_sub_menu'        => TRUE,
        'page_parent_post_type' => 'your_post_type',
        'page_priority'         => '100',
        'customizer'            => TRUE,
        // 'default_mark'          => '*',
        'hints' => array(
            'icon' => 'el el-asterisk',
            'icon_position' => 'right',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output'             => TRUE,
        'output_tag'         => TRUE,
        'settings_api'       => TRUE,
        'cdn_check_time'     => TRUE,
        'compiler'           => TRUE,
        'global_variable'    => 'porto',
        'page_permissions'   => 'manage_options',
        'save_defaults'      => TRUE,
        'show_import_export' => TRUE,
        'database'           => 'options',
        'transient_time'     => '3600',
        'network_sites'      => FALSE,
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/reduxframework',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.linkedin.com/company/redux-framework',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information', 'admin_folder' ),
            'content' => __( '<p>Welcome to the porto and thank have using it :)</p>', 'admin_folder' )
        ),
        // array(
        //     'id'      => 'redux-help-tab-2',
        //     'title'   => __( 'Theme Information 2', 'admin_folder' ),
        //     'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'admin_folder' )
        // )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'admin_folder' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /**
     * ============================================================================
     * HEADER
     * ============================================================================
     */
    Redux::setSection( $opt_name, array(
        'title'  => __( 'Header', 'redux-framework-demo' ),
        'id'     => 'header',
        'desc'   => __( 'Customize the header section', 'redux-framework-demo' ),
        'icon'   => 'el el-website',
        'fields' => array(
            array(
                'id'            => 'hero-height',
                'type'          => 'slider',
                'title'         => __( 'Set the Height for Hero Header', 'redux-framework-demo' ),
                'subtitle'      => __( 'You can custome the height for Header Hero', 'redux-framework-demo' ),
                'desc'          => __( 'Height use the screen. Min: 0, max: 100, step: 1, default value: 75 vh', 'redux-framework-demo' ),
                'default'       => 75,
                'min'           => 0,
                'step'          => 1,
                'max'           => 100,
                'display_value' => 'text',
            ),
            array(
                'id'        => 'header-bg-overlay',
                'type'      => 'color_rgba',
                'title'     => 'Overlay Background Header',
                'subtitle'  => 'Set color and alpha channel',
                'desc'      => 'Changed the color Overlay whatever you like!',

                // See Notes below about these lines.
                'output' => array('background-color' => '#hero::after'),
                //'compiler'  => array('color' => '.site-header, .site-footer', 'background-color' => '.nav-bar'),
                'default'   => array(
                    'color'     => '#000000',
                    'alpha'     => 0.75
                ),

                // These options display a fully functional color palette.  Omit this argument
                // for the minimal color picker, and change as desired.
                'options'       => array(
                    'show_input'                => true,
                    'show_initial'              => true,
                    'show_alpha'                => true,
                    'show_palette'              => false,
                    'show_palette_only'         => false,
                    'show_selection_palette'    => true,
                    'max_palette_size'          => 10,
                    'allow_empty'               => true,
                    'clickout_fires_change'     => false,
                    'choose_text'               => 'Choose',
                    'cancel_text'               => 'Cancel',
                    'show_buttons'              => true,
                    'use_extended_classes'      => true,
                    'palette'                   => null,  // show default
                    'input_text'                => 'Select Color'
                ),
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'  => __( 'Header Blog', 'redux-framework-demo' ),
        'id'     => 'header-blog',
        'desc'   => __( 'Customize the header blog section', 'redux-framework-demo' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'hb-heading',
                'type'     => 'text',
                'title'    => __( 'Heading Text', 'redux-framework-demo' ),
                // 'subtitle' => __( 'Subtitle', 'redux-framework-demo' ),
                // 'desc'     => __( 'Field Description', 'redux-framework-demo' ),
                'default'  => 'Blog',
            ),
            array(
                'id'       => 'hb-sub-heading',
                'type'     => 'textarea',
                'title'    => __( 'Sub Heading Text', 'redux-framework-demo' ),
                // 'subtitle' => __( 'Subtitle', 'redux-framework-demo' ),
                // 'desc'     => __( 'Field Description', 'redux-framework-demo' ),
                'validate' => 'html_custom',
                'default'  => 'What I think here.',
                'allowed_html' => array(
                    'a' => array(
                        'href' => array(),
                        'title' => array()
                    ),
                    'br' => array(),
                    'em' => array(),
                    'strong' => array()
                )
            ),
        )
    ));

    Redux::setSection( $opt_name, array(
        'title'  => __( 'Header Contact', 'redux-framework-demo' ),
        'id'     => 'header-contact',
        'desc'   => __( 'Customize the header blog section', 'redux-framework-demo' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'hc-heading',
                'type'     => 'textarea',
                'title'    => __( 'Heading Text', 'redux-framework-demo' ),
                // 'subtitle' => __( 'Subtitle', 'redux-framework-demo' ),
                // 'desc'     => __( 'Field Description', 'redux-framework-demo' ),
                'default'  => 'Let\'s work <strong>Together</strong> <br /> and creates something <strong>Awesome</strong>.',
                'validate' => 'html_custom',
                'allowed_html' => array(
                    'a' => array(
                        'href' => array(),
                        'title' => array()
                    ),
                    'br' => array(),
                    'em' => array(),
                    'strong' => array()
                )
            ),
            array(
                'id'       => 'hc-sub-heading',
                'type'     => 'textarea',
                'title'    => __( 'Sub Heading Text', 'redux-framework-demo' ),
                // 'subtitle' => __( 'Subtitle', 'redux-framework-demo' ),
                // 'desc'     => __( 'Field Description', 'redux-framework-demo' ),
                'validate' => 'html_custom',
                'default'  => 'Looking for a new web design (with development) and/or corporate identity? I\'d love to hear about your project.',
                'allowed_html' => array(
                    'a' => array(
                        'href' => array(),
                        'title' => array()
                    ),
                    'br' => array(),
                    'em' => array(),
                    'strong' => array()
                )
            ),
        )
    ));


    /**
     * ============================================================================
     * TYPOGRAPHY
     * ============================================================================
     */
    Redux::setSection( $opt_name, array(
    'title'  => __( 'Typography', 'redux-framework-demo' ),
    'id'     => 'typography',
    'desc'   => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="//docs.reduxframework.com/core/fields/typography/" target="_blank">docs.reduxframework.com/core/fields/typography/</a>',
    'icon'   => 'el el-font',
    'fields' => array(
        array(
        'id'       => 'opt-typography-body',
        'type'     => 'typography',
        'title'    => __( 'Body Font', 'redux-framework-demo' ),
        'subtitle' => __( 'Specify the body font properties.', 'redux-framework-demo' ),
        'google'   => true,
        'default'  => array(
            'color'       => '#dd9933',
            'font-size'   => '30px',
            'font-family' => 'Arial,Helvetica,sans-serif',
            'font-weight' => 'Normal',
            ),
        ),
        array(
            'id'          => 'opt-typography',
            'type'        => 'typography',
            'title'       => __( 'Typography', 'redux-framework-demo' ),
            //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
            //'google'      => false,
            // Disable google fonts. Won't work if you haven't defined your google api key
            'font-backup' => true,
            // Select a backup non-google font in addition to a google font
            //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
            //'subsets'       => false, // Only appears if google is true and subsets not set to false
            //'font-size'     => false,
            //'line-height'   => false,
            //'word-spacing'  => true,  // Defaults to false
            //'letter-spacing'=> true,  // Defaults to false
            //'color'         => false,
            //'preview'       => false, // Disable the previewer
            'all_styles'  => true,
            // Enable all Google Font style/weight variations to be added to the page
            // 'output'      => array( 'h2.site-description, .entry-title' ),
            // An array of CSS selectors to apply this font style to dynamically
            // 'compiler'    => array( 'h2.site-description-compiler' ),
            // An array of CSS selectors to apply this font style to dynamically
            'units'       => 'px',
            // Defaults to px
            'subtitle'    => __( 'Typography option with each property can be called individually.', 'redux-framework-demo' ),
            'default'     => array(
                'color'       => '#333',
                'font-style'  => '700',
                'font-family' => 'Abel',
                'google'      => true,
                'font-size'   => '33px',
                'line-height' => '40px'
                ),
            ),
        )
    ) );


    /**
     * ============================================================================
     * BLOG
     * ============================================================================
     */
    Redux::setSection( $opt_name, array(
        'title'  => __( 'Blog', 'porto' ),
        'id'     => 'blog',
        'desc'   => __( 'Customize the blog page', 'porto' ),
        'icon'   => 'el el-pencil',
        'fields' => array(
            array(
                'id'       => 'blog-img-user',
                'type'     => 'section',
                'title'    => __( 'Image Profile', 'redux-framework-demo' ),
                'subtitle' => __( 'Set your image profile', 'redux-framework-demo' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'select-img-metod',
                'type'     => 'switch',
                'title'    => __( 'Select the Image Profile Source', 'redux-framework-demo' ),
                // 'subtitle' => __( 'Look, it\'s on! Also hidden child elements!', 'redux-framework-demo' ),
                'default'  => 1,
                'on'       => 'Use Gravatar',
                'off'      => 'Upload Image',
            ),
            array(
                'required' => array( 'select-img-metod', '=', '1' ),
                'id'       => 'email-profile',
                'type'     => 'text',
                'title'    => __( 'Email Gravatar', 'redux-framework-demo' ),
                // 'subtitle' => __( 'Subtitle', 'redux-framework-demo' ),
                // 'desc'     => __( 'Field Description', 'redux-framework-demo' ),
                'placeholder'  => 'youremail@domain.com',
            ),
            array(
                'required' => array( 'select-img-metod', '=', '0' ),
                'id'       => 'img-profile',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Upload Image Profile', 'redux-framework-demo' ),
                'compiler' => 'true',
                //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                // 'desc'     => __( 'Basic media uploader with disabled URL input field.', 'redux-framework-demo' ),
                // 'subtitle' => __( 'Upload any media using the WordPress native uploader', 'redux-framework-demo' ),
                // 'default'  => array( 'url' => 'http://s.wordpress.org/style/images/codeispoetry.png' ),
                //'hint'      => array(
                //    'title'     => 'Hint Title',
                //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                //)
            ),
            array(
                'id'     => 'sblog-img-user-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        ),
    ) );


    /**
     * ============================================================================
     * PAGES
     * ============================================================================
     */
    Redux::setSection( $opt_name, array(
        'title'  => __( 'Pages', 'porto' ),
        'id'     => 'pages',
        'desc'   => __( 'Customize the pages', 'porto' ),
        'icon'   => 'el el-website',
        'fields' => array(
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Contact Page', 'porto' ),
        'desc'       => __( 'Customize you Contact Page', 'porto' ),
        'id'         => 'contact-page',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'contact-content',
                'type'     => 'section',
                'title'    => __( 'Contact Informations', 'redux-framework-demo' ),
                'subtitle' => __( 'Custome the contact informations', 'redux-framework-demo' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'contct-content-title',
                'type'     => 'switch',
                'title'    => __( 'Enable to show Title Content', 'redux-framework-demo' ),
                // 'subtitle' => __( 'Look, it\'s on! Also hidden child elements!', 'redux-framework-demo' ),
                'default'  => 1,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'contact-title-field',
                'type'     => 'text',
                'required' => array( 'contct-content-title', '=', '1' ),
                'title'    => __( 'Title Contact Title', 'redux-framework-demo' ),
                // 'desc'     => __( 'Items set with a fold to this ID will hide unless this is set to the appropriate value.', 'redux-framework-demo' ),
                'default'  => __( 'Send me a Message...', 'porto' ),
            ),
            array(
                'id'     => 'section-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),

            array(
                'id'   => 'page-divide-contact',
                'type' => 'divide'
            ),

            array(
                'id'       => 'contact-info',
                'type'     => 'section',
                'title'    => __( 'Contact Informations', 'redux-framework-demo' ),
                'subtitle' => __( 'Custome the contact informations', 'redux-framework-demo' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'contact-email',
                'type'     => 'text',
                'title'    => __( 'Email', 'redux-framework-demo' ),
                'subtitle' => __( 'Type your email address', 'redux-framework-demo' ),
                'default'  => __( 'your_email@domain.com', 'porto' ),
                'placeholder'    => __( 'your_email@domain.com', 'porto' ),
            ),
            array(
                'id'       => 'contact-skype',
                'type'     => 'text',
                'title'    => __( 'Skype', 'redux-framework-demo' ),
                'subtitle' => __( 'type your skype id', 'redux-framework-demo' ),
                'default'  => __( 'skype_id', 'porto' ),
                'placeholder'    => __( 'skype_id', 'porto' ),
            ),
            array(
                'id'       => 'contact-call',
                'type'     => 'text',
                'title'    => __( 'Phone', 'redux-framework-demo' ),
                'subtitle' => __( 'Type your phone number', 'redux-framework-demo' ),
                'default'  => __( '(+62)12-345-678-910', 'porto' ),
                'placeholder'    => __( '(+62)12-345-678-910', 'porto' ),
            ),
            array(
                'id'       => 'contact-address',
                'type'     => 'textarea',
                'title'    => __( 'Home', 'redux-framework-demo' ),
                'subtitle' => __( 'Type your address', 'redux-framework-demo' ),
                'default'  => __( 'Location where you live.', 'porto' ),
                'plaecholder'    => __( 'Location where you live.', 'porto' ),
            ),
            array(
                'id'     => 'section-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) );


    /**
     * ============================================================================
     * FOOTER
     * ============================================================================
     */
    Redux::setSection( $opt_name, array(
        'id'    => 'footer',
        'title' => __( 'Footer', 'redux-framework-demo' ),
        'desc'  => __( 'Customize the footer section.', 'redux-framework-demo' ),
        'icon'  => 'el el-photo',
        'fields'     => array(
            array(
                'id'       => 'bg-footer',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Background Footer Image', 'redux-framework-demo' ),
                'compiler' => 'true',
                //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                // 'desc'     => __( 'Basic media uploader with disabled URL input field.', 'redux-framework-demo' ),
                'subtitle' => __( 'Upload any media using the WordPress native uploader', 'redux-framework-demo' ),
                'default'  => array( 'url' => get_template_directory_uri().'/dist/images/bg_footer.jpg' ),
                //'hint'      => array(
                //    'title'     => 'Hint Title',
                //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                //)
            ),
            array(
                'id'        => 'footer-bg-overlay',
                'type'      => 'color_rgba',
                'title'     => 'Overlay Background Footer',
                'subtitle'  => 'Set color and alpha channel',
                'desc'      => 'Changed the color Overlay whatever you like!',
                // See Notes below about these lines.
                'output' => array('
                    background-color' => '.site-footer::before
                '),
                //'compiler'  => array('color' => '.site-header, .site-footer', 'background-color' => '.nav-bar'),
                'default'   => array(
                    'color'     => '#ffffff',
                    'alpha'     => 0.75
                ),
                // These options display a fully functional color palette.  Omit this argument
                // for the minimal color picker, and change as desired.
                'options'       => array(
                    'show_input'                => true,
                    'show_initial'              => true,
                    'show_alpha'                => true,
                    'show_palette'              => false,
                    'show_palette_only'         => false,
                    'show_selection_palette'    => true,
                    'max_palette_size'          => 10,
                    'allow_empty'               => true,
                    'clickout_fires_change'     => false,
                    'choose_text'               => 'Choose',
                    'cancel_text'               => 'Cancel',
                    'show_buttons'              => true,
                    'use_extended_classes'      => true,
                    'palette'                   => null,  // show default
                    'input_text'                => 'Select Color'
                ),
            ),
            array(
                'id'       => 'logo-footer',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Logo Image Footer', 'redux-framework-demo' ),
                'compiler' => 'true',
                //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                // 'desc'     => __( 'Basic media uploader with disabled URL input field.', 'redux-framework-demo' ),
                'subtitle' => __( 'Upload any media using the WordPress native uploader', 'redux-framework-demo' ),
                'default'  => array( 'url' => get_template_directory_uri().'/dist/images/logo-black.png' ),
                //'hint'      => array(
                //    'title'     => 'Hint Title',
                //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                //)
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'id'         => 'social-accounts',
        'title'      => __( 'Social Accounts', 'porto' ),
        'desc'       => __( 'Paste your social acoounts on the fields.', 'porto' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'social-faceboook',
                'type'     => 'text',
                'title'    => __( 'Facebook URL', 'porto' ),
                // 'subtitle' => __( '', 'porto' ),
                // 'desc'     => __( 'Field Description', 'porto' ),
                'validate' => 'url',
                'validate' => 'url',
                'placeholder'  => 'https://www.facebook.com/',
            ),
            array(
                'id'       => 'social-twitter',
                'type'     => 'text',
                'title'    => __( 'Twitter URL', 'porto' ),
                // 'subtitle' => __( '', 'porto' ),
                // 'desc'     => __( 'Field Description', 'porto' ),
                'validate' => 'url',
                'placeholder'  => 'https://twitter.com/',
            ),
            array(
                'id'       => 'social-google',
                'type'     => 'text',
                'title'    => __( 'Google+ URL', 'porto' ),
                // 'subtitle' => __( '', 'porto' ),
                // 'desc'     => __( 'Field Description', 'porto' ),
                'validate' => 'url',
                'placeholder'  => 'https://plus.google.com/',
            ),
            array(
                'id'       => 'social-linkedin',
                'type'     => 'text',
                'title'    => __( 'LinkedIn URL', 'porto' ),
                // 'subtitle' => __( '', 'porto' ),
                // 'desc'     => __( 'Field Description', 'porto' ),
                'validate' => 'url',
                'default'  => 'https://www.linkedin.com/',
                'placeholder'  => 'https://www.linkedin.com/',
            ),
            array(
                'id'       => 'social-github',
                'type'     => 'text',
                'title'    => __( 'Github URL', 'porto' ),
                // 'subtitle' => __( '', 'porto' ),
                // 'desc'     => __( 'Field Description', 'porto' ),
                'validate' => 'url',
                'default'  => 'https://github.com/',
                'placeholder'  => 'https://github.com/',
            ),
            array(
                'id'       => 'social-dribbble',
                'type'     => 'text',
                'title'    => __( 'Dribbble URL', 'porto' ),
                // 'subtitle' => __( '', 'porto' ),
                // 'desc'     => __( 'Field Description', 'porto' ),
                'validate' => 'url',
                'placeholder'  => 'https://dribbble.com/',
            ),
            array(
                'id'       => 'social-behance',
                'type'     => 'text',
                'title'    => __( 'Behance URL', 'porto' ),
                // 'subtitle' => __( '', 'porto' ),
                // 'desc'     => __( 'Field Description', 'porto' ),
                'validate' => 'url',
                'placeholder'  => 'https://www.behance.net/',
            ),
            array(
                'id'       => 'social-codepen',
                'type'     => 'text',
                'title'    => __( 'Codepen URL', 'porto' ),
                // 'subtitle' => __( '', 'porto' ),
                // 'desc'     => __( 'Field Description', 'porto' ),
                'validate' => 'url',
                'placeholder'  => 'https://www.codepen.io/',
            ),
            array(
                'id'       => 'social-stackoverflow',
                'type'     => 'text',
                'title'    => __( 'Stackoverflow URL', 'porto' ),
                // 'subtitle' => __( '', 'porto' ),
                // 'desc'     => __( 'Field Description', 'porto' ),
                'validate' => 'url',
                'placeholder'  => 'https://stackoverflow.com/',
            ),
            array(
                'id'       => 'social-instagram',
                'type'     => 'text',
                'title'    => __( 'Instagram URL', 'porto' ),
                // 'subtitle' => __( '', 'porto' ),
                // 'desc'     => __( 'Field Description', 'porto' ),
                'validate' => 'url',
                'placeholder'  => 'https://www.instagram.com/',
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'id'    => 'copyright',
        'title' => __( 'Copyright', 'redux-framework-demo' ),
        'desc'  => __( 'Basic fields as subsections.', 'redux-framework-demo' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'copyright-text',
                'type'     => 'editor',
                'title'    => __( 'Copyright Text Field', 'redux-framework-demo' ),
                // 'subtitle' => __( 'Subtitle', 'redux-framework-demo' ),
                // 'desc'     => __( 'Field Description', 'redux-framework-demo' ),
                // 'placeholder'  => 'Default Text',
                'args'   => array(
                    'teeny'            => true,
                    'media_buttons'    => false,
                    'textarea_rows'    => 10
                )
            ),
        )
    ) );

    /*
     * <--- END SECTIONS
     */
