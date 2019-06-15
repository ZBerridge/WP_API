<?php
/**
 * Created by PhpStorm.
 * User: zack
 * Date: 6/14/2019
 * Time: 6:26 PM
 */

if ( ! class_exists('ZB_Contact')):

    class ZB_Contact
    {

        private $fname = '';

        private $lname = '';

        private $email = '';

        private $ok_contact = '';

        private $body = '';

        /**
         * @return string
         */
        public function getBody()
        {
            return $this->body;
        }

        /**
         * @param string $body
         */
        public function setBody($body)
        {
            $this->body = $body;
        }

        /**
         * @return string
         */
        public function getFname()
        {
            return $this->fname;
        }

        /**
         * @param string $fname
         */
        public function setFname($fname)
        {
            $this->fname = $fname;
        }

        /**
         * @return string
         */
        public function getLname()
        {
            return $this->lname;
        }

        /**
         * @param string $lname
         */
        public function setLname($lname)
        {
            $this->lname = $lname;
        }

        /**
         * @return string
         */
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * @param string $email
         */
        public function setEmail($email)
        {
            $this->email = $email;
        }

        /**
         * @return string
         */
        public function getOkContact()
        {
            return $this->ok_contact;
        }

        /**
         * @param string $ok_contact
         */
        public function setOkContact($ok_contact)
        {
            $this->ok_contact = $ok_contact;
        }

        public function __construct( $fname, $lname, $email, $ok_contact, $body )
        {

            $this->fname = $fname;
            $this->lname = $lname;
            $this->email = $email;
            $this->ok_contact = $ok_contact;
            $this->body = $body;

        }

    }

endif;
