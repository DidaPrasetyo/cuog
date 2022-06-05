<?php 
class MainModel extends CI_Model{
	function getWhere($table,$where)
	{
		return $this->db->get_where($table,$where);
	}
	function updatePass($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	function inputData($table, $data){
		$this->db->insert($table, $data);
	}
}