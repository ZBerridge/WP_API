<?php
/**
 * Created by PhpStorm.
 * User: zack
 * Date: 6/14/2019
 * Time: 6:19 PM
 */


if ( ! class_exists('ZB_Contact_Handler')):

    class ZB_Contact_Handler implements IContactLogger
    {

        /**
         * @var ZB_Error_Handler
         */
        private $errors;

        /**
         * @var ZB_Contact
         */
        private $contact;

        /**
         * @return mixed
         */
        public function getContact()
        {
            return $this->contact;
        }

        /**
         * @return ZB_Error_Handler
         */
        public function getErrors()
        {
            return $this->errors;
        }

        /**
         * ZB_Contact_Handler constructor.
         * @param ZB_Contact $contact
         */
        public function __construct(ZB_Contact $contact )
        {

            $this->contact = $contact;
            $this->errors = new ZB_Error_Handler();

        }

        /**
         * Updates contact in ytb_contacts, based on email
         */
        public function Update()
        {

            ZB_Contact_Functions::updateContact($this->contact);
        }

        /**
         * Inserts contacts into ytb_contact
         */
        public function Insert()
        {

            ZB_Contact_Functions::insertContact($this->contact);
        }

        /**
         * Deletes Contact from Database
         */
        public function Delete()
        {

            ZB_Contact_Functions::deleteContact($this->contact);

        }

        /**
         * @return mixed.
         */
        public function Check()
        {

            $contact_exists = ZB_Contact_Functions::checkForExisting($this->contact);
            if ( $contact_exists > 0 ) :
                // exists
                $this->errors->addError( 'Contact Exists', 'Contact already exists in the database.');
            endif;

            return $contact_exists;

        }

    }

endif;
