<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_Organization extends CI_Model
{
    private $_tableOrganization = 'tbl_organization';

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Dhaka');
    }

    public function addOrganization()
    {
        $insert = array (
            'Title'  		=> $this->input->post('Title'),
        	'SubTitle' 		=> $this->input->post('SubTitle'),
        	'Description'   => $this->input->post('Description'),
            'Address'    	=> $this->input->post('Address'),
        	'Mobile'		=> $this->input->post('Mobile'),
        	'Phone'			=> $this->input->post('Phone'),
        	'Email'  		=> $this->input->post('Email'),
        	'Website'    	=> $this->input->post('Website'),
            'CreatedBy'     => $this->session->userdata('userId'),
            'ModifiedBy'    => $this->session->userdata('userId'),
            'ModifiedDate'  => date("d F, Y | g:i a")
        );
        return $this->Model_DB->create($this->_tableOrganization, $insert);
    }

    public function editOrganization($id)
    {
    	$data = array(
    		'Title'  		=> $this->input->post('Title'),
    		'SubTitle' 		=> $this->input->post('SubTitle'),
        	'Description'   => $this->input->post('Description'),
            'Address'    	=> $this->input->post('Address'),
        	'Mobile'		=> $this->input->post('Mobile'),
        	'Phone'			=> $this->input->post('Phone'),
        	'Email'  		=> $this->input->post('Email'),
        	'Website'    	=> $this->input->post('Website'),
            'ModifiedBy'    => $this->session->userdata('userId'),
            'ModifiedDate'  => date("d F, Y | g:i a")
    	);
    	return $this->Model_DB->update($this->_tableOrganization, $data, array('ID' => $id));
    }

    public function getOrganizationInfo()
    {
    	$column = array(
    		'ID', 'Title', 'SubTitle', 'Description', 'Address', 'Mobile',
    		'Phone', 'Email', 'Website', 'CreatedBy', 'ModifiedBy', 'ModifiedDate'
    	);
    	return $this->Model_DB->getSingleRow($this->_tableOrganization, $column);
    }
}

/* End of file model_organization.php */
/* Location: ./application/models/model_organization.php */