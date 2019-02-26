<?php
/**
 * Created by PhpStorm.
 * User: zack
 * Date: 1/20/2019
 * Time: 1:18 PM
 */

if ( ! class_exists('ZB_Cors')):

    class ZB_Cors {

        public function __construct()
        {
            $this->zb_init_cors();
        }

        private function zb_init_cors(){
            header("Access-Control-Allow-Origin: *");
        }

    }

endif;

function init_cors_header(){
    $zb_cors = new ZB_Cors();
}
add_action('init','init_cors_header');

?>
