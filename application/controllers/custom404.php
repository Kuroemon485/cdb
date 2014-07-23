<?php 
class Custom404 extends CI_Controller {
    private $option;
    public function __construct() 
    {
        parent::__construct();
        $this->output->set_status_header('404');
        $this->option['is_logged_in'] = is_logged_in();
        if (is_logged_in()) {
            $this->option['current_user'] = current_user();
        }
    }

    public function index() 
    { 
        $this->option['content'] = 'error_404';
        $this->option['title'] = '404';
        $this->option['selected'] = '';
        $this->option['sub_seleted'] = '';
        $this->load->view('header',$this->option);
        $this->load->view('404');
        $this->load->view('footer');
    } 
}



// End of file