<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller
{
	private $_tableCustomer = 'tbl_customer';

    public function __construct()
    {
        parent:: __construct();

        $this->Model_Helper->checkSession();
        $this->template->write('title', 'IIMS -- Customer Management');
    }

    public function index()
    {
        $this->template->write_view('content', 'customer/index');
        $this->template->render();
    }

    public function getCustomers()
    {
    	$data['customers'] = $this->Model_Customer->getCustomers();
    	echo json_encode($data['customers']);
    }

    public function getCustomer()
    {
    	$data['customer'] = $this->Model_Customer->getCustomerById($this->input->get('ID'));
    	echo json_encode($data);
    }

    public function getCustomerByContact()
    {
        $data['customer'] = $this->Model_Customer->getCustomerByContact();
        echo json_encode($data);
    }

    public function profile()
    {
        $CustomerId = $this->uri->segment(3);
        if(!is_numeric($CustomerId) || $CustomerId <= 0) redirect('customer', 'refresh');

        $data['customerId'] = $CustomerId;
        $this->template->write_view('content', 'customer/profile', $data);
        $this->template->render();
    }

    public function add()
    {
    	$response = array();
	    if($this->form_validation->run('add_customer') !== FALSE)
	    {
	    	$result = $this->Model_Customer->addCustomer();
	   		if($result != FALSE)
	   		{
	   			$response['newlyCreatedCustomerId'] = $this->db->insert_id();
	 			$response['status'] = 'success';
	 			$response['message'] = 'Customer added successfully';
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

    	if(!$this->Model_DB->isRecordExist($this->_tableCustomer, array('Contact' => $this->input->post('Contact'), 'ID !=' => $id)))
    	{
	    	if($this->form_validation->run('edit_customer') !== FALSE)
	    	{
	    		$result = $this->Model_Customer->editCustomer($id);

	    		if($result != FALSE)
	    		{
                    $response['newlyEditedCustomerId'] = $id;
	    			$response['status'] = 'success';
	    			$response['message'] = 'Customer updated successfully';
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
    	}
    	else
    	{
    		$response['status'] = 'error';
    		$response['message'] = 'There is already a customer with the same contact.';
    	}
    	echo json_encode($response);
    }

    public function delete()
    {
    	$id = $this->input->post('ID');

    	if($this->Model_Customer->deleteCustomer($id))
    	{
    		$response['status'] = 'success';
    		$response['message'] = 'Customer successfully removed.';
    	}
    	else
    	{
    		$response['status'] = 'error';
    		$response['message'] = 'Sorry. Access Denied.';
    	}
    	echo json_encode($response);
    }
}

/* End of file customer.php */
/* Location: ./application/controllers/customer.php */