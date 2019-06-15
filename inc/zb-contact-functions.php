<?php
/**
 * Created by PhpStorm.
 * User: zack
 * Date: 6/14/2019
 * Time: 6:31 PM
 */

if ( ! class_exists('ZB_Contact_Functions')):

    class ZB_Contact_Functions
    {

        public static function updateContact(ZB_Contact $contact){

            $contact_id = self::checkForExisting($contact);

            $ok_to_contact = 0;

            if ($contact->getOkContact()) :
                $ok_to_contact = 1;
            endif;

            global $wpdb;

            $table_name = $wpdb->prefix . 'zb_contacts';

            $update_contact = $wpdb->query( $wpdb->prepare(
                "UPDATE `$table_name` SET "
                . "`first_name`= '" .$contact->getFname() ."', `last_name` = '". $contact->getLname() ."', `email` = '". $contact->getEmail()."', `ok_to_contact` = $ok_to_contact "
                . "WHERE `id` = $contact_id"
            )
            );

        }


        public function insertContact(ZB_Contact $contact)
        {

            $ok_to_contact = 0;

            if ($contact->getOkContact() == 'true') :
                $ok_to_contact = 1;
            endif;

            if(self::checkForExisting($contact))

            global $wpdb;

            $insert_contact = $wpdb->query( $wpdb->prepare(
                "INSERT INTO " .$wpdb->prefix . 'zb_contacts' . " "
                . "(`first_name`, `last_name`, `email`, `date_added`, `date_removed`, `ok_to_contact`, `contact_status`) "
                . "VALUES "
                . "( '" .$contact->getFname() ."', '". $contact->getLname() ."', '". $contact->getEmail()."', CURDATE(), NULL, $ok_to_contact, 1 )"
            )
            );

        }

        public function checkForExisting(ZB_Contact $contact)
        {

            global $wpdb;

            $contact_exists = $wpdb->get_var(
                $wpdb->prepare(
                    "SELECT ID FROM " . $wpdb->prefix . "zb_contacts "
                    . "WHERE email = %s  LIMIT 1",
                    $contact->getEmail()
                )
            );

            return $contact_exists;

        }

        public function deleteContact(ZB_Contact $contact)
        {

            global $wpdb;

            $contact_delete = $wpdb->query(
                $wpdb->prepare(
                    "DELETE FROM " . $wpdb->prefix . "zb_contacts "
                    . "WHERE email = %s  LIMIT 1",
                    $contact->getEmail()
                )
            );


        }

    }

endif;
