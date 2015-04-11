<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Printer extends CI_Controller
{
	public function __construct()
	{
		parent:: __construct();
		$this->Model_Helper->checkSession();
	}

	public function index($InvoiceId)
	{
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
		$data['organization'] = $this->Model_Organization->getOrganizationInfo();
		if(!$data['organization'])
		{
			$data['organization'] = (object) array(
				'Title'       => 'Organization Title',
				'SubTitle'    => 'Organization SubTitle',
				'Description' => 'Organization Description',
				'Address'     => 'Organization Address',
				'Mobile'      => 'Organization Mobile',
				'Phone'       => 'Organization Phone',
				'Email'       => 'Organization Email',
				'Website'     => 'Organization Website'
			);
		}
		$data['invoice_details'] = $this->Model_Invoice->getInvoiceDetailsByInvoiceID($InvoiceId);

		$this->load->view('layouts/layout-printer', $data);
	}
}

/* End of file printer.php */
/* Location: ./application/controllers/printer.php */