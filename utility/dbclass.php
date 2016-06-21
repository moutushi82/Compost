<?php
class DB
{
	var $DB_HOST;
	var $DB_NAME;
	var $DB_USER;
	var $DB_PASSWORD;
	
	var $conn;
	var $SQL;
	var $errorMsg;
	var $successMsg;
	
	function displayError($stop=1)
	{
		echo "<p><font color='#FF0000'>".$this->errorMsg."</font></p>";
		if($stop==1)
			exit();
	}
		
	function dbconnect()
	{
		$this->conn = mysqli_connect($this->DB_HOST,$this->DB_USER,$this->DB_PASSWORD, $this->DB_NAME);
		
		if(!$this->conn)
		{
			$this->errorMsg = mysqli_errno($this->conn) . ": " . mysqli_error($this->conn);
			$this->displayError();
		}
		
	}
		
	function __construct()
	{
		$this->errorMsg = "";
		$this->successMsg = "";
		
		$this->DB_HOST = DBHOST;
		$this->DB_NAME = DBNAME;
		$this->DB_USER = DBUSER;
		$this->DB_PASSWORD = DBPASSWORD;
		
		$this->conn = NULL;
		$this->SQL = "";
		$this->dbconnect();	
	}
	
	/*
	function __construct($host,$dbname,$user,$pass)
	{
		$errorMsg = "";
		$successMsg = "";
		$DB_HOST = $host;
		$DB_NAME = $dbname;
		$DB_USER = $user;
		$DB_PASSWORD = $pass;
		$this->conn = NULL;
		$this->SQL = "";
		
		connect();		
	
	}
	*/
	
	public function setQuery($query)
	{
		$this->SQL = $query;
	}
	
	public function select()
	{
		if($this->SQL == "")
			return false;
		
		$rs = $this->conn->query($this->SQL);
		if($rs=== false)
		{
			$this->SQL = "";
			$this->errorMsg = mysqli_errno($this->conn) . ": " . mysqli_error($this->conn);
			$this->displayError();
		}
		
		$records = array();
		while($row = $rs->fetch_assoc())
		{
			$records[] = $row;
		}
		//pr($records,0);
		$this->SQL = "";
		mysqli_free_result($rs);
		return $records;	
	}
	
	
	public function update()
	{
		if($this->SQL == "")
			return false;

		$rs = $this->conn->query($this->SQL);
		if($rs=== false)
		{
			$this->SQL = "";
			$this->errorMsg = mysqli_errno($this->conn) . ": " . mysqli_error($this->conn);
			$this->displayError();
		}

		$this->SQL = "";
		return mysqli_affected_rows($this->conn);

	}

	public function execute()
	{
		if($this->SQL == "")
			return false;
		$rs = $this->conn->query($this->SQL);
		if($rs=== false)
		{
			$this->SQL = "";
			$this->errorMsg = mysqli_errno($this->conn) . ": " . mysqli_error($this->conn);
			$this->displayError();
		}
		
		$this->SQL = "";
		return mysqli_affected_rows($this->conn);
		
	}
	
	public function insert()
	{
		if($this->SQL == "")
			return false;
		
		$rs = $this->conn->query($this->SQL);
		//pr($rs);
		if($rs=== false)
		{
			$this->SQL = "";
			$this->errorMsg = mysqli_errno($this->conn) . ": " . mysqli_error($this->conn);
			$this->displayError();
		}
		
		$this->SQL = "";
		return mysqli_insert_id($this->conn);
	}
	
	public function close()
	{
		$this->errorMsg = "";
		$this->successMsg = "";

		$this->DB_HOST = "";
		$this->DB_NAME = "";
		$this->DB_USER = "";
		$this->DB_PASSWORD = "";

		if($this->conn)
			mysqli_close($this->conn);
			
		$this->SQL = "";
	}
	
}



?>