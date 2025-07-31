<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Set_views {
    public static function home() {

        return 'pages/home';
    }
    public static function login() {
        return 'auth/login';
    }

    public static function signup() {
        return 'auth/signup';
    }

    public static function forgot_password() {
        return 'auth/forgot_password';
    }

    public static function task() {
        return 'pages/task';
    }

    public static function progress() {
        return 'pages/progress';
    }

}
?>