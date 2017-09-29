<?php

/**
	* This class perform following operations :
		- Login
		- Registration
		- Fetch Countries name
		- Fetch States name
		- Fetch Cities name
*/
if (!isset($_SESSION)) { 
    session_start(); 
}

class registerLogin
{
	public $db_connection;

	function __construct()
	{
		$this->db_connection = mysqli_connect('127.0.0.1', 'root', 'dolphin', 'rankwatch_task');
		if (!$this->db_connection) {
		    die("Error : Connection failed: " . mysqli_connect_error());
		}
	}

	function login($email, $password) {

		$muemail = mysqli_real_escape_string($this->db_connection, $email);
		$upassword = mysqli_real_escape_string($this->db_connection, md5($password)); 

		$login_status = "SELECT * FROM user_detail WHERE email = '$muemail' and password = '$upassword'";

		$login_result = mysqli_query($this->db_connection, $login_status);

		$count = mysqli_num_rows($login_result);

		if($count == 1) {
			$row = mysqli_fetch_assoc($login_result);
			$_SESSION['login_user'] = $row['email'];
			$_SESSION['login_name'] = $row['name'];
			$_SESSION['login_id'] = $row['id'];
			$_SESSION['last_action'] = time();
			setCookie('login_id', $row['id']);
			setCookie('login_user', $row['email']);
			setCookie('login_name', $row['name']);
			return true;
		}
		else {
			return false;
		}
	}

	function register($data) {
		if (isset($data)) {
			$query = "SELECT * FROM user_detail WHERE email = '".$data['email']."'";
			$check = mysqli_query($this->db_connection, $query);

			if (mysqli_num_rows($check) > 0) {
				return 'exist';
			}
			else {
				$password = md5($data['user_password']);
				$insert_data = "INSERT INTO user_detail (`name`, `email`, `password`, `phone_no`, `age`, `gender`, `address`, `country`, `state`, `city`, `ip`, `added_on`) VALUES ('{$data['full_name']}', '{$data['email']}', '{$password}', '{$data['contact_no']}', '{$data['age']}', '{$data['gender']}', '{$data['address']}', '{$data['country']}', '{$data['state']}', '{$data['city']}', '{$_SERVER['SERVER_ADDR']}', NOW())";
				if (!mysqli_query($this->db_connection, $insert_data))
					return 'error';
			}
			return true;
		}
		return false;
	}

	function logout($id) {
		session_destroy();
		return true;
	}

	function sessionLogin($id, $email) {

		$muemail = mysqli_real_escape_string($this->db_connection, $email);
		$id = mysqli_real_escape_string($this->db_connection, $id); 

		$login_status = "SELECT * FROM user_detail WHERE email = '$muemail' and id = '$id'";

		$login_result = mysqli_query($this->db_connection, $login_status);

		$count = mysqli_num_rows($login_result);

		if($count == 1) {
			$row = mysqli_fetch_assoc($login_result);
			$_SESSION['login_user'] = $row['email'];
			$_SESSION['login_name'] = $row['name'];
			$_SESSION['login_id'] = $row['id'];
			// setCookie('login_id', $row['id']);
			// setCookie('login_user', $row['email']);
			// setCookie('login_name', $row['name']);
			return true;
		}
		else {
			return false;
		}
	}

	function getCountries() {
		$query = "SELECT * FROM countries";
		$result = mysqli_query($this->db_connection, $query);
		$send_data = [];
		if (mysqli_num_rows($result) > 0) {
			$send_data[] = '<option value="">Select your Country</option>';
		    while($row = mysqli_fetch_assoc($result)) {
		        $send_data[] = '<option ph_code="'.$row["phonecode"].'" country_id="'.$row["id"].'" code="'.$row["sortname"].'" value="'.$row["id"].'">'.$row["name"].'</option>';
		    }
		}
		return $send_data;
	}

