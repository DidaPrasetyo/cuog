<?php 
class MainModel extends CI_Model{
	function getWhere($table,$where)
	{
		return $this->db->get_where($table,$where);
	}
	function getAllImage()
	{
		return $this->db->select('*')->get('img_info')->result();
	}
	function updatePass($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	function inputData($table, $data){
		$this->db->insert($table, $data);
	}
	function getLatest($table, $col){
		return $this->db->select($col)->from($table)->order_by($col,"desc")->limit(1)->get()->row($col);
	}
}