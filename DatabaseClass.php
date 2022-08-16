<?php

class DatabaseClass {  
	private $host = "localhost"; //  HOST NAME  
	private $username = "root"; //  USER NAME  
	private $password = ""; //  DATABASE PASSWORD  
	private $db = "crudoperation"; //  DATABASE NAME  
	public function __construct() { 
		
	}

	////  THIS METHOD CREATE DATABASE CONNECTION  -----///////
	private function dbConnection(){
        $con = new mysqli($this ->host,$this->username, $this->password,$this->db) or die(mysql_error("Database Error"));  
		if($con->connect_errno) {
		  echo "Failed to connect to MySQL: " .$con->connect_error;
		  exit();
		}
		return $con;
	}
	
    // THIS METHOD USED TO EXECUTE MYSQL QUERY -----///////  
    private function queryExecuted($sqlQuery) { 
		$conObj = $this->dbConnection();
		return $conObj->query($sqlQuery);
    }  
	
    // THIS METHOD USED TO FETCH ALL DATA FROM TABLE -----///////
    public function getAll($tablename='') {  
        $sql = "SELECT * FROM ".$tablename;  
        $queryExec = $this->queryExecuted($sql);  
		if($queryExec->num_rows > 0){
			$resData = $queryExec->fetch_all(MYSQLI_ASSOC);
			$queryExec->free_result();
			return $resData;
		} else {
			return null;
		}
    }  
     
    // THIS METHOD USED TO FETCH SINGLE ROW FROM TABLE -----///////
    public function getRow($tablename='',$id='') {  
        $sql = "SELECT * FROM ".$tablename." where id=".$id;  
        $queryExec = $this->queryExecuted($sql);  
		if($queryExec->num_rows > 0){
			return $queryExec->fetch_assoc();
		} else {
			return null;
		}
    }  
     
    // THIS METHOD USED TO INSERT DATA IN TO TABLE -----///////
    public function inserData($tablename='',$dataArr=[]) {  
		$dataFieldArr = implode(",",array_keys($dataArr));
		$dataValueArr = "'".implode("','",array_values($dataArr))."'";
        $sql = "INSERT INTO ".$tablename." (".$dataFieldArr.") VALUES (".$dataValueArr.")";  
		$queryExec = $this->queryExecuted($sql);  
		if($queryExec){
			return true;
		} else {
			return false;
		} 
    } 
	 
    // THIS METHOD USED TO UPDATE DATA IN TO TABLE -----///////
    public function updateData($tablename='',$dataArr=[],$id="") {  
		$updateData = '';
		foreach($dataArr as $dataArrKey=>$dataArrVal){
			$updateData .= $dataArrKey." = "."'$dataArrVal',";
		}
		$updateData = rtrim($updateData, ",");
        $updateSql = "UPDATE ".$tablename." SET ".$updateData." WHERE id=".$id;  
		$queryExec = $this->queryExecuted($updateSql);  
		if($queryExec){
			return true;
		} else {
			return false;
		} 
    } 
	
    // THIS METHOD USED TO DELETE RECORD FROM TABLE -----///////
    public function deleteData($tablename='',$id='') {  
        $sql = "DELETE FROM ".$tablename." WHERE id=".$id;  
		$queryExec = $this->queryExecuted($sql);  
		if($queryExec){
			return true;
		} else {
			return false;
		} 
    } 
	
	////-------  SUCCESS MESSAGE FUNCTION  -----///////
	public function msgSuccess($msg){
		$dvidata='<div class="alert alert-success alert-dismissable">';
		$dvidata.='<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
		$dvidata.='<strong>Success ! </strong>'.$msg.' .</div>';
		return $dvidata;
	}	  ////---  END MSGSUCCESS
	
	////-------  ERROR MESSAGE FUNCTION  -----///////
	public function msgError($msg){
		$dvidata='<div class="alert alert-danger alert-dismissable">';
		$dvidata.='<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
		$dvidata.='<strong>Warning ! </strong>'.$msg.' .</div>';
		return $dvidata;
	} ////---- END MSGERROR----/////
		
     
}  

?>