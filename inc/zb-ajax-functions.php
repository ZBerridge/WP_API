<?php
/*
*
*  Collection of various AJAX 'receivers'
*  Author: Zack Berridge
*  Date: 6/14/2019
*
*/

if ( ! class_exists('ZB_Ajax_Functions')):
    class ZB_Ajax_Functions{

        public static function zb_request_appointment(){

        }

        /**
         *
         */
        public static function zb_leave_contact_info(){

            if ( defined('DOING_AJAX') && DOING_AJAX ) {
                $fname = $_POST['fn'];
                $lname = $_POST['ln'];
                $email = $_POST['ea'];
                $body = $_POST['body'];
                $ok_contact = $_POST['contact'];

                if ( !empty($fname) && !empty($lname) &&  !empty($email) ) :

                    $contact = new ZB_Contact( $fname, $lname, $email, $ok_contact, $body );
                    $contact_handler = new ZB_Contact_Handler($contact);
                    if($contact_handler->Check() == 0) :
                        $contact_handler->Insert();
                    endif;
                    $contact_response = $contact_handler->getErrors();

                    $mailer = new ZB_Mail();
                    $mailer->contact_email($fname, $lname, $email);

                endif;

                if (isset($contact_response)):
                    if (count($contact_response->getErrorList()) < 1) :
                        echo 'Success';
                    else :
                        echo end($contact_response->getErrorList());
                    endif;
                endif;
                wp_die();
            }
        }
    }
endif;

add_action ( 'wp_ajax_zb_leave_contact_info', array( 'ZB_Ajax_Functions', 'zb_leave_contact_info' ));

?>
