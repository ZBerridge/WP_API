<?php
/**
 * Created by PhpStorm.
 * User: zack
 * Date: 6/14/2019
 * Time: 6:20 PM
 */

if ( ! class_exists('ZB_Tables') ):

    class ZB_Tables
    {
        /**
         * ZB_Tables constructor.
         */
        public function __construct(  )
        {

            $this->zb_create_contact_table();

        }

        public function zb_create_contact_table()
        {
            global $wpdb;

            $table_name = $wpdb->prefix . 'zb_contacts';

            //$charset_collate = $wpdb->get_charset_collate();

            if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

                $sql = "CREATE TABLE " . $table_name . "( "
                    . "id mediumint(9) NOT NULL AUTO_INCREMENT, "
                    . "first_name VARCHAR(50) NOT NULL, "
                    . "last_name VARCHAR(50) NOT NULL, "
                    . "email varchar(50) NOT NULL, "
                    . "date_added datetime NOT NULL, "
                    . "date_removed  datetime NULL, "
                    . "ok_to_contact bit NOT NULL, "
                    . "body varchar(4000) NULL, "
                    . "contact_status bit NOT NULL, "
                    . "PRIMARY KEY (id) )";

                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

                dbDelta($sql);

                add_option('bdetector_database_version', '1.0');

            }
        }
    }

endif;

function zb_create_tables()
{
    $zb_tables = new ZB_Tables();
}

add_action('init', 'zb_create_tables');
