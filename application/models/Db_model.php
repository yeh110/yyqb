<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Db_model extends CI_Model
{
	function __construct(){
  		parent::__construct();
	}

	//获取一条记录
	public function get_one($sql) {
		$query = $this->db->query($sql);
		if($data=$query->result_array()){
			return $data['0'];
		}else{
			return false;
		}
	}
	
	//读取全部
	public function get_all($sql) {
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	//插入
	public function insert($table, $dataArray, $insid=false) {
		if( !is_array($dataArray) || count($dataArray)<=0) {
			return false;
		}
		elseif($this->db->insert($table, $dataArray))
		{
			return $insid ? $this->db->insert_id() : true;
		}
		return false;
	}

	//更新
	public function update( $table, $dataArray, $where=false) {
		if( !is_array($dataArray) || count($dataArray)<=0) {
			return false;
		}elseif(empty($where)){
			return false;
		}else{
			$this->db->where($where);
		}

		return $this->db->update($table, $dataArray);
	}

	//删除
	public function delete($table, $where=false) {
		if($table && $where){
			$this->db->where($where);
			return $this->db->delete($table);
		}
		return false;
		
	}
	//获取记录总条数
	public function num_rows_sql($sql) {
		if($query = $this->db->query($sql)){
			return $query->num_rows();
		};
		return false;
	}

	//执行query
	public function query($sql){
		if($query = $this->db->query($sql)){
			return $query;
		}
		return false;
	}
}