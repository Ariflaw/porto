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
        'default_mark'          => '*',
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

    Redux::setSection( $opt_name, array(
        'title'  => __( 'Basic Field', 'redux-framework-demo' ),
        'id'     => 'basic',
        'desc'   => __( 'Basic field with no subsections.', 'redux-framework-demo' ),
        'icon'   => 'el el-home',
        'fields' => array(
            array(
                'id'       => 'opt-text',
                'type'     => 'text',
                'title'    => __( 'Example Text', 'redux-framework-demo' ),
                'desc'     => __( 'Example description.', 'redux-framework-demo' ),
                'subtitle' => __( 'Example subtitle.', 'redux-framework-demo' ),
            )
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title' => __( 'Basic Fields', 'redux-framework-demo' ),
        'id'    => 'basic',
        'desc'  => __( 'Basic fields as subsections.', 'redux-framework-demo' ),
        'icon'  => 'el el-home'
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Text', 'redux-framework-demo' ),
        'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="http://docs.reduxframework.com/core/fields/text/" target="_blank">http://docs.reduxframework.com/core/fields/text/</a>',
        'id'         => 'opt-text-subsection',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'text-example',
                'type'     => 'text',
                'title'    => __( 'Text Field', 'redux-framework-demo' ),
                'subtitle' => __( 'Subtitle', 'redux-framework-demo' ),
                'desc'     => __( 'Field Description', 'redux-framework-demo' ),
                'default'  => 'Default Text',
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Text Area', 'redux-framework-demo' ),
        'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="http://docs.reduxframework.com/core/fields/textarea/" target="_blank">http://docs.reduxframework.com/core/fields/textarea/</a>',
        'id'         => 'opt-textarea-subsection',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'textarea-example',
                'type'     => 'textarea',
                'title'    => __( 'Text Area Field', 'redux-framework-demo' ),
                'subtitle' => __( 'Subtitle', 'redux-framework-demo' ),
                'desc'     => __( 'Field Description', 'redux-framework-demo' ),
                'default'  => 'Default Text',
            ),
        )
    ) );

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
            'id'       => 'opt-text5',
            'type'     => 'text',
            'title'    => __( 'Example Text', 'redux-framework-demo' ),
            'desc'     => __( 'Example description.', 'redux-framework-demo' ),
            'subtitle' => __( 'Example subtitle.', 'redux-framework-demo' ),
            )
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'  => __( 'Header', 'redux-framework-demo' ),
        'id'     => 'header',
        'desc'   => __( 'Customize the header section', 'redux-framework-demo' ),
        'icon'   => 'el el-website',
        )
    );

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

    /**
     * ============================================================================
     * FOOTER
     * ============================================================================
     */
    Redux::setSection( $opt_name, array(
        'title' => __( 'Footer', 'redux-framework-demo' ),
        'id'    => 'footer',
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

        )
    ) );

    Redux::setSection( $opt_name, array(
        'title' => __( 'Footer', 'porto' ),
        'id'    => 'footer',
        'desc'  => __( 'Customize the footer section.', 'porto' ),
        'icon'  => 'el el-photo',
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Social Accounts', 'porto' ),
        'desc'       => __( 'Paste your social acoounts on the fields.', 'porto' ),
        'id'         => 'social-accounts',
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
        'title' => __( 'Copyright', 'redux-framework-demo' ),
        'id'    => 'copyright',
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
