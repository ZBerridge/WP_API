<?php
/**
 * Created by PhpStorm.
 * User: zack
 * Date: 6/14/2019
 * Time: 6:15 PM
 */

if ( ! class_exists('ZB_Mail')):

    class ZB_Mail
    {
        public function contact_email($fn, $ln, $email)
        {

            $contact = get_option('contact_email');
            $subject = 'New Contact submitted.';
            $headers = array('Content-Type: text/html; charset=UTF-8');
            $message = "<div style='width: 440px;'><div style='background-color: red;color: white;width: 100%;min-height: 40px;text-transform: uppercase;text-align: center;line-height: 20px;'>New Contact submitted at zberridge.com.<br></div><div style='width: 70%; margin-left: 15%;'><div>First Name: " . $fn . "</div><br><div>Last Name: " . $ln . "</div><br><div>Email: " . $email . "</div></div></div>";

            wp_mail( $contact, $subject, $message, $headers );

        }

    }

endif;
?>
