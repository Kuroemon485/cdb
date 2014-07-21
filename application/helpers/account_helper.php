<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('check_login'))
{
    function check_login()
    {
    	$CI = get_instance();
    	$CI->load->model('user_model');
        $login_user = $CI->input->cookie('login_user');
        $logged_in = false;
        if ($login_user) {
            $logged_in = $CI->user_model->get_user($login_user);
        } else {
            $logged_in = false;
        }
        return $logged_in;
    }
}