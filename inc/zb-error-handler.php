<?php
/**
 * Created by PhpStorm.
 * User: zack
 * Date: 6/14/2019
 * Time: 6:24 PM
 */

if (!class_exists('ZB_Error_Handler')):

    class ZB_Error_Handler
    {

        private $error_list = [];

        /**
         * @return array
         */
        public function getErrorList()
        {
            return $this->error_list;
        }

        public function addError($error_code, $error_value){

            $this->error_list[$error_code] = $error_value;

        }

    }

endif;
