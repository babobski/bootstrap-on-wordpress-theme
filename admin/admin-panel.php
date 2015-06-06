<?php
	/**
	 *
	 * Bootstrap Admin panel
	 *
	 * @package 	WordPress
	 * @subpackage 	Bootstrap 4.3.3
	 * @autor 		Babobski
	 *
	 */
    
class bootstrapSettingPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Bootstrap 3.3.4 Theme settings', 
            'Bootstrap 3.3.4', 
            'manage_options', 
            'my-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'bootstrap_theme_options' );
        ?>
        <div class="wrap">
            <h2><?php echo __('Bootstrap 3.3.4 Theme Settings', 'wp_babobski'); ?></h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'bootstrap_options_group' );   
                do_settings_sections( 'my-setting-admin' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'bootstrap_options_group', // Option group
            'bootstrap_theme_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );
        
        //adding sections
         add_settings_section(
            'bootstrap_site_settings', // ID
            __('Site Settings', 'wp_babobski'), // Title
            array( $this, 'print_section_info_site' ), // Callback
            'my-setting-admin' // Page
        );  

        add_settings_section(
            'bootstrap_seo_settings', // ID
            __('Seo Settings', 'wp_babobski'), // Title
            array( $this, 'print_section_info_seo' ), // Callback
            'my-setting-admin' // Page
        );
        
         add_settings_field(
            'site_title_company_ending', // ID
            __('Display company name after title', 'wp_babobski'), // Title 
            array( $this, 'site_company_ending_calback' ), // Callback
            'my-setting-admin', // Page
            'bootstrap_site_settings' // Section           
        );
         
         add_settings_field(
            'site_title_separator', // ID
            __('Title separator', 'wp_babobski'), // Title 
            array( $this, 'site_title_separator_calback' ), // Callback
            'my-setting-admin', // Page
            'bootstrap_site_settings' // Section           
        ); 

        add_settings_field(
            'home_seo_title', // ID
            __('Homepage Seo title', 'wp_babobski'), // Title 
            array( $this, 'home_seo_title_calback' ), // Callback
            'my-setting-admin', // Page
            'bootstrap_seo_settings' // Section           
        );      

        add_settings_field(
            'home_seo_desc', 
            __('Hompage Seo Description', 'wp_babobski'), 
            array( $this, 'home_seo_desc_callback' ), 
            'my-setting-admin', 
            'bootstrap_seo_settings'
        );
        add_settings_field(
            'home_seo_key', 
            __('Hompage Seo Keywords', 'wp_babobski'), 
            array( $this, 'home_seo_key_callback' ), 
            'my-setting-admin', 
            'bootstrap_seo_settings'
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['home_site_title_company_ending'] ) )
            $new_input['home_site_title_company_ending'] =   sanitize_text_field( $input['home_site_title_company_ending'] );
        
        if( isset( $input['home_seo_title'] ) )
            $new_input['home_seo_title'] = sanitize_text_field( $input['home_seo_title'] );
            
        if( isset( $input['site_title_separator'] ) )
            $new_input['site_title_separator'] = sanitize_text_field( $input['site_title_separator'] );
            
        if( isset( $input['home_seo_desc'] ) )
            $new_input['home_seo_desc'] = sanitize_text_field( $input['home_seo_desc'] );
            
        if( isset( $input['home_seo_key'] ) )
            $new_input['home_seo_key'] = sanitize_text_field( $input['home_seo_key'] );

        return $new_input;
    }
    /** 
     * Print the Section text
     */
     public function print_section_info_site()
    {
        print __('Some site defaults', 'wp_babobski');
    }
    
    public function site_company_ending_calback()
    {
        printf(
            '<input type="checkbox" id="home_site_title_company_ending" name="bootstrap_theme_options[home_site_title_company_ending]" %s />',
            isset( $this->options['home_site_title_company_ending'] ) ? 'checked="checked"' : ''
        );
    }
    
    public function site_title_separator_calback()
    {
         printf(
            '<input type="text" id="site_title_separator" name="bootstrap_theme_options[site_title_separator]" size="12" value="%s" />',
            isset( $this->options['site_title_separator'] ) ? esc_attr( $this->options['site_title_separator']) : ''
        );
    }
    
    public function print_section_info_seo()
    {
        print __('Homepage settings:', 'wp_babobski');
    }

    public function home_seo_title_calback()
    {
        printf(
            '<input type="text" id="home_seo_title" name="bootstrap_theme_options[home_seo_title]" size="52" value="%s" />',
            isset( $this->options['home_seo_title'] ) ? esc_attr( $this->options['home_seo_title']) : ''
        );
    }

    public function home_seo_desc_callback()
    {
        printf(
            '<textarea id="home_seo_desc" name="bootstrap_theme_options[home_seo_desc]" cols="50" rows="5">%s</textarea>',
            isset( $this->options['home_seo_desc'] ) ? esc_attr( $this->options['home_seo_desc']) : ''
        );
    }
    
    public function home_seo_key_callback()
    {
        printf(
            '<textarea id="home_seo_key" name="bootstrap_theme_options[home_seo_key]" cols="50" rows="5">%s</textarea>',
            isset( $this->options['home_seo_key'] ) ? esc_attr( $this->options['home_seo_key']) : ''
        );
    }
}

if( is_admin() )
    $my_settings_page = new bootstrapSettingPage();
?>


