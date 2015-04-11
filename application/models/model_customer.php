<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_Customer extends CI_Model
{
    private $_tableCustomer = 'tbl_customer';
    private $_tableInvoice = 'tbl_invoice';

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Dhaka');
    }

    public function addCustomer()
    {
        $insert = array (
            'CustomerName'  => $this->input->post('CustomerName'),
            'Contact'       => $this->input->post('Contact'),
            'Address'       => $this->input->post('Address'),
            'CreatedDate'   => date("d F, Y"),
            'CreatedBy'     => $this->session->userdata('userId'),
            'ModifiedBy'    => $this->session->userdata('userId'),
            'ModifiedDate'  => date("d F, Y | g:i a")
        );
        return $this->Model_DB->create($this->_tableCustomer, $insert);
    }

    public function getCustomers()
    {
        $columns = array(
            'tbl_customer.ID', 'CustomerName', 'tbl_customer.Contact', 'tbl_customer.Address', 'tbl_customer.CreatedBy', 'tbl_customer.CreatedDate',
            'tbl_customer.ModifiedBy', 'tbl_customer.ModifiedDate', 'tbl_user.Name AS CreatorName', 'modifier.Name AS ModifierName',
            'tbl_user.UserName AS CreatorUserName', 'modifier.UserName AS ModifierUserName'
        );

        $this->db->select($columns);
        $this->db->join('tbl_user', 'tbl_user.ID = tbl_customer.CreatedBy');
        $this->db->join('tbl_user modifier', 'modifier.ID = tbl_customer.ModifiedBy');

        $query = $this->db->get($this->_tableCustomer);

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return FALSE;
    }

    public function getCustomerById($customerId)
    {
    	return $this->Model_DB->read($this->_tableCustomer, array('ID', 'CustomerName', 'Contact', 'Address', 'CreatedDate'), array('ID' => $customerId));
    }

    public function getCustomerByContact()
    {
        $where = array();
        if(isset($_GET['ID'])) $where['ID'] = $this->input->get('ID');
        if(isset($_GET['Contact'])) $where['Contact'] = $this->input->get('Contact');
        return $this->Model_DB->read($this->_tableCustomer, array('ID', 'CustomerName', 'Contact', 'Address', 'CreatedDate'), $where);
    }

    public function editCustomer($id)
    {
    	$data = array(
    		'CustomerName'  => $this->input->post('CustomerName'),
    		'Contact'       => $this->input->post('Contact'),
    		'Address'       => $this->input->post('Address'),
    		'ModifiedBy'    => $this->session->userdata('userId'),
            'ModifiedDate'  => date("d F, Y | g:i a")
    	);
    	return $this->Model_DB->update($this->_tableCustomer, $data, array('ID' => $id));
    }

    public function hasDependency($customerId)
    {
    	if($this->Model_DB->isRecordExist($this->_tableInvoice, array('CustomerID' => $customerId))) return TRUE;
    	return FALSE;
    }

    public function deleteCustomer($customerId)
    {
    	if($this->hasDependency($customerId))
    	{
            return FALSE;
        }
        return $this->Model_DB->delete($this->_tableCustomer, array('ID' => $customerId));
    }
}

/* End of file model_customer.php */
/* Location: ./application/models/model_customer.php */