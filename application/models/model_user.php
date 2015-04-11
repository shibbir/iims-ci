<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_User extends CI_Model
{
    private $_tableUser = 'tbl_user';
    private $_tableToDo = 'tbl_todo';
    private $_tableNotification = 'tbl_notification';

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Dhaka');
    }

    public function checkLoginCredintials()
    {
    	$Username = $this->input->post('UserName');
    	$Password = $this->input->post('Password');
    	return $this->Model_DB->isRecordExist($this->_tableUser, array('UserName' => $Username, 'Password' => $Password));
    }

    public function createUserSession($user)
    {
        $userInfo = array(
            'userId'        => $user->ID,
            'auth_name'     => $user->Name,
            'username'      => $user->UserName,
            'logged_in'     => TRUE
        );
        $this->session->set_userdata($userInfo);
    }

    public function addUser()
    {
        $insert = array (
            'UserName'      => $this->input->post('UserName'),
            'Password'      => $this->input->post('Password'),
            'Name'          => $this->input->post('Name'),
            'Contact'       => $this->input->post('Contact'),
            'Address'       => $this->input->post('Address'),
            'IsActive'   	=> 1,
            'CreatedBy'     => $this->session->userdata('userId'),
            'ModifiedBy'    => $this->session->userdata('userId'),
            'CreatedDate'   => date("d F, Y"),
            'ModifiedDate'  => date("d F, Y | g:i a")
        );

        return $this->Model_DB->create($this->_tableUser, $insert);
    }

    public function getUsers()
    {
    	$columns = array(
            'a.ID', 'a.UserName', 'a.Name', 'a.Contact', 'a.Address', 'a.IsActive',
            'b.Name AS CreatorName', 'a.CreatedBy', 'a.CreatedDate', 'a.ModifiedDate'
        );

        $this->db->select($columns);
        $this->db->where(array('a.ID !=' => $this->session->userdata('userId')));
        $this->db->join('tbl_user b', 'b.ID = a.CreatedBy', 'left');

        $query = $this->db->get('tbl_user a');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return FALSE;
    }

    public function getUser()
    {
        $columns = array(
            'a.ID', 'a.UserName', 'a.Name', 'a.Contact', 'a.Address', 'a.IsActive', 'b.Name AS CreatorName',
            'b.UserName AS CreatorUserName', 'a.CreatedBy', 'a.CreatedDate', 'a.ModifiedDate'
        );

        $this->db->select($columns);
        $this->db->where(array('a.ID' => $this->input->get('ID')));
        $this->db->join('tbl_user b', 'b.ID = a.CreatedBy', 'left');

        $query = $this->db->get('tbl_user a');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return FALSE;
    }

    public function getUserByUsername()
    {
        $columns = array(
            'a.ID', 'a.UserName', 'a.Name', 'a.Contact', 'a.Address', 'a.IsActive', 'b.Name AS CreatorName',
            'b.UserName AS CreatorUserName', 'a.CreatedBy', 'a.CreatedDate', 'a.ModifiedDate'
        );

        $this->db->select($columns);
        $this->db->where(array('a.UserName' => $this->input->get('UserName')));
        $this->db->join('tbl_user b', 'b.ID = a.CreatedBy', 'left');

        $query = $this->db->get('tbl_user a');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return FALSE;
    }

    public function editUser($id)
    {
    	$data = array(
    		'UserName'      => $this->input->post('UserName'),
		    'Name'          => $this->input->post('Name'),
		    'Contact'       => $this->input->post('Contact'),
		    'Address'       => $this->input->post('Address'),
		    'ModifiedBy'    => $this->session->userdata('userId'),
            'ModifiedDate'  => date("d F, Y | g:i a")
    	);
    	return $this->Model_DB->update($this->_tableUser, $data, array('ID' => $id));
    }

    public function editUserPassword($userName)
    {
    	$data = array(
    		'Password'      => $this->input->post('NewPassword'),
    		'ModifiedBy'    => $this->session->userdata('userId'),
            'ModifiedDate'  => date("d F, Y | g:i a")
    	);
    	return $this->Model_DB->update($this->_tableUser, $data, array('UserName' => $userName));
    }

    public function deactivateUser($id)
    {
    	$data = array(
    		'IsActive'      => $this->input->post('IsActive'),
    		'ModifiedBy'    => $this->session->userdata('userId'),
            'ModifiedDate'  => date("d F, Y | g:i a")
    	);
        return $this->Model_DB->update($this->_tableUser, $data, array('ID' => $id));
    }

    public function getToDoList()
    {
        $columns = array('ID', 'Title', 'Status', 'CreatedBy', 'CreatedDate', 'ModifiedBy', 'ModifiedDate', 'FinishedBy', 'FinishedDate');
        return $this->Model_DB->read($this->_tableToDo, $columns);
    }

    public function getNotifications()
    {
        $columns = array(
            'tbl_inventory.ID', 'tbl_inventory.Title', 'tbl_inventory.Quantity', 'tbl_inventory_category.CategoryName', 'tbl_inventory.Status'
        );

        $this->db->select($columns);
        $this->db->where(array('tbl_inventory.Quantity <' => 5));
        $this->db->join('tbl_inventory_category', 'tbl_inventory.CategoryID = tbl_inventory_category.ID');

        $query = $this->db->get('tbl_inventory');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return FALSE;
    }
}

/* End of file model_user.php */
/* Location: ./application/models/model_user.php */