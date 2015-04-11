<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();
        $this->template->set_master_template('layouts/layout-welcome');
    }

    public function index()
    {
        if($this->session->userdata('logged_in'))
        {
            redirect('dashboard', 'refresh');
        }
        $this->template->render();
    }

    public function checkLoginCredintials()
    {
    	$response = array();
    	if($this->form_validation->run('login') !== FALSE)
    	{
    		$result = $this->Model_User->checkLoginCredintials();
    		if($result != FALSE)
    		{
    			$response['status'] = 'success';
    			$this->doLogin($result);
    		}
    		else
    		{
    			$response['status'] = 'error';
    			$response['message'] = 'Oops! Invalid username or password.';
    		}
    	}
    	else
    	{
    		$response['status'] = 'error';
    		$response['message'] = validation_errors();
    	}
    	echo json_encode($response);
    }

    public function doLogin($user)
    {
    	$this->Model_User->createUserSession($user);
    }

    public function logout()
    {
    	$this->session->sess_destroy();
        $this->session->set_flashdata('success_msg', 'You have been successfully logged out!');
        redirect('welcome', 'refresh');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */