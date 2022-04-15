<?php 
/**
 * 
 * @package stjnttracker
 * 
 * */

class St_Jnt_apiCtrl{
    /**
     * @param count 4
     * @param $apiacc API Account
     * @param $headerdigest Header Digest
     * @param $timestamp current timestamp
     * @param $post_array data in array
     * @param $order_id int
     * */
    public function create_order($apiacc, $headerdigest, $timestamp, $post_array, $order_id){
                
            $post_url = "https://demoopenapi.jtjms-sa.com/webopenplatformapi/api/order/addOrder?uuid=2b86805e369e4771bbdd9f7affcedd24";
            $response = wp_remote_post($post_url,array(
                    'method' => 'POST',
                    'httpversion' => '1.1',   
                    'headers' => array(
                    'apiAccount' => $apiacc,
                    'digest' => $headerdigest,
                    'timestamp' => $timestamp,
                    'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'
                    ),
                    'body' => http_build_query($post_array),
                    'timeout' => 15 * 60
                ));
            if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) != 200 ) {
                    $error_message = $response->get_error_message();
                    echo "Something went wrong: $error_message";
            }else{
                $response = json_decode(wp_remote_retrieve_body( $response ) );
                if(get_post_meta($order_id, 'txlogisticId', $single=true) == NULL && get_post_meta($order_id, 'billcode', $single=true) == NULL){
                    add_post_meta($order_id, 'txlogisticId', $response->data->txlogisticId);
                    add_post_meta($order_id, 'billcode', $response->data->billCode);
                    add_post_meta($order_id, 'createOrderTime', $response->data->createOrderTime);
                }
                // print_r($response);
            }
        }
}