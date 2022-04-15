<?php 
/**
 * 
 * @package stjnttracker
 * 
 * */
class StJntSettings{

    public function __construct(){
        $this->initsettings();
    }
    public function initsettings(){

        add_action('admin_init', array($this, 'initialize_settings_options'));
    }
    /**
     * Initializing Settings Options 
     * */
    public function initialize_settings_options(){

        if(!get_option('st-jnt-settings')){
            add_option('st-jnt-settings');
        }
    }
    /**
     * function to handel settings post request
     * */
    public function st_jnt_manage_settings_options($postdata){
        $settingsoptsdata = array(
            'st_jnt_vipcode' => $_REQUEST['st_jnt_vipcode'],
            'st_jnt_password' => $_REQUEST['st_jnt_password'],
            'st_jnt_api_acc' => $_REQUEST['st_jnt_api_acc'],
            'st_jnt_private_key' => $_REQUEST['st_jnt_private_key'],
            'st_jnt_sedername' => $_REQUEST['st_jnt_sedername'],
            'st_jnt_sndrphono' => $_REQUEST['st_jnt_sndrphono'],
            'st_jnt_servicetype' => $_REQUEST['st_jnt_servicetype']
        );
        update_option('st-jnt-settings',  $settingsoptsdata);
    }

}