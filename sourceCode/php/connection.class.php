<?php
class Common{
	public $conn;
	public $servername = "localhost";
	public $username = "root";
	public $password = "";
	public $dbname = "attendance";
	public function __construct(){
	    //session_start();
	    $this->connect();
	}
	public function connect(){
		$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

	// Check connection
		if ($this->conn->connect_error) {
	    	die("Connection failed: " . $this->conn->connect_error);
		}
	}
	public function getData($sql){
		$result = $this->conn->query($sql);
		$data = array();
		if ($result->num_rows > 0) {
	    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	$data[] = $row;
		        
		    }
		    return $data;
		} else {
	    	return false;
		}
	}

	public function setSuccessMsg($msg) {
        if ($msg != '') {
            $_SESSION['success'][] = $msg;
        }
    }

    public function getSuccessMsg() {
        $msg = '';
        if (isset($_SESSION['success'])) {
            foreach ($_SESSION['success'] as $k => $v) {
                $msg .= '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="width:300px;">x</button>' . $v . '</div>';
            }
            return $msg;
        }
    }

    public function setErrorMsg($msg) {
        if ($msg != '')
            $_SESSION['error'][] = $msg;
    }

    public function getErrorMsg() {
        $msg = '';
        if (isset($_SESSION['error'])) {
            foreach ($_SESSION['error'] as $k => $v) {
                $msg .= '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>' . $v . '</div>';
            }
            return $msg;
        }
    }

    public function unsetMessage() {
        if (isset($_SESSION['error']) || isset($_SESSION['success'])) {
            unset($_SESSION['error']);
            unset($_SESSION['success']);
        }
    }
	public function validateLogin(){
		if(isset($_POST)){
			$username = $_POST['username'];
			$password = $_POST['password'];
			if(!isset($username) || !isset($password)){
				$this->setErrorMsg("Username or password is empty!");
				header("location:index.php");
				exit;
			}
			$query = "select count(*) as userStatus from tbl_users where email_id='$username' and password='$password' and delflag=0";
			$chkUser = $this->getData($query);
			if($chkUser[0]['userStatus']>0){
				$userData = $this->getData("select * from tbl_users where email_id='$username' and password='$password'");
				$_SESSION['user_id'] = $userData[0]['user_id'];
				$_SESSION['email_id'] = $userData[0]['email_id'];
				$_SESSION['name'] = $userData[0]['name'];
				$_SESSION['rfid_uid'] = $userData[0]['rfid_uid'];
				$_SESSION['user_type'] = $userData[0]['user_type'];
				$_SESSION['user_logged_in'] = 1;

				header("location:viewAttendance.php");
				exit;
			}else{
				$this->setErrorMsg("User does not exists with given credentials!");
				return ;
			}
		}
	}
	public function getAttendanceData($month,$year){
		if(!is_numeric($month) || $month>12 || $month<1){
			$this->setErrorMsg("Please Select valid month!");
			header("location:viewAttendance.php");
			exit;
		}
		$retData = array();
		$fullDate = $year."-".$month."-"."01";
		//print_r($_SESSION);
		if($_SESSION['user_type']==1){
			  $sql = "SELECT t1.*,t2.rfid_uid,min(punch_time) as punchin,max(punch_time) as punchout,t2.name FROM tbl_attendance as t1 right join tbl_users as t2 on t1.rfid_uid=t2.rfid_uid WHERE YEAR(punch_time) = $year AND MONTH(punch_time) = $month and t2.rfid_uid='".$_SESSION['rfid_uid']."'";
			$retData = $this->getData($sql);
		}else if($_SESSION['user_type'] == 2){
			$sql = "SELECT t1.*,t2.rfid_uid,min(punch_time) as punchin,max(punch_time) as punchout,t2.name FROM tbl_attendance as t1 right join tbl_users as t2 on t1.rfid_uid=t2.rfid_uid WHERE YEAR(punch_time) = $year AND MONTH(punch_time) = $month group by t2.rfid_uid";
			$retData = $this->getData($sql);
			
		}
		return $retData;
	}
	public function getDayOfDate($date){
		return date("d",strtotime($date));
	}
	public function getTimeOfDate($date){
		return date("H:i:s",strtotime($date));
	}
	public function getHoursBetweenDates($date1,$date2){
		$t1 = StrToTime ( $date2);
		$t2 = StrToTime ($date1);
		$diff = $t1 - $t2;
		return $hours = round($diff / ( 60 * 60 ),2);
	}
	public function getRFIDAttendanceApi(){
		$rfid_uid = trim($_REQUEST['uid']);
		$sql = "select count(*)as tot from tbl_users where rfid_uid='$rfid_uid'";

		$data = $this->getData($sql);
		if(count($data)>0 && $data[0]['tot']>0){
			$sql = "insert into tbl_attendance set rfid_uid='$rfid_uid'";
			$flag = $this->conn->query($sql);
			if($flag){
				echo "Attendance marked successfully!";
				die;
			}else{
				echo "Sorry! Something unexpected happened!";
				die;	
			}

		}else{
			echo "invalid access";die;
		}
	}
	public function checkUIDAlreadyExists(){
		$rfid_uid = trim($_REQUEST['uid']);
		if(!isset($rfid_uid)||strlen($rfid_uid)<8 || empty($rfid_uid)){
			//echo json_encode(array("msg_type"=>"error","msg"=>"RFID Code not Received"));
			echo "2";
			exit;
		}
		$sql = "select count(*)as tot from tbl_users where rfid_uid='$rfid_uid'";
		$data = $this->getData($sql);
		if(count($data)>0 && $data[0]['tot']>0){
			//echo json_encode(array("msg_type"=>"error","msg"=>"This RFID Card is already Exists or Registered!"));
			echo "0";
			exit;
		}else{
			echo "1";
			//echo json_encode(array("msg_type"=>"success","msg"=>"This is new RFID Card"));
			exit;
		}
	}

	public function addUser(){
		$name = trim($_REQUEST['name']);
		$rfid_uid = trim($_REQUEST['uid']);
		if(empty($name) || empty($rfid_uid)){
			echo "Name and RFID UID Cannot be empty!";
			exit;
		}
		$sql = "insert into tbl_users set name = '$name',rfid_uid = '$rfid_uid'";
		if($this->conn->query($sql)){
			echo "User Added Successfully!";
			exit;
		}else{
			echo "Sorry! Something unexpected happened!";
			exit;
		}
	}
	
} 
class Attendance{
	
}