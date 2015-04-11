<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_Invoice extends CI_Model
{
    private $_tableInventory        = 'tbl_inventory';
    private $_tableInvoice          = 'tbl_invoice';
    private $_tableInvoiceDetails   = 'tbl_invoice_details';

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Dhaka');
    }

    public function addInvoice()
    {
    	while(1)
    	{
    		$InvoiceNumber = 'INV-' .  random_string('numeric', 5);
    		if(!$this->Model_DB->isRecordExist($this->_tableInvoice, array('InvoiceNumber' => $InvoiceNumber)))
	    	{
		    	break;
	    	}
    	}

        $InvoiceType = $this->input->post('InvoiceType');
        if($InvoiceType == 'Regular Sale')
        {
            $CustomerID = $this->input->post('CustomerID');
        }
        else
        {
            $CustomerID = 0;
        }

		$insert = array (
            'InvoiceNumber' =>	$InvoiceNumber,
            'InvoiceType'   =>  $InvoiceType,
        	'CustomerID'   	=>	$CustomerID,
        	'CreatedDate'   =>	$this->input->post('Date'),
        	'TotalCost' 	=>	$this->input->post('GrandTotal') - $this->input->post('ServiceCharge') - $this->input->post('VAT') + $this->input->post('TotalDiscount'),
        	'ServiceCharge' =>	$this->input->post('ServiceCharge'),
        	'TotalDiscount' =>	$this->input->post('TotalDiscount'),
        	'VAT' 			=>	$this->input->post('VAT'),
        	'GrandTotal' 	=>	$this->input->post('GrandTotal'),
            'CreatedBy'     =>	$this->session->userdata('userId'),
            'ModifiedBy'    =>	$this->session->userdata('userId'),
            'ModifiedDate'  =>  date("d F, Y | g:i a")
        );

        if($InvoiceType == 'Regular Sale')
        {
            $insert['CustomerNameForCashSale'] = '';
            $insert['CustomerNameForCashSale'] = '';
        }
        else
        {
            $insert['CustomerNameForCashSale']    = $this->input->post('CustomerNameForCashSale');
            $insert['CustomerMobileForCashSale']  = $this->input->post('CustomerMobileForCashSale');
        }

        $this->Model_DB->create($this->_tableInvoice, $insert);
        $InvoiceId = ($this->db->insert_id() > 0) ? $this->db->insert_id() : FALSE;

        $productList = $this->input->post('ProductID');
        $qtyList     = $this->input->post('Quantity');
        $serialList  = $this->input->post('SerialNumber');

        for($index = 0; $index < count($productList); $index++)
        {
        	$product = $this->Model_DB->getSingleRow('tbl_inventory', array('Title', 'Description', 'UnitPrice', 'Warranty', 'Quantity'), array('ID' => $productList[$index]));

	        $insert = array (
	        	'InvoiceID' 	=>  $InvoiceId,
	        	'Title' 		=>  $product->Title,
	        	'Description' 	=> 	$product->Description,
	        	'Warranty' 		=> 	$product->Warranty,
	        	'UnitPrice' 	=> 	$product->UnitPrice,
	        	'Quantity'  	=>	$qtyList[$index],
                'SerialNumber'  =>  $serialList[$index]
	        );
	        $this->Model_DB->create($this->_tableInvoiceDetails, $insert);

            /* now reduce the product quantity and set the appropriate status. */
            $updatedProductInfo = array(
                'Quantity'      =>  $product->Quantity - $qtyList[$index],
                'Status'        =>  ($product->Quantity - $qtyList[$index] > 0) ? 'Yes' : 'No',
                'ModifiedBy'    =>  $this->session->userdata('userId'),
                'ModifiedDate'  =>  date("d F, Y | g:i a")
            );
            $this->Model_DB->update($this->_tableInventory, $updatedProductInfo, array('ID' => $productList[$index]));
        }
        return $InvoiceId;
    }

    public function getInvoices()
    {
    	$columns = array(
    		'tbl_invoice.ID', 'InvoiceNumber', 'InvoiceType', 'tbl_invoice.CreatedDate', 'tbl_invoice.CustomerID', 'ServiceCharge',
            'TotalCost', 'TotalDiscount', 'VAT', 'GrandTotal', 'tbl_user.Name AS CreatorName', 'tbl_user.UserName',
            'tbl_customer.ID AS CustomerID', 'tbl_customer.CustomerName', 'tbl_invoice.CreatedBy', 'tbl_invoice.ModifiedDate'
		);

    	$this->db->select($columns);
    	$this->db->order_by('tbl_invoice.ID', 'desc');
    	$this->db->join('tbl_user', 'tbl_user.ID = tbl_invoice.CreatedBy');
    	$this->db->join('tbl_customer', 'tbl_customer.ID = tbl_invoice.CustomerID');
        $this->db->where(array('InvoiceType' => 'Regular Sale'));

    	$query = $this->db->get($this->_tableInvoice);

    	if($query->num_rows() > 0)
    	{
    		return $query->result();
    	}
    	return FALSE;
    }

    public function getInvoicesByCashSale()
    {
        $columns = array(
            'tbl_invoice.ID', 'InvoiceNumber', 'InvoiceType', 'tbl_invoice.CreatedDate', 'ServiceCharge', 'CustomerNameForCashSale',
            'CustomerMobileForCashSale', 'TotalCost', 'TotalDiscount', 'VAT', 'GrandTotal', 'tbl_user.Name AS CreatorName', 'tbl_user.UserName AS CreatorUserName',
            'tbl_invoice.CreatedBy', 'tbl_invoice.ModifiedDate'
        );

        $this->db->select($columns);
        $this->db->order_by('tbl_invoice.ID', 'desc');
        $this->db->join('tbl_user', 'tbl_user.ID = tbl_invoice.CreatedBy');
        $this->db->where(array('InvoiceType' => 'Cash Sale'));

        $query = $this->db->get($this->_tableInvoice);

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return FALSE;
    }

    public function getInvoiceDetailsByInvoiceID($invoiceId)
    {
    	$columns = array('Title', 'Description', 'UnitPrice', 'Warranty', 'Quantity', 'SerialNumber');
    	return $this->Model_DB->read($this->_tableInvoiceDetails, $columns, array('InvoiceID' => $invoiceId));
    }

    public function getInvoice($id)
    {
    	$columns = array('tbl_invoice.ID', 'InvoiceNumber', 'InvoiceType', 'CustomerID', 'CustomerNameForCashSale', 'CustomerMobileForCashSale',
            'tbl_invoice.CreatedDate', 'Name AS CreatorName', 'UserName', 'ServiceCharge', 'TotalCost', 'TotalDiscount', 'VAT', 'GrandTotal'
        );

    	$this->db->select($columns);
    	$this->db->join('tbl_user', 'tbl_user.ID = tbl_invoice.CreatedBy');
    	$this->db->where(array('tbl_invoice.ID' => $id));

    	$query = $this->db->get($this->_tableInvoice);
    	
    	if($query->num_rows() > 0)
    	{
    		return $query->result();
    	}
    	return FALSE;
    }

    public function getInvoiceByCustomerID($customerID)
    {
    	$columns = array(
            'tbl_invoice.ID', 'InvoiceNumber', 'InvoiceType', 'CustomerID', 'tbl_invoice.CreatedDate', 'tbl_user.Name AS CreatorName',
            'tbl_user.UserName AS CreatorUserName', 'ServiceCharge', 'TotalCost', 'TotalDiscount', 'VAT', 'GrandTotal', 'tbl_invoice.CreatedBy'
        );

    	$this->db->select($columns);
    	$this->db->join('tbl_user', 'tbl_user.ID = tbl_invoice.CreatedBy');
    	$this->db->where(array('tbl_invoice.CustomerID' => $customerID));

    	$query = $this->db->get($this->_tableInvoice);

    	if($query->num_rows() > 0)
    	{
    		return $query->result();
    	}
    	return FALSE;
    }

    public function getInvoiceCountByYear($dateFormat)
    {
    	$this->db->like('CreatedDate', $dateFormat);
    	$this->db->from('tbl_invoice');

    	return $this->db->count_all_results();
    }

    public function editInvoice($id)
    {
    	$data = array(
    		'Name'          => $this->input->post('Name'),
    		'Contact'       => $this->input->post('Contact'),
    		'Address'       => $this->input->post('Address'),
    		'ModifiedBy'    => $this->session->userdata('userId'),
            'ModifiedDate'  => date("d F, Y | g:i a")
    	);
    	return $this->Model_DB->update($this->_tableInvoice, $data, array('ID' => $id));
    }

    public function deleteInvoice($invoiceId)
    {
    	$this->Model_DB->delete($this->_tableInvoice, array('ID' => $invoiceId));
    	return $this->Model_DB->delete($this->_tableInvoiceDetails, array('InvoiceID' => $invoiceId));
    }
}

/* End of file model_invoice.php */
/* Location: ./application/models/model_invoice.php */