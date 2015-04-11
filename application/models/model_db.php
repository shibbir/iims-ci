<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_DB extends CI_Model
{
    public function create($table, $insert)
    {
        return $this->db->insert($table, $insert);
    }

    public function read($table, $columns, $where='', $order='')
    {
        $this->db->select($columns);

        if($where) $this->db->where($where);

        if($order) $this->db->order_by($order);

        $query = $this->db->get($table);

        if ($query->num_rows() > 0)
        {
            return $query->result();
        }
        return FALSE;
    }

    public function getSingleRow($table, $columns, $where='')
    {
        $this->db->select($columns);

        if($where) $this->db->where($where);

        $this->db->limit(1);

        $query = $this->db->get($table);

        if ($query->num_rows() > 0)
        {
            return $query->row();
        }
        return FALSE;
    }

    public function update($table, $data, $where)
    {
    	$this->db->where($where);
    	$this->db->update($table, $data);
    	return TRUE;
    }

    public function delete($table, $where)
    {
        $this->db->where($where);
        $this->db->delete($table);
        return TRUE;
    }

    public function isRecordExist($table, $where)
    {
        $query = $this->db->get_where($table, $where, 1);
        if($query->num_rows > 0)
        {
            return $query->row();
        }
        return FALSE;
    }
}

/* End of file model_db.php */
/* Location: ./application/models/model_db.php */