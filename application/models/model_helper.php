<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_Helper extends CI_Model
{
	public function encodeToSeoFriendly($str)
	{
		$str = str_replace(' ', '-', $str);
		return strtolower($str);
	}

	public function unLinkFile($FileName)
	{
		while(is_file($FileName) == TRUE)
		{
			chmod($FileName, 0666);
			unlink($FileName);
		}
		if(file_exists($FileName)) return FALSE;
		return TRUE;
	}

	public function upload($field)
	{
		$config['upload_path'] = IMG_INVENTORY_PHYSICAL_PATH;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '3200';
		$config ['remove_spaces'] = TRUE;
		$config['overwrite'] = TRUE;

		$this->upload->initialize($config);

		if (!$this->upload->do_upload($field))
		{
			return FALSE;
		}
		else
		{
			$img_data = $this->upload->data();
			if($img_data['file_name']) return $img_data['file_name'];
			return FALSE;
		}
	}

	public function checkSession()
	{
		if(!$this->session->userdata('logged_in'))
		{
			$this->session->set_flashdata('info_msg', 'You have to log in first.');
			redirect('welcome', 'refresh');
		}
	}
}

/* End of file model_helper.php */
/* Location: ./application/models/model_helper.php */