	function getStates($country_id) {
		$query = "SELECT * FROM states WHERE country_id = {$country_id}";
		$result = mysqli_query($this->db_connection, $query);
		$send_data = [];
		if (mysqli_num_rows($result) > 0) {
			$send_data[] = '<option value="">Select your States</option>';
		    while($row = mysqli_fetch_assoc($result)) {
		        $send_data[] = '<option state_id="'.$row["name"].'" value="'.$row["id"].'">'.$row["name"].'</option>';
		    }
		}
		return $send_data;
	}

	function getCities($state_id) {
		$query = "SELECT * FROM cities WHERE state_id = {$state_id}";
		$result = mysqli_query($this->db_connection, $query);
		$send_data = [];
		if (mysqli_num_rows($result) > 0) {
			$send_data[] = '<option value="">Select your City</option>';
		    while($row = mysqli_fetch_assoc($result)) {
		        $send_data[] = '<option city_id="'.$row["id"].'" value="'.$row["name"].'">'.$row["name"].'</option>';
		    }
		}
		return $send_data;
	}

	function sendMail($mailing_info) {
			
		try {
			require_once('mailing/PHPMailer/class.phpmailer.php');

			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Host = "smtp.mandrillapp.com"; 
			$mail->Port = 587;
			$mail->SMTPDebug = 0;
			$mail->SMTPAuth = true; 
			$mail->Username = "ggoyal19@gmail.com";
			$mail->Password = "W5A15EId9BA5K0KCCx_FCA";

			$mail->ClearAddresses();
			$mail->ClearBCCs();
			$mail->ClearAttachments();
			$mail->ClearReplyTos();
			$mail->ClearAllRecipients();

			$mail->SMTPDebug = 1;

			$mail->AddAddress(trim($mailing_info['email_to']));
			$mail->Subject = $mailing_info['subject'];
			$mail->MsgHTML($mailing_info['message']);
			$mail->setFrom('ajunakki707@gmail.com', $mailing_info['full_name']);
			$mail->AddReplyTo('example@gmail.com');
			// $mail->AddAttachment( $mailing_info['attachment'], 'abc.jpg');

			if ($mail->Send()) {
				return true;
			}
			return false;
		}
		catch(Exception $e) {
			var_dump($e);
			die;
		}
	}

	function fetchWebData($url_arr) {
		error_reporting(0);
		if (isset($url_arr) && !empty($url_arr['url'])) {

	   		$url = trim($url_arr['url']);
		   	if (!preg_match("~^(?:f|ht)tps?://~i", $url))
		      	$url = "http://" . $url;

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:26.0) Gecko/20100101 Firefox/26.0');
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 50);
			curl_setopt($ch, CURLOPT_TIMEOUT, 50);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			$data = curl_exec($ch);
			$server_info = curl_getinfo($ch);
			curl_close($ch);

			$xmlDom = new DomDocument();
			$xmlDom->loadHTML($data);
			$metaNodeList = $xmlDom->getElementsByTagName("meta");
			$aNodeList = $xmlDom->getElementsByTagName("a");
			$meta = $external = $internal = [];
			foreach ($metaNodeList as $metaNode) {
				if ($metaNode->hasAttribute('name')) {
					$meta[$metaNode->getAttribute('name')][] = $metaNode->getAttribute('content');
				}				
			}
			$pieces = parse_url($url);
  			$domain = $this->string_between($pieces['host'], '.', '.');
			foreach ($aNodeList as $aNode) {
				if ($aNode->hasAttribute('href')) {
					if (stripos($aNode->getAttribute('href'), $domain) !== false) 
            			$internal[] = $aNode->getAttribute('href');
            		else
            			$external[] = $aNode->getAttribute('href');
				}				
			}
			return ['meta' => $meta, 
					'http' => $server_info, 
					'internal' => $internal, 
					'external' => $external
				];
		}
		return [];
	}

	function string_between($string, $start, $end){
	    $string = ' ' . $string;
	    $ini = strpos($string, $start);
	    if ($ini == 0) 
	    	return '';
	    $ini += strlen($start);
	    $len = strpos($string, $end, $ini) - $ini;
	    return substr($string, $ini, $len);
	}
}
?>