<?php 
/**
 * 
 * @package stjnttracker
 * 
 * */

class St_Jnt_helper{

    public $st_jnt_api_ctrl = null;

    public function __construct(){
        $this->st_jnt_api_ctrl = new St_Jnt_apiCtrl();
    }
    /*
    * Function for Creating Order on J&T Express
    * @param $order_id int woocommerce order id
    */
    public function st_jnt_orderprocessing($order_id){
        $settings = get_option('st-jnt-settings');
        if(isset($order_id) && $order_id > 0){

            $order = wc_get_order($order_id);
            $order_data = $order->get_data();
            $billingdetails = $order_data['billing'];

            $st_jnt_body_digest = $this->st_jnt_body_digest($settings['st_jnt_vipcode'], $settings['st_jnt_password'], $settings['st_jnt_private_key']);

            $receiver_array = array(
                "name"=>$billingdetails['first_name'].' '.$billingdetails['last_name'],
                "mobile"=>"0533666344",
                "countryCode"=>"KSA",
                "prov"=>$billingdetails['state'],
                "city"=>$billingdetails['city'],
                "address"=>$billingdetails['address_1'].' '.$billingdetails['address_2'],
                "street"=>"",
                "mailBox"=>$billingdetails['email'],
                "phone"=>"",
                "company"=>"",
                "postCode"=>"",
            );
            $sender_array = array(
                    "name"=>"Salasa Test",
                    "mobile"=>"966500000000",
                    "phone"=>"",
                    "countryCode"=>get_option('woocommerce_default_country'),
                    "prov"=>"Riyadh",
                    "city"=>get_option('woocommerce_store_city'),
                    "address"=>get_option('woocommerce_store_address').' '.get_option('woocommerce_store_address_2'),
                    "street"=>"",
                    "mailBox"=>"salasa@gmail.com",
                    "company"=>"company",
                    "postCode"=>get_option('woocommerce_store_postcode'),
                );
            $items_array = array();
            if ( sizeof( $order->get_items() ) > 0 ) {
                    foreach ( $order->get_items() as $item ) {
                        if ( $item['product_id'] > 0 ) {
                            $itemsdata['englishName']="file";
                            $itemsdata['number']=$item['quantity'];
                            $itemsdata['itemType']="ITN4";
                            $itemsdata['itemName']=$item['name'];
                            $itemsdata['priceCurrency']="SAR";
                            $itemsdata['itemValue']=$item['subtotal'];
                            $itemsdata['itemUrl']="";
                            $itemsdata['desc']="";
                        }
                        array_push($items_array, $itemsdata);
                    }
                }
            $post_data = array(
                        "customerCode"=>$settings['st_jnt_vipcode'],
                        "digest"=>$st_jnt_body_digest,
                        "serviceType"=>"02",
                        "orderType"=>"2",
                        "deliveryType"=>"04",
                        "countryCode"=>'UAE',
                        "receiver"=>$receiver_array,
                        "expressType"=>"EZKSA",
                        "length"=>0,
                        "weight"=>15,
                        "remark"=>"description goes here",
                        "txlogisticId"=>"AAAA12312356",
                        "goodsType"=>"ITN1",
                        "priceCurrency"=>"SAR",
                        "totalQuantity"=>1,
                        "sender"=>$sender_array,
                        "itemsValue"=>10,
                        "offerFee"=>0,
                        "items"=>$items_array,
                        "operateType"=>1,
                        "payType"=>"PP_PM",
                        "isUnpackEnabled"=>0
                        );
            
            $jsondata = json_encode($post_data);    
            $header_digest = $this->st_jnt_header_digest($jsondata, $settings['st_jnt_private_key']);
            $post_array = array('bizContent' => $jsondata);
            $this->st_jnt_api_ctrl->create_order($settings['st_jnt_api_acc'], $header_digest, '1565238848921' ,$post_array, $order_id);
        }
    }
    /**
     * header Digest
     * */
    function st_jnt_header_digest($jsondata, $privatekey){
        $digest= base64_encode(pack('H*',strtoupper(md5($jsondata.$privatekey))));
        return $digest;
    }
    /**
     * Content Digest
     * */
    function st_jnt_body_digest($customercode, $pwd, $privatekey){
        $str = strtoupper($customercode.md5($pwd.'jadada236t2')).$privatekey;
        return base64_encode(pack('H*', strtoupper(md5($str))));
    }
    /**
     * Current Time in Milliseconds
     * */
    function st_jnt_timestamp(){
        return round(microtime(true) * 1000);
    }



}