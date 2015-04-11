<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
    private $_tableUser = 'tbl_user';

    public function __construct()
    {
        parent:: __construct();
        $this->Model_Helper->checkSession();
        $this->template->write('title', 'IIMS -- Manage System Users');
    }

    public function index()
    {
        $this->template->write_view('content', 'user/index');
        $this->template->render();
    }

    public function getUsers()
    {
    	$data['users'] = $this->Model_User->getUsers();
    	echo json_encode($data['users']);
    }

    public function getUser()
    {
    	$data['user'] = $this->Model_User->getUser();
    	echo json_encode($data);
    }

    public function getUserByUsername()
    {
        $data['user'] = $this->Model_User->getUserByUsername();
        echo json_encode($data);
    }

    public function profile()
    {
        if(!$this->uri->segment(3)) redirect('user', 'refresh');
    	$this->template->write_view('content', 'user/profile');
        $this->template->render();
    }

    public function notification()
    {
        $data['notifications'] = $this->Model_User->getNotifications();
        $this->template->write_view('content', 'user/notification', $data);
    	$this->template->render();
    }

    public function getToDoList()
    {
        $data['todo'] = $this->Model_User->getToDoList();
        echo json_encode($data);
    }

    public function add()
    {
    	$response = array();
    	if($this->form_validation->run('add_user') !== FALSE)
    	{
    		$result = $this->Model_User->addUser();
    		if($result != FALSE)
    		{
    			$response['status'] = 'success';
    			$response['message'] = 'User registered successfully';
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

    	if(!$this->Model_DB->isRecordExist($this->_tableUser, array('UserName' => $this->input->post('UserName'), 'ID !=' => $id)))
    	{
	    	if($this->form_validation->run('edit_user') !== FALSE)
	    	{
	    		$result = $this->Model_User->editUser($id);

	    		if($result != FALSE)
	    		{
	    			$response['status'] = 'success';
	    			$response['message'] = 'User updated successfully';
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
    		$response['message'] = 'Username must contain an unique value.';
    	}
    	echo json_encode($response);
    }

    public function changePassword()
    {
    	$response = array();

    	if($this->form_validation->run('edit_user_password') !== FALSE)
    	{
    		if($this->Model_DB->isRecordExist($this->_tableUser, array('Password' => $this->input->post('CurrentPassword'), 'UserName' => $this->input->post('UserName'))))
    		{
    			$result = $this->Model_User->editUserPassword($this->input->post('UserName'));

    			if($result != FALSE)
    			{
    				$response['status'] = 'success';
    				$response['message'] = 'Password updated successfully';
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
    			$response['message'] = 'Incorrect current password.';
    		}
    	}
    	else
    	{
    		$response['status'] = 'error';
    		$response['message'] = validation_errors();
    	}
    	echo json_encode($response);
    }

    public function deactivate()
    {
    	$id = $this->input->post('ID');

    	$response = array();

        if(!$this->Model_DB->verifyRecord($this->_tableUser, array('ID' => $id)) || $this->Model_User->isSuperAdmin($id))
        {
            $this->session->set_flashdata('error_msg', 'Sorry, invalid operation.');
        }
        else
        {
            if($this->Model_User->deactivateUser($id))
            {
            	$response['status'] = 'success';
            	$response['message'] = 'User successfully deactivated.';
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

/* End of file user.php */
/* Location: ./application/controllers/user.php */