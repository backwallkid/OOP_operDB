<?php
class operDB{
	private $conn;
	function __construct(){
		$conn=mysql_connect(HOST,USERNAME,PASSWORD);
		if($conn){
			mysql_select_db(DBNAME);
			mysql_query('set names '.CHARSET);
			$this->conn=$conn;
			return true;
		}
		return false;
	}
	public function dbquery($sql){
		$fst=substr($sql,0,2);
		$res=mysql_query($sql);
		if(preg_match('/^....te/i',$sql))
		{
			if($res)
			{
				return mysql_affected_rows($this->conn);
			}
		}
		elseif(preg_match('/^insert/i',$sql))
		{
			if($res)
			{
				return mysql_insert_id($this->conn);
			}
		}
		elseif(preg_match('/^select/i',$sql))
		{
			if(is_resource($res))
			{
				for($i=0;$i<mysql_num_rows($res);$i++)
				{
					$rows[$i]=mysql_fetch_row($res);
				}
				mysql_free_result($res);
				return $rows;
			}
		}
		return false;
	}
	public function __destruct(){
		mysql_close($this->conn);
	}

}
