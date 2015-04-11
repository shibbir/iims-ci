<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Organization extends CI_Controller
{
	private $_tableOrganization = 'tbl_organization';

	public function __construct()
	{
		parent:: __construct();
		$this->Model_Helper->checkSession();
		$this->template->write('title', 'IIMS -- Organization Information');
	}

    public function getOrganization()
    {
    	$data['organization'] = $this->Model_Organization->getOrganizationInfo();
    	echo json_encode($data['organization']);
    }

    public function add()
    {
    	$response = array();
    	if($this->form_validation->run('add_organization') !== FALSE)
    	{
    		$result = $this->Model_Organization->addOrganization();
    		if($result != FALSE)
    		{
    			$response['status'] = 'success';
    			$response['message'] = 'Organization added successfully';
    		}
    		else
    		{
    			$response['status'] = 'warning';
    			$response['message'] = 'Oops! Something happened. Please try again.';
    		}
    	}
    	else
    	{
    		$response['status'] = 'error';
    		$response['message'] = validation_errors();
    	}
    	echo json_encode($response);
    }

    public function edit()
    {
    	$id = $this->input->post('ID');

    	$response = array();

    	if($this->form_validation->run('edit_organization') !== FALSE)
    	{
    		$result = $this->Model_Organization->editOrganization($id);
    		if($result != FALSE)
    		{
    			$response['status'] = 'success';
    			$response['message'] = 'Organization info updated successfully';
    		}
    		else
    		{
    			$response['status'] = 'warning';
    			$response['message'] = 'Oops! Something happened. Please try again.';
    		}
    	}
    	else
    	{
    		$response['status'] = 'error';
    		$response['message'] = validation_errors();
    	}
    	echo json_encode($response);
    }
}

/* End of file organization.php */
/* Location: ./application/controllers/organization.php */