<?php 
/**
 * 
 * @package stjnttracker
 * 
 * */

class St_Jnt_CreateOrder{

    public $st_jnt_helpderCtrl = null;
    public function __construct(){
        $this->st_jnt_helpderCtrl = new St_Jnt_helper();
        $this->define_hooks();
    }
    /**
     * Define action Hooks for createorder
     * */
    public function define_hooks(){
        add_action('woocommerce_order_status_processing', 'st_jnt_action_on_orderprocessing', 10, 1);
    }
    /**
     * function to manage create order
     * */
    function st_jnt_action_on_orderprocessing($order_id){
         $this->st_jnt_helpderCtrl->st_jnt_orderprocessing($order_id);   
    }

}