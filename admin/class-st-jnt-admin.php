<?php 
/**
 * 
 * @package stjnttracker
 * 
 * */

class St_Jnt_Admin {
    
    public $settingsobj = null;    
    public function __construct(){
        $this->settingsobj = new StJntSettings();
        $this->define_hooks();
    }
    public function define_hooks(){

        add_action('plugins_loaded',array($this, 'st_check_woocommerce_activated'));
        add_action('admin_enqueue_scripts', array($this, 'st_jnt_scriptsandstyles'));
        add_action('admin_menu', array($this, 'st_add_manu_page'));
        add_shortcode('get_woo_prod_dtls', array($this, 'fetch_woo_order_details'));
        add_filter("plugin_action_links_".plugin_basename(__FILE__), array($this, 'st_jnt_settings_page_link'));
    }
    /**
     * Check WooCommerce is Installed
     * */
    public function st_check_woocommerce_activated(){
        if( defined( 'WC_VERSION' )){
            return;
        }

        add_action('admin_notices', array($this, 'st_notice_woocommerce_msg'));
    }
    /**
     * Admin Error woocommerce is required
     * */
    public function st_notice_woocommerce_msg(){
        ?>
        <div class="notice notice-error">
            <p><?= 'ST J&T requires WooCommerce to be installed and activated!' ?></p>
        </div>
        <?php
    }
    /**
     * Enqueue scripts and styles
     * */
    public function st_jnt_scriptsandstyles(){
        wp_enqueue_style('st_jnt_styles', plugins_url('st-jnt-tracker/assets/css/st-jnt-css.css'), __FILE__);
        wp_enqueue_script('st_jnt_scripts', plugins_url('st-jnt-tracker/assets/js/st-jnt-js.js'), __FILE__);
    }
    /**
     * Add Admin Menu Page
     * */
    public function st_add_manu_page()
    {
        add_menu_page(
            'ST J&T Express Tracker Settings', 
            'St-J&T', 
            'manage_options', 
            'stjnttracker', 
             array($this, 'load_st_jnt_settings_template') , 
            'dashicons-archive', 
             120
        );
    }
    /**
     * St Jnt Settings Template
     * */
    public function load_st_jnt_settings_template(){
        // ristrict non-admin users to access page
        if(!current_user_can('manage_options'))
            die;
        if(isset($_REQUEST['jntsettings'])){
            $this->settingsobj->st_jnt_manage_settings_options($_REQUEST);    
        }
        require_once ST_PLUGIN_DIR. 'admin/templates/st-jnt-settings-template.php';
    }
    /**
     * Settings Page Link
     * */
    public function st_jnt_settings_page_link($links){
        $settings_link = '<a href="admin.php?page=stjnttracker">'.__('Settings').'</a>';
            array_push( $links, $settings_link);
            return $links;
    }
    /**
     * Short Code for testing
     * */
    public function fetch_woo_order_details(){
        $order_id = '60';
            echo (get_post_meta($order_id, 'txlogisticId', $single=true)).'<br/>';
            echo (get_post_meta($order_id, 'billcode', $single=true)).'<br/>';
            echo (get_post_meta($order_id, 'createOrderTime', $single=true)).'<br/>';
         // require_once ST_PLUGIN_DIR. 'admin/class-st-jnt-createOrder.php';   
         // $orderobj = new St_Jnt_CreateOrder();
         // $orderobj->st_jnt_action_on_orderprocessing(60);   
    }
}