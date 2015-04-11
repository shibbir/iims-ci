<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inventory extends CI_Controller
{
    private $_tableInventory = 'tbl_inventory';
    private $_tableCategory = 'tbl_inventory_category';

    public function __construct()
    {
        parent:: __construct();
        $this->Model_Helper->checkSession();
        $this->template->write('title', 'IIMS -- Manage Inventory');
    }

	public function index()
    {
        $this->template->write_view('content', 'inventory/index');
        $this->template->render();
    }

    public function add()
    {
        $response = array();
        if($this->form_validation->run('add_inventory') !== FALSE)
        {
        	$result = $this->Model_Inventory->addInventory();
        	if($result != FALSE)
        	{
                $response['newlyCreatedProductId'] = $this->db->insert_id();
        		$response['status'] = 'success';
        		$response['message'] = 'Product added successfully';
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

    public function getInventory()
    {
        $categoryId = $this->input->get('CategoryID');
    	$data['inventory'] = $this->Model_Inventory->getInventory($categoryId);
    	echo json_encode($data['inventory']);
    }

    public function getInventoryById()
    {
        $id = $this->input->get('ID');
        $data['categories'] = $this->Model_Category->getCategories();
        $data['inventory'] = $this->Model_Inventory->getInventoryById($id);
        echo json_encode($data);
    }

    public function edit()
    {
    	$id = $this->input->post('ID');

    	$response = array();

    	if(!$this->Model_DB->isRecordExist($this->_tableInventory, array('Title' => $this->input->post('Title'), 'ID !=' => $id)))
    	{
    		if($this->form_validation->run('edit_inventory') !== FALSE)
    		{
    			$result = $this->Model_Inventory->editInventory($id);

    			if($result != FALSE)
    			{
    				$response['status'] = 'success';
    				$response['message'] = 'Product updated successfully';
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
    		$response['message'] = 'Product name must contain an unique value.';
    	}
    	echo json_encode($response);
    }

	public function delete()
	{
		$inventoryId = $this->input->post('ID');

		if($this->Model_Inventory->deleteInventory($inventoryId))
		{
			$response['status'] = 'success';
			$response['message'] = 'Product successfully removed.';
		}
		else
		{
			$response['status'] = 'error';
			$response['message'] = 'This product cannot be removed.';
		}
		echo json_encode($response);
	}
}

/* End of file inventory.php */
/* Location: ./application/controllers/inventory.php */