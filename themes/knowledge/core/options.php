<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */
    if ( ! class_exists( 'knowledgetheme_options' ) ) {
        class knowledgetheme_options {
            public $args = array();
            public $sections = array();
            public $theme;
            public $ReduxFramework;
            public function __construct() {
                if ( ! class_exists( 'ReduxFramework' ) ) {
                    return;
                }
                if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                    $this->initSettings();
                } else {
                    add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
                }
            }
            public function initSettings() {
                $this->setArguments();
                $this->setHelpTabs();
                $this->setSections();
                if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                    return;
                }
                $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
            }
            public function setSections() {
				$this->sections[] = array(
                    'title'  => __( 'General', 'knowledgetheme' ),
                    'desc'   => __( '', 'knowledgetheme' ),
                    'icon'   => 'el el-icon-puzzle',
                    'fields' => array(
						array(
                            'id'       => 'status-back-top',
                            'type'     => 'switch',
                            'title'    => __( 'Enable Back To Top', 'knowledgetheme' ),
                            'compiler' => 'bool',
                            'desc'     => __( 'Do you want to enable back to top?', 'knowledgetheme' ),
                            'on'        => __('Enabled', 'knowledgetheme'),
                            'off'       => __('Disabled', 'knowledgetheme')
                        ),
					)
				);
                $this->sections[] = array(
                    'title'  => __( 'Header', 'knowledgetheme' ),
                    'desc'   => __( '', 'knowledgetheme' ),
                    'icon'   => 'el el-icon-home',
                    'fields' => array(
                        array(
                            'id'       => 'logo-on',
                            'type'     => 'switch',
                            'title'    => __( 'Enable Image Logo', 'knowledgetheme' ),
                            'compiler' => 'bool',
                            'desc'     => __( 'Do you want to enable image logo?', 'knowledgetheme' ),
                            'on'        => __('Enabled', 'knowledgetheme'),
                            'off'       => __('Disabled', 'knowledgetheme')
                        ),
                        array(
                            'id'    => 'logo-image',
                            'type'  => 'media',
                            'title' => __('Logo Image', 'knowledgetheme'),
                            'desc'  => __('Image that you want to use as logo.', 'knowledgetheme')
                        ),
						array(
                            'id'    => 'favicon-logo-image',
                            'type'  => 'media',
                            'title' => __('Custom Favicon', 'knowledgetheme'),
                            'desc'  => __('Upload a 16x16px PNG/GIF image that will represent your website\'s favicon.', 'knowledgetheme')
                        ),
                    )
                );
				$this->sections[] = array(
                    'title'  => __( 'Social Media', 'knowledgetheme' ),
                    'desc'   => __( '', 'knowledgetheme' ),
                    'icon'   => 'el el-icon-opensource',
                    'fields' => array(
                        array(
							'id'       => 'social-facebook',
							'type'     => 'text',
							'title'    => __('Facebook', 'knowledgetheme'),
							'subtitle' => __('Enter your Facebook Page URL here.', 'knowledgetheme'),
							'desc'     => __('', 'knowledgetheme'),
							'msg'      => 'custom error message',
							'default'  => ''
                        ),
						array(
							'id'       => 'social-twitter',
							'type'     => 'text',
							'title'    => __('Twitter', 'knowledgetheme'),
							'subtitle' => __('Enter your Twitter URL here.', 'knowledgetheme'),
							'desc'     => __('', 'knowledgetheme'),
							'msg'      => 'custom error message',
							'default'  => ''
                        ),
						array(
							'id'       => 'social-pinterest',
							'type'     => 'text',
							'title'    => __('Pinterest', 'knowledgetheme'),
							'subtitle' => __('Enter your Pinterest URL here.', 'knowledgetheme'),
							'desc'     => __('', 'knowledgetheme'),
							'msg'      => 'custom error message',
							'default'  => ''
                        ),
						array(
							'id'       => 'social-instagram',
							'type'     => 'text',
							'title'    => __('Instagram', 'knowledgetheme'),
							'subtitle' => __('Enter your Instagram URL here.', 'knowledgetheme'),
							'desc'     => __('', 'knowledgetheme'),
							'msg'      => 'custom error message',
							'default'  => ''
                        ),
						array(
							'id'       => 'social-googleplus',
							'type'     => 'text',
							'title'    => __('Google Plus', 'knowledgetheme'),
							'subtitle' => __('Enter your Google Plus URL here.', 'knowledgetheme'),
							'desc'     => __('', 'knowledgetheme'),
							'msg'      => 'custom error message',
							'default'  => ''
                        ),
						array(
							'id'       => 'social-youtube',
							'type'     => 'text',
							'title'    => __('Youtube', 'knowledgetheme'),
							'subtitle' => __('Enter your Youtube URL here.', 'knowledgetheme'),
							'desc'     => __('', 'knowledgetheme'),
							'msg'      => 'custom error message',
							'default'  => ''
                        ),
						array(
							'id'       => 'social-linkedin',
							'type'     => 'text',
							'title'    => __('Linkedin', 'knowledgetheme'),
							'subtitle' => __('Enter your Linkedin URL here.', 'knowledgetheme'),
							'desc'     => __('', 'knowledgetheme'),
							'msg'      => 'custom error message',
							'default'  => ''
                        ),
						array(
                            'id'       => 'tweet-on',
                            'type'     => 'switch',
                            'title'    => __( 'Latest Tweet', 'knowledgetheme' ),
							'subtitle' => __('Do you want to enable Tweet?', 'knowledgetheme'),
                            'compiler' => 'bool',
                            'desc'     => __( 'Please use shortcode [tweecool] to show', 'knowledgetheme' ),
                            'on'        => __('Enabled', 'knowledgetheme'),
                            'off'       => __('Disabled', 'knowledgetheme')
                        ),
						array(
							'id'       => 'tweet-username',
							'type'     => 'text',
							'title'    => __('User Name Tweet', 'knowledgetheme'),
							'subtitle' => __('Enter your account here.', 'knowledgetheme'),
							'desc'     => __('', 'knowledgetheme'),
							'msg'      => 'custom error message',
							'default'  => ''
                        ),
						array(
							'id'       => 'tweet-select',
							'type'     => 'select',
							'title'    => __('Number Show', 'knowledgetheme'),
							'subtitle' => __('Please choose number display', 'knowledgetheme'),
							'desc'     => __('', 'knowledgetheme'),
							'msg'      => 'custom error message',
							'options'  => array(
								'2'  => '2',
								'3'  => '3',
								'4'  => '4',
								'5'  => '5',
								'6'  => '6',
								'7'  => '7',
								'8'  => '8',
								'9'  => '9',
								'10' => '10',
							),
							'default'  => '2'
                        ),
                    )
                );
				$this->sections[] = array(
					'title'  => __( 'Footer Info', 'knowledgetheme' ),
                    'desc'   => __( '', 'knowledgetheme' ),
                    'icon'   => 'el el-icon-info-circle',
                    'fields' => array(
                        array(
                            'id'       => 'logo-on-footer',
                            'type'     => 'switch',
                            'title'    => __( 'Enable Image Logo Footer', 'knowledgetheme' ),
                            'compiler' => 'bool',
                            'desc'     => __( 'Do you want to enable image logo footer?', 'knowledgetheme' ),
                            'on'        => __('Enabled', 'knowledgetheme'),
                            'off'       => __('Disabled', 'knowledgetheme')
                        ),
                        array(
                            'id'    => 'logo-image-footer',
                            'type'  => 'media',
                            'title' => __('Logo Footer', 'knowledgetheme'),
                            'desc'  => __('Image that you want to use as logo footer.', 'knowledgetheme')
                        ),
						array(
							'id'       => 'footerinfo-main',
							'type'     => 'textarea',
							'title'    => __('Footer Info Text', 'knowledgetheme'),
							'subtitle' => __('Enter any text to display in the Footer Info Box.', 'knowledgetheme'),
							'desc'     => __('', 'knowledgetheme'),
							'msg'      => 'custom error message',
							'default'  => '',
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
							'id'       => 'copyright-main',
							'type'     => 'textarea',
							'title'    => __('Copyright Text', 'knowledgetheme'),
							'subtitle' => __('Here you can enter any text you want (eg. copyright text)', 'knowledgetheme'),
							'desc'     => __('', 'knowledgetheme'),
							'msg'      => 'custom error message',
							'default'  => '',
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
				);
                /*$this->sections[] = array(
                    'title'  => __( 'Media Services', 'knowledgetheme' ),
                    'desc'   => __( '', 'knowledgetheme' ),
                    'icon'   => 'el el-icon-puzzle',
                    'fields' => array(
                                array(
                                    'id'       => 'title-media-services-shortcode',
                                    'type'     => 'textarea',
                                    'title'    => __('Title Shortcode Text', 'knowledgetheme'),
                                    'subtitle' => __('Enter any text to display in the Shortcode Media.', 'knowledgetheme'),
                                    'desc'     => __('', 'knowledgetheme'),
                                    'msg'      => 'custom error message',
                                    'default'  => '',
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
                                    'id'       => 'subtitle-media-services-shortcode',
                                    'type'     => 'textarea',
                                    'title'    => __('Sub Title Shortcode Text', 'knowledgetheme'),
                                    'subtitle' => __('Enter any text to display in the Sub Shortcode Media.', 'knowledgetheme'),
                                    'desc'     => __('', 'knowledgetheme'),
                                    'msg'      => 'custom error message',
                                    'default'  => '',
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
                );*/
				 
            }
            public function setHelpTabs() {
                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-1',
                    'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
                );
                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-2',
                    'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
                );
                $this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
            }
            public function setArguments() {
                $theme = wp_get_theme(); // For use with some settings. Not necessary.
                $this->args = array(
                    'opt_name'           => 'tp_options',
                    'display_name'       => $theme->get( 'Name' ),
                    'display_version'    => $theme->get( 'Version' ),
                    'menu_type'          => 'menu',
                    'allow_sub_menu'     => true,
                    'menu_title'         => __( 'Theme Options', 'redux-framework-knowledgetheme' ),
                    'page_title'         => __( 'Theme Options', 'redux-framework-knowledgetheme' ),
                    'google_api_key'     => 'AIzaSyAs0iVWrG4E_1bG244-z4HRKJSkg7JVrVQ',
                    'async_typography'   => false,
                    'admin_bar'          => true,
                    'global_variable'    => '',
                    'dev_mode'           => false,
                    'customizer'         => true,
                    'page_priority'      => null,
                    'page_parent'        => 'themes.php',
                    'page_permissions'   => 'manage_options',
                    'menu_icon'          => '',
                    'last_tab'           => '',
                    'page_icon'          => 'icon-themes',
                    'page_slug'          => '_options',
                    'save_defaults'      => true,
                    'default_show'       => false,
                    'default_mark'       => '',
                    'show_import_export' => false,
                    'transient_time'     => 60 * MINUTE_IN_SECONDS,
                    'output'             => true,
                    'output_tag'         => true,
                    'database'           => '',
                    'system_info'        => false,
                    'hints'              => array(
                        'icon'          => 'icon-question-sign',
                        'icon_position' => 'right',
                        'icon_color'    => 'lightgray',
                        'icon_size'     => 'normal',
                        'tip_style'     => array(
                            'color'   => 'light',
                            'shadow'  => true,
                            'rounded' => false,
                            'style'   => '',
                        ),
                        'tip_position'  => array(
                            'my' => 'top left',
                            'at' => 'bottom right',
                        ),
                        'tip_effect'    => array(
                            'show' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'mouseover',
                            ),
                            'hide' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'click mouseleave',
                            ),
                        ),
                    )
                );
            }
        }
        global $reduxConfig;
        $reduxConfig = new knowledgetheme_options();
    }