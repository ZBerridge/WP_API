<?php
/*
*
*  Registers and Enqueues Scripts and CSS
*
*/


if ( ! class_exists('ZB_Scripts')):

    class ZB_Scripts {

        public function __construct()
        {
            $this->zb_register_scripts();
            $this->zb_enqueue_scripts();
        }

        private function zb_register_scripts(){
            // TODO: register AJAX endpoint for forms, etc...
        }

        private function zb_enqueue_scripts()
        {
            // TODO: Enqueue Internal AJAX endpoint for forms, etc...

        }

    }

endif;

function create_ZB_Scripts_obj()
{
    $zb_script_register = new ZB_Scripts();
}

//add_action( 'wp_enqueue_scripts', 'create_ZB_Scripts_obj' );

?>
