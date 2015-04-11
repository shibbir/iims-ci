<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_Category extends CI_Model
{
	private $_tableInventory = 'tbl_inventory';
	private $_tableCategory = 'tbl_inventory_category';

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Dhaka');
    }

	public function addCategory()
	{
		$insert = array (
			'CategoryName'	=> $this->input->post('CategoryName'),
			'Description'	=> $this->input->post('Description'),
			'CategoryKey'   => $this->Model_Helper->encodeToSeoFriendly($this->input->post('CategoryName')),
			'CreatedBy'     => $this->session->userdata('userId'),
			'ModifiedBy'    => $this->session->userdata('userId'),
			'CreatedDate'   => date("d F, Y"),
			'ModifiedDate'  => date("d F, Y | g:i a")
		);
		return $this->Model_DB->create($this->_tableCategory, $insert);
	}

	public function getCategories()
	{
		$this->db->select(array('tbl_inventory_category.ID', 'CategoryName', 'tbl_inventory_category.Description', 'CategoryKey', 'tbl_inventory_category.CreatedBy'));

		$this->db->select_sum('tbl_inventory.Quantity', 'Quantity');
		$this->db->join($this->_tableCategory, 'tbl_inventory.CategoryID = tbl_inventory_category.ID', 'RIGHT');

		$this->db->group_by($this->_tableCategory.'.ID');

		$query = $this->db->get($this->_tableInventory);

		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
	}

	public function getCategoryById($id)
	{
		return $this->Model_DB->read($this->_tableCategory, array('ID', 'CategoryName', 'Description', 'CreatedBy'), array('ID' => $id));
	}

	public function getCategoryIdByKey($key)
	{
		$id = $this->Model_DB->getSingleRow($this->_tableCategory, array('ID'), array('CategoryKey' => $key));
		return $id->ID;
	}

	public function editCategory($id)
	{
		$data = array(
			'CategoryName'      => $this->input->post('CategoryName'),
			'CategoryKey'      	=> $this->Model_Helper->encodeToSeoFriendly($this->input->post('CategoryName')),
			'Description'      	=> $this->input->post('Description'),
			'ModifiedBy'    	=> $this->session->userdata('userId'),
			'ModifiedDate'  	=> date("d F, Y | g:i a")
		);
		return $this->Model_DB->update($this->_tableCategory, $data, array('ID' => $id));
	}

	public function deleteCategory($id)
	{
		$data = array(
			'CategoryID'      	=> 1,
			'ModifiedBy'    	=> $this->session->userdata('userId')
		);
		if($this->Model_DB->update($this->_tableInventory, $data, array('CategoryID' => $id)))
		{
			return $this->Model_DB->delete($this->_tableCategory, array('ID' => $id));
		}
		return FALSE;
	}
}

/* End of file model_category.php */
/* Location: ./application/models/model_category.php */