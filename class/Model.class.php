<?php
class Model extends operDB{
	protected $tableName;
	protected $where;
	protected $fields='*';
	protected $groupby;
	protected $having;
	protected $orderby;
	protected $limit;
	function table($tablename){
		$this->tableName=$tablename;
		return $this;
	}
	function where($where){
		if(!empty($where))
		{
			$this->where=' WHERE '.$where;
		}
		return $this;
	}
	function fields($fields){
		$this->fields=$fields;
		return $this;
	}
	function groupby($groupby){
		if(!empty($groupby))
		{
			$this->groupby=' GROUP BY '.$groupby;
		}
		return $this;
	}
	function having($having){
		if(!empty($having))
		{
			$this->having=' HAVING '.$having;
		}
		return $this;
	}
	function orderby($orderby){
		if(!empty($orderby))
		{
			$this->orderby=' ORDER BY '.$orderby;
		}
		return $this;
	}
	function limit($limit){
		if(!empty($limit))
		{
			$this->limit=' LIMIT '.$limit;
		}
		return $this;
	}
	private function reset(){
		//$this->tableName='';
		$this->fields='';
		$this->where='';
		$this->groupby='';
		$this->having='';
		$this->orderby='';
		$this->limit='';
	}
	function arrtostr($arr){
		foreach ($arr as $k=>$v){
			$str.=",".$k."='".$v."'";
		}
		$str=substr($str,1);
		return $str;
	}
	function coltorow($arr){
		foreach ($arr as $v){
			$val.=",'".$v."'";
		}
		$key=join(',',array_keys($arr));
		$val=substr($val,1);
		$arr[0]=$key;$arr[1]=$val;
		return $arr;
	}
	function select(){
		$sql="SELECT {$this->fields} FROM {$this->tableName}{$this->where}{$this->groupby}{$this->having}{$this->orderby}{$this->limit}";
		//return $sql;
		$rows=$this->dbquery($sql);
		$this->reset();
		return $rows;
	}
	function update($arr,$where){
		$sql="UPDATE {$this->tableName} SET {$this->arrtostr($arr)}{$this->where}";
		//return $sql;
		$row=$this->dbquery($sql);
		$this->reset();
		return $row;
	}
	function delete(){
		$sql="DELETE FROM {$this->tableName}{$this->where}";
		$rows=$this->dbquery($sql);
		$this->reset();
		return $rows;
	}
	function insert($arr){
		$arr=$this->coltorow($arr);
		$sql="INSERT INTO {$this->tableName}({$arr[0]}) VALUES ({$arr[1]})";
		$rows=$this->dbquery($sql);
		$this->reset();
		return $rows;
	}
}