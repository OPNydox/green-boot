<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('Lukani_Theme_Config')) {

    class Lukani_Theme_Config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }


            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
            
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) { 
            $sections[] = array(
                'title' => esc_html__('Section via hook', 'lukani'),
                'desc' => esc_html__('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'lukani'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) { 

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'lukani'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'lukani'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'lukani'); ?>" />
                <?php endif; ?>

                <h4><?php echo ''.$this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'lukani'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'lukani'), $this->theme->display('Version')); ?></li>
                        <li><?php printf('<strong>' .__('Tags', 'lukani') . ':</strong> '); ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo ''.$this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' .__('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'lukani') . '</p>',__('http://codex.wordpress.org/Child_Themes', 'lukani'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            
            // General
            $this->sections[] = array(
                'title'     => esc_html__('General', 'lukani'),
                'desc'      => esc_html__('General theme options', 'lukani'),
                'icon'      => 'el-icon-cog',
                'fields'    => array( 
                    array(
                        'id'        => 'background_opt',
                        'type'      => 'background',
                        'output'    => array('body'),
                        'title'     => esc_html__('Body background', 'lukani'),
                        'subtitle'  => esc_html__('Upload image or select color. Only work with box layout', 'lukani'),
                        'default'   => array('background-color' => '#ffffff'),
                    ),
                    array(
                        'id'        => 'page_wrapper_background',
                        'type'      => 'background',
                        'output'    => array('.wrapper'),
                        'title'     => esc_html__('Wrapper background', 'lukani'),
                        'subtitle'  => esc_html__('Upload image or select color. Background of page wrapper', 'lukani'),
                        'default'   => array('background-color' => '#ffffff'),
                    ),
                    array(
                        'id'        => 'page_content_background',
                        'type'      => 'background',
                        'output'    => array('.main-container'),
                        'title'     => esc_html__('Page content background', 'lukani'),
                        'subtitle'  => esc_html__('Select background for page content (default: #ffffff).', 'lukani'),
                        'default'   => array('background-color' => '#ffffff'),
                    ), 
                    
                    array( 
                        'id'       => 'border_color',
                        'type'     => 'border',
                        'title'    => esc_html__('Border Option', 'lukani'),
                        'subtitle' => esc_html__('Only color validation can be done on this field type', 'lukani'),
                        'default'  => array('border-color' => '#ebebeb'),
                    ), 
                    array(
                        'id'        => 'back_to_top',
                        'type'      => 'switch',
                        'title'     => esc_html__('Back To Top', 'lukani'),
                        'desc'      => esc_html__('Show back to top button on all pages', 'lukani'),
                        'default'   => true,
                    ),
                ),
            );
			// Colors
            $this->sections[] = array(
                'title'     => esc_html__('Colors', 'lukani'),
                'desc'      => esc_html__('Color options', 'lukani'),
                'icon'      => 'el-icon-tint',
                'fields'    => array(
					array(
                        'id'        => 'primary_color',
                        'type'      => 'color',
                        'title'     => esc_html__('Primary Color', 'lukani'),
                        'subtitle'  => esc_html__('Pick a color for primary color (default: #79a206).', 'lukani'),
						'transparent' => false,
                        'default'   => '#79a206',
                        'validate'  => 'color',
                    ),
					
					array(
                        'id'        => 'sale_color',
                        'type'      => 'color', 
                        'title'     => esc_html__('Sale Label BG Color', 'lukani'),
                        'subtitle'  => esc_html__('Pick a color for bg sale label (default: #dc0f0f).', 'lukani'),
						'transparent' => true,
                        'default'   => '#dc0f0f',
                        'validate'  => 'color',
                    ),
					
					array(
                        'id'        => 'saletext_color',
                        'type'      => 'color', 
                        'title'     => esc_html__('Sale Label Text Color', 'lukani'),
                        'subtitle'  => esc_html__('Pick a color for sale label text (default: #ffffff).', 'lukani'),
						'transparent' => false,
                        'default'   => '#ffffff',
                        'validate'  => 'color',
                    ),
					
					array(
                        'id'        => 'rate_color',
                        'type'      => 'color', 
                        'title'     => esc_html__('Rating Star Color', 'lukani'),
                        'subtitle'  => esc_html__('Pick a color for star of rating (default: #ffb400).', 'lukani'),
						'transparent' => false,
                        'default'   => '#ffb400',
                        'validate'  => 'color',
                    ),
                    array(
                        'id'       => 'link_color',
                        'type'     => 'link_color', 
                        'title'     => esc_html__('Link Color', 'lukani'),
                        'subtitle'  => esc_html__('Pick a color for link (default: #222222).', 'lukani'),
                        'default'  => array(
                            'regular'  => '#222222',
                            'hover'    => '#79a206',
                            'active'   => '#79a206',
                            'visited'  => '#79a206',
                        )
                    ),
                    array(
                        'id'        => 'text_selected_bg',
                        'type'      => 'color',
                        'title'     => esc_html__('Text selected background', 'lukani'),
                        'subtitle'  => esc_html__('Select background for selected text (default: #91b2c3).', 'lukani'),
                        'transparent' => false,
                        'default'   => '#91b2c3',
                        'validate'  => 'color',
                    ),
                    array(
                        'id'        => 'text_selected_color',
                        'type'      => 'color',
                        'title'     => esc_html__('Text selected color', 'lukani'),
                        'subtitle'  => esc_html__('Select color for selected text (default: #ffffff).', 'lukani'),
                        'transparent' => false,
                        'default'   => '#ffffff',
                        'validate'  => 'color',
                    ),
                ),
            );
			
			//Header
            $header_layouts = array();
			$header_default = '';
            $header_mobile_layouts = array();
            $header_mobile_default = '';
			
            $jscomposer_templates_args = array(
                'orderby'          => 'title',
                'order'            => 'ASC',
                'post_type'        => 'templatera',
                'post_status'      => 'publish',
                'posts_per_page'   => 50,
            );
            $jscomposer_templates = get_posts( $jscomposer_templates_args );
            if(count($jscomposer_templates) > 0) {
                foreach($jscomposer_templates as $jscomposer_template){
                    $header_layouts[$jscomposer_template->post_title] = $jscomposer_template->post_title;
                    $header_mobile_layouts[$jscomposer_template->post_title] = $jscomposer_template->post_title;
                }
				$header_default = $jscomposer_templates[0]->post_title;
                $header_mobile_default = $jscomposer_templates[0]->post_title;
            }
            
			$this->sections[] = array(
                'title'     => esc_html__('Header', 'lukani'),
                'desc'      => esc_html__('Header options', 'lukani'),
                'icon'      => 'el-icon-tasks',
                'fields'    => array(

					array(
                        'id'        => 'header_layout',
                        'type'      => 'select',
                        'title'     => esc_html__('Header Layout', 'lukani'),
                        'customizer_only'   => false,
                        'desc'      => esc_html__('Go to Visual Composer => Templates to create/edit layout', 'lukani'),
                        'options'   => $header_layouts,
                        'default'   => $header_default
                    ),
                    array(
                        'id'        => 'header_mobile_layout',
                        'type'      => 'select',
                        'title'     => esc_html__('Header Mobile Layout', 'lukani'),
                        'customizer_only'   => false,
                        'desc'      => esc_html__('Go to Visual Composer => Templates to create/edit layout', 'lukani'),
                        'options'   => $header_mobile_layouts,
                        'default'   => $header_mobile_default
                    ),
                    array(
                        'id'        => 'header_bg',
                        'type'      => 'background',
                        'output'    => array(), 
                        'title'     => esc_html__('Header background', 'lukani'),
                        'subtitle'  => esc_html__('Upload image or select color.', 'lukani'), 
                        'default'   => array('background-color' => '#ffffff'),
                    ),
                    array(
                        'id'        => 'header_color',
                        'type'      => 'color',
                        'output'    => array(),
                        'title'     => esc_html__('Header text color', 'lukani'),
                        'subtitle'  => esc_html__('Pick a color for top bar text color (default: #222222).', 'lukani'),
                        'transparent' => false,
                        'default'   => '#222222',
                        'validate'  => 'color',
                    ),
                    array(
                        'id'       => 'header_link_color',
                        'output'    => array('.header-container a'),
                        'type'     => 'link_color',
                        'title'     => esc_html__('Header link color', 'lukani'),
                        'subtitle'  => esc_html__('Pick a color for header link color (default: #222222).', 'lukani'),
                        'default'  => array(
                            'regular'  => '#222222',
                            'hover'    => '#79a206',
                            'active'   => '#79a206',
                            'visited'  => '#79a206',
                        )
                    ), 
                ),
            );  

            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Sticky header', 'lukani' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'        => 'sticky_header',
                        'type'      => 'switch',
                        'title'     => esc_html__('Use sticky header', 'lukani'),
                        'default'   => true,
                    ),
                    array(
                        'id'        => 'header_sticky_bg',
                        'type'      => 'color_rgba',
                        'title'     => esc_html__('Header sticky background', 'lukani'),
                        'subtitle'  => 'Set color and alpha channel',
                        'output'    => array('background-color' => '.header-sticky.ontop'),
                        'default'   => array(
                            'color'     => '#ffffff',
                            'alpha'     => 0.9
                        ),
                        'options'       => array(
                            'show_input'                => true,
                            'show_initial'              => true,
                            'show_alpha'                => true,
                            'show_palette'              => true,
                            'show_palette_only'         => false,
                            'show_selection_palette'    => true,
                            'max_palette_size'          => 10,
                            'allow_empty'               => true,
                            'clickout_fires_change'     => false,
                            'choose_text'               => 'Choose',
                            'cancel_text'               => 'Cancel',
                            'show_buttons'              => true,
                            'use_extended_classes'      => true,
                            'palette'                   => null,
                            'input_text'                => 'Select Color'
                        ),                        
                    ),
                )
            );
            
            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Top Bar', 'lukani' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'        => 'topbar_bg',
                        'type'      => 'background',
                        'output'    => array(), 
                        'title'     => esc_html__('Top Bar background', 'lukani'),
                        'subtitle'  => esc_html__('Upload image or select color.', 'lukani'), 
                        'default'   => array('background-color' => '#ffffff'),
                    ), 
                    array(
                        'id'        => 'topbar_color',
                        'type'      => 'color',
                        'output'    => array('.top-bar'),
                        'title'     => esc_html__('Top bar text color', 'lukani'),
                        'subtitle'  => esc_html__('Pick a color for top bar text color (default: #a9a9a9).', 'lukani'),
                        'transparent' => false,
                        'default'   => '#666',
                        'validate'  => 'color',
                    ),
                    array(
                        'id'       => 'topbar_link_color',
                        'type'     => 'link_color',
                        'output'    => array('.top-bar a'),
                        'title'     => esc_html__('Top bar link color', 'lukani'),
                        'subtitle'  => esc_html__('Pick a color for top bar link color (default: #222222).', 'lukani'),
                        'default'  => array(
                            'regular'  => '#666',
                            'hover'    => '#79a206',
                            'active'   => '#79a206',
                            'visited'  => '#79a206',
                        )
                    ), 
                )
            );

            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Menu', 'lukani' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'        => 'mobile_menu_label',
                        'type'      => 'text',
                        'title'     => esc_html__('Mobile menu label', 'lukani'),
                        'subtitle'     => esc_html__('The label for mobile menu (example: Menu, Go to...', 'lukani'),
                        'default'   => 'Menu'
                    ), 
                    array(
                        'id'        => 'sub_menu_bg',
                        'type'      => 'color', 
                        'title'     => esc_html__('Submenu background', 'lukani'),
                        'subtitle'  => esc_html__('Pick a color for sub menu bg (default: #ffffff).', 'lukani'),
                        'transparent' => false,
                        'default'   => '#ffffff',
                        'validate'  => 'color',
                    ),
                    array(
                        'id'        => 'sub_menu_color',
                        'type'      => 'color', 
                        'title'     => esc_html__('Submenu color', 'lukani'),
                        'subtitle'  => esc_html__('Pick a color for sub menu color (default: #363f4d).', 'lukani'),
                        'transparent' => false,
                        'default'   => '#666666',
                        'validate'  => 'color',
                    ),
                )
            );
            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Categories Menu', 'lukani' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'        => 'categories_menu_label',
                        'type'      => 'text',
                        'title'     => esc_html__('Categories menu label', 'lukani'),
                        'subtitle'     => esc_html__('The label for categories menu', 'lukani'),
                        'default'   => 'Categories'
                    ),
                    array(
                        'id'        => 'categories_menu_items',
                        'type'      => 'slider',
                        'title'     => esc_html__('Number of items', 'lukani'),
                        'desc'      => esc_html__('Number of menu items level 1 to show, default value: 9', 'lukani'),
                        "default"   => 9,
                        "min"       => 1,
                        "step"      => 1,
                        "max"       => 30,
                        'display_value' => 'text'
                    ),
                    array(
                        'id'        => 'categories_more_label',
                        'type'      => 'text',
                        'title'     => esc_html__('More items label', 'lukani'),
                        'subtitle'     => esc_html__('The label for more items button', 'lukani'),
                        'default'   => 'More'
                    ),
                    array(
                        'id'        => 'categories_less_label',
                        'type'      => 'text',
                        'title'     => esc_html__('Less items label', 'lukani'),
                        'subtitle'     => esc_html__('The label for less items button', 'lukani'),
                        'default'   => 'Less'
                    ),
                    array(
                        'id'        => 'categories_menu_home',
                        'type'      => 'switch',
                        'title'     => esc_html__('Home Categories Menu', 'lukani'),
                        'subtitle'     => esc_html__('Always show categories menu on home page', 'lukani'),
                        'default'   => true,
                    ),
                    array(
                        'id'        => 'categories_menu_sub',
                        'type'      => 'switch',
                        'title'     => esc_html__('Inner Categories Menu', 'lukani'),
                        'subtitle'     => esc_html__('Always show categories menu on inner pages', 'lukani'),
                        'default'   => false,
                    ),
                )
            ); 

			//Footer
            $footer_layouts = array();
			$footer_default = '';
			
            $jscomposer_templates_args = array(
                'orderby'          => 'title',
                'order'            => 'ASC',
                'post_type'        => 'templatera',
                'post_status'      => 'publish',
                'posts_per_page'   => 50,
            );
            $jscomposer_templates = get_posts( $jscomposer_templates_args );

            if(count($jscomposer_templates) > 0) {
                foreach($jscomposer_templates as $jscomposer_template){
                    $footer_layouts[$jscomposer_template->post_title] = $jscomposer_template->post_title;
                }
				$footer_default = $jscomposer_templates[0]->post_title;
            }
            
			$this->sections[] = array(
                'title'     => esc_html__('Footer', 'lukani'),
                'desc'      => esc_html__('Footer options', 'lukani'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(

                    array(
                        'id'        => 'footer_layout',
                        'type'      => 'select',
                        'title'     => esc_html__('Footer Layout', 'lukani'),
                        'customizer_only'   => false,
                        'desc'      => esc_html__('Go to Visual Composer => Templates to create/edit layout', 'lukani'),
                        'options'   => $footer_layouts,
                        'default'   => $footer_default
                    ),
                    array(
                        'id'        => 'footer_bg',
                        'type'      => 'background',
                        'output'    => array(),
                        'title'     => esc_html__('Footer background', 'lukani'),
                        'subtitle'  => esc_html__('Upload image or select color.', 'lukani'),
                        'default'   => array('background-color' => '#ffffff'),
                    ),
                     
                    array(
                        'id'        => 'footer_color',
                        'type'      => 'color',
                        'output'    => array(),
                        'title'     => esc_html__('Footer text color', 'lukani'),
                        'subtitle'  => esc_html__('Pick a color for top bar text color (default: #747474).', 'lukani'),
                        'transparent' => false,
                        'default'   => '#666666',
                        'validate'  => 'color',
                    ),
                    array(
                        'id'       => 'footer_link_color',
                        'type'     => 'link_color',
                        'output'    => array('.footer a'),
                        'title'     => esc_html__('Footer link color', 'lukani'),
                        'subtitle'  => esc_html__('Pick a color for footer link color (default: #747474).', 'lukani'),
                        'default'  => array(
                            'regular'  => '#666666',
                            'hover'    => '#79a206',
                            'active'   => '#79a206',
                            'visited'  => '#79a206',
                        )
                    ),  
                ),
            );  

			//Fonts
            $this->sections[] = array(
                'title'     => esc_html__('Fonts', 'lukani'),
                'desc'      => esc_html__('Fonts options', 'lukani'),
                'icon'      => 'el-icon-font',
                'fields'    => array(

                    array(
                        'id'            => 'bodyfont',
                        'type'          => 'typography',
                        'title'         => esc_html__('Body font', 'lukani'), 
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => true,    // Select a backup non-google font in addition to a google font 
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'text-align'   => false, 
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        => array('body'), // An array of CSS selectors to apply this font style to dynamically 
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => esc_html__('Main body font.', 'lukani'),
                        'default'       => array(
                            'color'         => '#999999',
                            'font-weight'    => '400',
                            'font-family'   => 'Rubik',
                            'google'        => true,
                            'font-size'     => '14px',
                            'line-height'   => '24px'
                        ),
                    ),
                    array(
                        'id'            => 'headingfont',
                        'type'          => 'typography',
                        'title'         => esc_html__('Heading font', 'lukani'), 
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font 
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'font-size'     => false,
                        'line-height'   => false,
                        'text-align'   => false, 
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page 
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => esc_html__('Heading font.', 'lukani'),
                        'default'       => array(
                            'color'         => '#222222',
                            'font-weight'    => '400',
                            'font-family'   => 'Lora',
                            'google'        => true,
                        ),
                    ),   
                    array(
                        'id'            => 'menufont',
                        'type'          => 'typography',
                        'title'         => esc_html__('Menu font', 'lukani'), 
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font 
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        'line-height'   => false,
                        'text-align'   => false, 
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page 
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => esc_html__('Menu font.', 'lukani'),
                        'default'       => array(
                            'color'         => '#222222',
                            'font-weight'    => '500',
                            'font-family'   => 'Rubik',
                            'font-size'     => '13px',
                            'google'        => true,
                        ),
                    ),
                    array(
                        'id'            => 'pricefont',
                        'type'          => 'typography',
                        'title'         => esc_html__('Price font', 'lukani'), 
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font 
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        'line-height'   => false,
                        'text-align'   => false, 
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page 
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => esc_html__('Price font.', 'lukani'),
                        'default'       => array(
                            'color'         => '#222222',
                            'font-weight'    => '500',
                            'font-family'   => 'Rubik', 
                            'font-size'   => '14px', 
                            'google'        => true,
                        ),
                    ),
                ),
            );

			// Layout
            $this->sections[] = array(
                'title'     => esc_html__('Layout', 'lukani'),
                'desc'      => esc_html__('Select page layout: Box or Full Width', 'lukani'),
                'icon'      => 'el-icon-align-justify',
                'fields'    => array(
					array(
						'id'       => 'page_layout',
						'type'     => 'select',
						'multi'    => false,
						'title'    => esc_html__('Page Layout', 'lukani'),
						'options'  => array(
							'full' => 'Full Width',
							'box' => 'Box'
						),
						'default'  => 'Full Width'
					),
                    array(
                        'id'        => 'box_layout_width',
                        'type'      => 'slider',
                        'title'     => esc_html__('Box layout width', 'lukani'),
                        'desc'      => esc_html__('Box layout width in pixels, default value: 1770', 'lukani'),
                        "default"   => 1200,
                        "min"       => 960,
                        "step"      => 1,
                        "max"       => 1920,
                        'display_value' => 'text'
                    ),
					array(
                        'id'        => 'preset_option',
                        'type'      => 'select',
                        'title'     => esc_html__('Preset', 'lukani'),
						'subtitle'      => esc_html__('Select a preset to quickly apply pre-defined colors and fonts', 'lukani'),
                       'customizer_only'   => false,
                        'options'   => array(
							'1' => 'Use options',
                            '2' => 'Preset 2',
                            '3' => 'Preset 3',
                            '4' => 'Preset 4', 
                        ),
                        'default'   => '1'
                    ),
					array(
                        'id'        => 'enable_sswitcher',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show Style Switcher', 'lukani'),
						'subtitle'     => esc_html__('The style switcher is only for preview on front-end', 'lukani'),
						'default'   => false,
                    ),
                ),
            );
			
			//Brand logos
			$this->sections[] = array(
                'title'     => esc_html__('Brand Logos', 'lukani'),
                'desc'      => esc_html__('Upload brand logos and links', 'lukani'),
                'icon'      => 'el-icon-briefcase',
                'fields'    => array( 
                    array(
                        'id'          => 'brand_logos',
                        'type'        => 'slides',
                        'title'       => esc_html__('Logos', 'lukani'),
                        'desc'        => esc_html__('Upload logo image and enter logo link.', 'lukani'),
                        'placeholder' => array(
                            'title'           => esc_html__('Title', 'lukani'),
                            'description'     => esc_html__('Description', 'lukani'),
                            'url'             => esc_html__('Link', 'lukani'),
                        ),
                    ),
                ),
            );

            //Categories carousel
            $this->sections[] = array(
                'title'     => esc_html__('Categories carousel', 'lukani'),
                'desc'      => esc_html__('Upload category logos and links', 'lukani'),
                'icon'      => 'el-icon-briefcase',
                'fields'    => array( 
                    array(
                        'id'          => 'cate_images',
                        'type'        => 'slides',
                        'title'       => esc_html__('Images', 'lukani'),
                        'desc'        => esc_html__('Upload Categories image and enter categories link.', 'lukani'),
                        'placeholder' => array(
                            'title'           => esc_html__('Title', 'lukani'),
                            'description'     => esc_html__('Number products', 'lukani'),
                            'url'             => esc_html__('Link', 'lukani'),
                        ),
                    ),
                ),
            ); 

			// Sidebar
			$this->sections[] = array(
                'title'     => esc_html__('Sidebar', 'lukani'),
                'desc'      => esc_html__('Sidebar options', 'lukani'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(
					
					array(
                        'id'       => 'sidebarshop_pos',
                        'type'     => 'radio',
                        'title'    => esc_html__('Shop Sidebar Position', 'lukani'),
                        'subtitle'      => esc_html__('Sidebar on shop page', 'lukani'),
                        'options'  => array(
                            'left' => 'Left',
                            'right' => 'Right'),
                        'default'  => 'left'
                    ),
                    array(
                        'id'       => 'sidebarse_pos',
                        'type'     => 'radio',
                        'title'    => esc_html__('Pages Sidebar Position', 'lukani'),
                        'subtitle'      => esc_html__('Sidebar on pages', 'lukani'),
                        'options'  => array(
                            'left' => 'Left',
                            'right' => 'Right'),
                        'default'  => 'left'
                    ),
                    array(
                        'id'       => 'sidebarblog_pos',
                        'type'     => 'radio',
                        'title'    => esc_html__('Blog Sidebar Position', 'lukani'),
                        'subtitle'      => esc_html__('Sidebar on Blog pages', 'lukani'),
                        'options'  => array(
                            'left' => 'Left',
                            'right' => 'Right'),
                        'default'  => 'right'
                    ),
                    array(
                        'id'=>'custom-sidebars',
                        'type' => 'multi_text',
                        'title' => esc_html__('Custom Sidebars', 'lukani'),
                        'subtitle' => esc_html__('Add more sidebars', 'lukani'),
                        'desc' => esc_html__('Enter sidebar name (Only allow digits and letters). click Add more to add more sidebar. Edit your page to select a sidebar ', 'lukani')
                    ),
                ),
            );
			
			// Product
            $this->sections[] = array(
                'title'     => esc_html__('Product', 'lukani'),
                'desc'      => esc_html__('Use this section to select options for product', 'lukani'),
                'icon'      => 'el-icon-tags',
                'fields'    => array(
					array(
                        'id'        => 'shop_layout',
                        'type'      => 'select',
                        'title'     => esc_html__('Shop Layout', 'lukani'),
                        'options'   => array(
                            'sidebar' => 'Sidebar',
                            'fullwidth' => 'Full Width',
                        ),
                        'default'   => 'Sidebar'
                    ),
                    array(
                        'id'        => 'default_view',
                        'type'      => 'select',
                        'title'     => esc_html__('Shop default view', 'lukani'),
                        'options'   => array(
                            'grid-view' => 'Grid View',
                            'list-view' => 'List View',
                        ),
                        'default'   => 'grid-view'
                    ),
                    array(
                        'id'        => 'product_per_page',
                        'type'      => 'slider',
                        'title'     => esc_html__('Products per page', 'lukani'),
                        'subtitle'      => esc_html__('Amount of products per page on category page', 'lukani'),
                        "default"   => 12,
                        "min"       => 4,
                        "step"      => 1,
                        "max"       => 48,
                        'display_value' => 'text'
                    ),
                    array(
                        'id'        => 'product_per_row',
                        'type'      => 'slider',
                        'title'     => esc_html__('Product columns', 'lukani'),
                        'subtitle'      => esc_html__('Amount of product columns on category page', 'lukani'),
                        'desc'      => esc_html__('Only works with: 1, 2, 3, 4, 6', 'lukani'),
                        "default"   => 3,
                        "min"       => 1,
                        "step"      => 1,
                        "max"       => 6,
                        'display_value' => 'text'
                    ),
                    array(
                        'id'        => 'product_per_row_fw',
                        'type'      => 'slider',
                        'title'     => esc_html__('Product columns on full width shop', 'lukani'),
                        'subtitle'      => esc_html__('Amount of product columns on full width category page', 'lukani'),
                        'desc'      => esc_html__('Only works with: 1, 2, 3, 4, 6', 'lukani'),
                        "default"   => 4,
                        "min"       => 1,
                        "step"      => 1,
                        "max"       => 6,
                        'display_value' => 'text'
                    ), 
                    array(
                        'id'       => 'second_image',
                        'type'     => 'switch',
                        'title'    => esc_html__('Use secondary product image', 'lukani'),
                        'desc'      => esc_html__('Show the secondary image when hover on product on list', 'lukani'),
                        'default'  => false,
                    ), 
                    array(
                        'id'        => 'upsells_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Up-Sells title', 'lukani'),
                        'default'   => 'Upsell Products'
                    ),
                    array(
                        'id'        => 'crosssells_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Cross-Sells title', 'lukani'),
                        'default'   => 'Cross-Sells'
                    ),
                ),
            );
			 
            

            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Product page', 'lukani' ),
                'subsection' => true,
                'fields'     => array(
                    
					array(
                        'id'        => 'related_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Related products title', 'lukani'),
                        'default'   => 'Related Products'
                    ),
                    array(
                        'id'        => 'related_amount',
                        'type'      => 'slider',
                        'title'     => esc_html__('Number of related products', 'lukani'),
                        "default"   => 6,
                        "min"       => 1,
                        "step"      => 1,
                        "max"       => 16,
                        'display_value' => 'text'
                    ),
                    array(
                        'id'        => 'upsells_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Up-Sells title', 'lukani'),
                        'default'   => 'Up-Sells'
                    ),
                    array(
                        'id'=>'share_head_code',
                        'type' => 'textarea',
                        'title' => esc_html__('ShareThis/AddThis head tag', 'lukani'), 
                        'desc' => esc_html__('Paste your ShareThis or AddThis head tag here', 'lukani'),
                        'default' => '',
                    ),
                    array(
                        'id'=>'share_code',
                        'type' => 'textarea',
                        'title' => esc_html__('ShareThis/AddThis code', 'lukani'), 
                        'desc' => esc_html__('Paste your ShareThis or AddThis code here', 'lukani'),
                        'default' => ''
                    ),
                )
            );
            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Quick View', 'lukani' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'        => 'quickview_link_text',
                        'type'      => 'text',
                        'title'     => esc_html__('View all features text', 'lukani'),
                        'desc'      => esc_html__('This is the text on quick view box', 'lukani'),
                        'default'   => 'See all features'
                    ),
                    array(
                        'id'        => 'quickview',
                        'type'      => 'switch',
                        'title'     => esc_html__('Quick View', 'lukani'),
                        'desc'      => esc_html__('Show quick view button on all pages', 'lukani'),
                        'default'   => true,
                    ),
                )
            );
			// Blog options
            $this->sections[] = array(
                'title'     => esc_html__('Blog', 'lukani'),
                'desc'      => esc_html__('Use this section to select options for blog', 'lukani'),
                'icon'      => 'el-icon-file',
                'fields'    => array( 
					array(
                        'id'        => 'blog_header_text',
                        'type'      => 'text',
                        'title'     => esc_html__('Blog header text', 'lukani'),
                        'default'   => 'Blog'
                    ), 
                    array(
                        'id'        => 'blog_layout',
                        'type'      => 'select',
                        'title'     => esc_html__('Blog Layout', 'lukani'),
                        'options'   => array(
							'largeimage' => 'Large Image',
                            'nosidebar' => 'No Sidebar',
                            'sidebar' => 'Sidebar',
                        ),
                        'default'   => 'sidebar'
                    ),
                    array(
                        'id'        => 'blog_style',
                        'type'      => 'select',
                        'title'     => esc_html__('Blog Style', 'lukani'),
                        'options'   => array( 
                            'style_v1' => 'Style Version 1',
                            'style_v2' => 'Style Version 2',
                            'style_v3' => 'Style Version 3',
                            'style_v4' => 'Style Version 4', 
                        ),
                        'default'   => 'style_v2'
                    ),
                    array(
                        'id'        => 'width_cate_thumb',
                        'type'      => 'text',
                        'title'     => esc_html__('Width of thumbnail category ', 'lukani'),
                        'default'   => '961'
                    ),
                    array(
                        'id'        => 'height_cate_thumb',
                        'type'      => 'text',
                        'title'     => esc_html__('Height of thumbnail category ', 'lukani'),
                        'default'   => '806'
                    ),
                    array(
                        'id'        => 'readmore_text',
                        'type'      => 'text',
                        'title'     => esc_html__('Read more text', 'lukani'),
                        'default'   => 'read more'
                    ),
                    array(
                        'id'        => 'excerpt_length',
                        'type'      => 'slider',
                        'title'     => esc_html__('Excerpt length on blog page', 'lukani'),
                        "default"   => 22,
                        "min"       => 10,
                        "step"      => 2,
                        "max"       => 120,
                        'display_value' => 'text'
                    ), 
                ),
            );
			$this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Latest posts carousel', 'lukani' ),
                'subsection' => true,
                'fields'     => array(
                     
                    array(
                        'id'        => 'width_thumb',
                        'type'      => 'text',
                        'title'     => esc_html__('Width of thumbnail ', 'lukani'),
                        'default'   => '468'
                    ),
                    array(
                        'id'        => 'height_thumb',
                        'type'      => 'text',
                        'title'     => esc_html__('Height of thumbnail ', 'lukani'),
                        'default'   => '316'
                    ),
                )
            );
			// Testimonials options
            $this->sections[] = array(
                'title'     => esc_html__('Testimonials', 'lukani'),
                'desc'      => esc_html__('Use this section to select options for Testimonials', 'lukani'),
                'icon'      => 'el-icon-comment',
                'fields'    => array(
					array(
						'id'       => 'testiscroll',
						'type'     => 'switch',
						'title'    => esc_html__('Auto scroll', 'lukani'),
						'default'  => true,
					), 
					array(
						'id'        => 'testianimate',
						'type'      => 'slider',
						'title'     => esc_html__('Animate in (seconds)', 'lukani'),
						'desc'      => esc_html__('Animate time, default value: 2000', 'lukani'),
						"default"   => 2000,
						"min"       => 300,
						"step"      => 100,
						"max"       => 5000,
						'display_value' => 'text'
					),
                ),
            );
			// Error 404 page
            $this->sections[] = array(
                'title'     => esc_html__('Error 404 Page', 'lukani'),
                'desc'      => esc_html__('Error 404 page options', 'lukani'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(
                    array(
                        'id'        => 'background_error',
                        'type'      => 'background',
                        'output'    => array('body.error404'),
                        'title'     => esc_html__('Error 404 background', 'lukani'),
                        'subtitle'  => esc_html__('Upload image or select color.', 'lukani'),
                        'default'   => array('background-color' => '#f2f2f2'),
                    ),
                ),
            );
			 
			// Less Compiler
            $this->sections[] = array(
                'title'     => esc_html__('Less Compiler', 'lukani'),
                'desc'      => esc_html__('Turn on this option to apply all theme options. Turn of when you have finished changing theme options and your site is ready.', 'lukani'),
                'icon'      => 'el-icon-wrench',
                'fields'    => array(
					array(
                        'id'        => 'enable_less',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable Less Compiler', 'lukani'),
						'default'   => true,
                    ),
                ),
            );
			
            $theme_info  = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . esc_html__('<strong>Theme URL:</strong> ', 'lukani') . '<a href="' . esc_url($this->theme->get('ThemeURI')) . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . esc_html__('<strong>Author:</strong> ', 'lukani') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . esc_html__('<strong>Version:</strong> ', 'lukani') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . esc_html__('<strong>Tags:</strong> ', 'lukani') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            $this->sections[] = array(
                'title'     => esc_html__('Import / Export', 'lukani'),
                'desc'      => esc_html__('Import and Export your Redux Framework settings from file, text or URL.', 'lukani'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );

            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => esc_html__('Theme Information', 'lukani'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            );
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => esc_html__('Theme Information 1', 'lukani'),
                'content'   => esc_html__('<p>This is the tab content, HTML is allowed.</p>', 'lukani')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => esc_html__('Theme Information 2', 'lukani'),
                'content'   => esc_html__('<p>This is the tab content, HTML is allowed.</p>', 'lukani')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = esc_html__('<p>This is the sidebar content, HTML is allowed.</p>', 'lukani');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'lukani_opt',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => esc_html__('Theme Options', 'lukani'),
                'page_title'        => esc_html__('Theme Options', 'lukani'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => true,                    // Use a asynchronous font on the front end or font string 
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => true,                    // Enable basic customizer support 

                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head 
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            ); 

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
              } else {
            }

        }

    }
    
    global $reduxConfig;
    $reduxConfig = new Lukani_Theme_Config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing'; 

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
