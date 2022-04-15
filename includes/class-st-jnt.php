<?php 
/**
 * 
 * @package stjnttracker
 * 
 * */

class StJnt{

    public function InitPlugin(){
        require_once ST_PLUGIN_DIR . 'admin/class-st-jnt-admin.php';
        require_once ST_PLUGIN_DIR . 'admin/class-st-jnt-settings.php';
        require_once ST_PLUGIN_DIR . 'admin/class-st-jnt-createOrder.php';

        require_once ST_PLUGIN_DIR . 'includes/class-st-jnt-helper.php';
        require_once ST_PLUGIN_DIR . 'includes/class-st-jnt-apiController.php';
        
        // Initializing the classes
        new St_Jnt_Admin();
        new StJntSettings();
        new St_Jnt_CreateOrder();
        new St_Jnt_helper();
        new St_Jnt_apiCtrl();
    }
}