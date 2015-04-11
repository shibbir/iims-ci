<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller
{
    private $_tableCategory = 'tbl_inventory_category';

    public function index()
    {
        redirect('inventory', 'refresh');
    }

    public function getCategories()
    {
    	$data['categories'] = $this->Model_Category->getCategories();
    	echo json_encode($data);
    }

    public function getCategory()
    {
    	$data = $this->Model_Category->getCategoryById($this->input->get('ID'));
    	echo json_encode($data[0]);
    }

    public function add()
    {
    	$response = array();
    	if($this->form_validation->run('add_category') !== FALSE)
    	{
    		$result = $this->Model_Category->addCategory();
    		if($result != FALSE)
    		{
    			$response['status'] = 'success';
    			$response['message'] = 'Category added successfully';
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

        if(!$this->Model_DB->isRecordExist($this->_tableCategory, array('CategoryName' => $this->input->post('CategoryName'), 'ID !=' => $id)))
        {
        	if($this->form_validation->run('edit_category') !== FALSE)
        	{
        		$result = $this->Model_Category->editCategory($id);

        		if($result != FALSE)
        		{
        			$response['status'] = 'success';
					$response['message'] = 'Category updated successfully';
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
        	$response['message'] = 'Category name must contain an unique value.';
        }
        echo json_encode($response);
    }

    public function delete()
    {
    	$response = array();
    	$id = $this->input->get('ID');

        if(!$this->Model_DB->isRecordExist($this->_tableCategory, array('ID' => $id)))
        {
        	$response['status'] = 'error';
        	$response['message'] = 'Sorry, invalid operation.';
        }
        else
        {
            if($this->Model_Category->deleteCategory($id))
            {
            	$response['status'] = 'success';
            	$response['message'] = 'Category removed successfully.';
            }
            else
            {
            	$response['status'] = 'error';
            	$response['message'] = 'This record cannot be removed.';
            }
        }
        echo json_encode($response);
    }
}

/* End of file category.php */
/* Location: ./application/controllers/category.php */