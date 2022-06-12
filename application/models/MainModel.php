<?php 
class MainModel extends CI_Model{
	function getWhere($table,$where)
	{
		return $this->db->get_where($table,$where);
	}
	function getAllImage()
	{
		return $this->db->select('*')->order_by('timestamp', 'DESC')->get('img_info')->result();
	}
	function getUserImage($id)
	{
		return $this->db->select('*')->order_by('timestamp', 'DESC')->where('id_user', $id)->get('img_info')->result();
	}
	function updateData($table,$data,$where)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	function inputData($table, $data){
		$this->db->insert($table, $data);
	}
	function deleteData($table, $where){
		$this->db->where($where);
		$this->db->delete($table);
	}
	function getLatest($table, $col){
		return $this->db->select($col)->from($table)->order_by($col,"desc")->limit(1)->get()->row($col);
	}
}