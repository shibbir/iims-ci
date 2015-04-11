<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();

        $this->Model_Helper->checkSession();
        $this->template->write('title', 'IIMS -- Welcome to dashboard');
    }

    public function index()
    {
        $this->template->write_view('content', 'dashboard/index');
        $this->template->render();
    }

    public function getInventoryChart()
    {
    	$data = $this->Model_Inventory->getInventoryChart();
        if($data)
        {
        	$plotData = array();
        	foreach ($data as $item)
        	{
        		if(!$item->Quantity)
        		{
        			$plotData[$item->CategoryName] = 0;
        		}
        		else $plotData[$item->CategoryName] = intval($item->Quantity);
        	}
            echo json_encode($plotData);
        }
        else echo json_encode($data);
    }
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */