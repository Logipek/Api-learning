<?php
    namespace App\Controllers;

    class User extends Controller{
        public function __construct($params) {
            parent::__construct($params);
        }

        public function postUser() {
            return json_decode(file_get_contents('php://input'), true);
        }

        public function getUser() {
            return [
                'id' => 1,
                'first' => 'cyril',
                'last' => 'vimard',
                'age' => 34
            ];
        }
    }