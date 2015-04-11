<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Invoice extends CI_Controller
{
	private $_tableInvoice = 'tbl_Invoice';

    public function __construct()
    {
        parent:: __construct();

        $this->load->helper('date');
        $this->Model_Helper->checkSession();
        $this->template->write('title', 'IIMS -- Invoice Management');
    }

    public function index()
    {
        $this->template->write_view('content', 'invoice/index');
        $this->template->render();
    }

    public function add()
    {
    	$response = array();
    	if($this->form_validation->run('add_invoice') !== FALSE)
    	{
    		$result = $this->Model_Invoice->addInvoice();
    		if($result != FALSE)
    		{
                $response['newlyCreatedInvoiceId'] = $result;
    			$response['status'] = 'success';
    			$response['message'] = 'Invoice added successfully';
    		}
    		else
    		{
    			$response['status'] = 'warning';
    			$response['message'] = 'Oops! Something happened. Please try again.';
    		}
    	}
    	else {
    		$response['status'] = 'error';
    		$response['message'] = validation_errors();
    	}
    	echo json_encode($response);
    }

    public function details()
    {
        $InvoiceId = $this->uri->segment(3);
        if(!is_numeric($InvoiceId) || $InvoiceId <= 0) redirect('invoice', 'refresh');

        $data['invoice'] = $this->Model_Invoice->getInvoice($InvoiceId);

        foreach ($data['invoice'] as $row)
        {
            $customerId = $row->CustomerID;
            if($customerId == 0)
            {
                $data['CustomerNameForCashSale'] = $row->CustomerNameForCashSale;
                $data['CustomerMobileForCashSale'] = $row->CustomerMobileForCashSale;
            }
            else
            {
                $data['customer'] = $this->Model_Customer->getCustomerById($customerId);
            }
            break;
        }
        $data['invoice_details'] = $this->Model_Invoice->getInvoiceDetailsByInvoiceID($InvoiceId);

        $this->template->write_view('content', 'invoice/details', $data);
        $this->template->render();
    }

    public function getInvoices()
    {
    	$data['invoices'] = $this->Model_Invoice->getInvoices();
    	echo json_encode($data['invoices']);
    }

    public function getInvoiceByCustomerID()
    {
        $data['invoice'] = $this->Model_Invoice->getInvoiceByCustomerID($this->input->get('CustomerID'));
        echo json_encode($data);
    }

    public function getInvoicesByCashSale()
    {
        $data['invoices_by_cash'] = $this->Model_Invoice->getInvoicesByCashSale();
        echo json_encode($data['invoices_by_cash']);
    }

    public function getInvoice()
    {
    	$data = $this->Model_Invoice->getInvoice($this->input->get('ID'));
    	echo json_encode($data);
    }

	public function getInvoiceCountByYear()
	{
        $year = $this->input->get('Year');
		$data['january'] 	= $this->Model_Invoice->getInvoiceCountByYear('January' . $year);
		$data['february'] 	= $this->Model_Invoice->getInvoiceCountByYear('February, ' . $year);
		$data['march'] 		= $this->Model_Invoice->getInvoiceCountByYear('March, ' . $year);
		$data['april'] 		= $this->Model_Invoice->getInvoiceCountByYear('April, ' . $year);
		$data['may'] 		= $this->Model_Invoice->getInvoiceCountByYear('May, ' . $year);
		$data['june'] 		= $this->Model_Invoice->getInvoiceCountByYear('June, ' . $year);
		$data['july'] 		= $this->Model_Invoice->getInvoiceCountByYear('July, ' . $year);
		$data['august'] 	= $this->Model_Invoice->getInvoiceCountByYear('August, ' . $year);
		$data['september'] 	= $this->Model_Invoice->getInvoiceCountByYear('September, ' . $year);
		$data['october'] 	= $this->Model_Invoice->getInvoiceCountByYear('October, ' . $year);
		$data['november'] 	= $this->Model_Invoice->getInvoiceCountByYear('November, ' . $year);
		$data['december'] 	= $this->Model_Invoice->getInvoiceCountByYear('December, ' . $year);
		echo json_encode($data);
	}

	public function delete()
	{
		$invoiceId = $this->input->post('ID');

		if($this->Model_Invoice->deleteInvoice($invoiceId))
		{
			$response['status'] = 'success';
			$response['message'] = 'Invoice successfully removed.';
		}
		else
		{
			$response['status'] = 'error';
			$response['message'] = 'This record cannot be removed.';
		}
		echo json_encode($response);
	}
}

/* End of file invoice.php */
/* Location: ./application/controllers/invoice.php */