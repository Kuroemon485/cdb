<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('is_logged_in')) {
    function is_logged_in() {
    	$CI = get_instance();
    	$CI->load->model('user_model');
        $cookie_user = $CI->input->cookie('login_user');
        $logged_in = false;
        if ($cookie_user) {
            $logged_in = $CI->user_model->check_logged_user($cookie_user);
        } else {
            $logged_in = false;
        }
        return $logged_in;
    }
}
if ( ! function_exists('current_user')) {
    function current_user() {
    	if (is_logged_in()) {
    		$CI = get_instance();
    		$CI->load->model('user_model');
    	    $cookie_user = $CI->input->cookie('login_user');
    	    $current_user = $CI->user_model->get_user($cookie_user);
    	} else {
    		$current_user = false;
    	}
    	return $current_user;
    }
}