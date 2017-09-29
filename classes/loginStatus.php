<?php
    require_once('server-request-route.php');
	 
	if (isset($_SESSION['last_action'])) {
	    
		$expiry = 30;
	    $inactive = time() - $_SESSION['last_action'];
	    $expire_in = $expiry * 120;

	    if ($inactive >= $expire_in) {
	        session_unset();
	        session_destroy();
	    }
	    
	}
	if (isset($_SESSION) && isset($_SESSION['login_user']) && isset($_SESSION['login_id'])) {
		$email = $_SESSION['login_user'];
		$name = $_SESSION['login_name'];
		$id = $_SESSION['login_id'];
		if (isset($id) || isset($email) || !empty($id) || !empty($email)) {
			$statusObj = new registerLogin();
			if (!$statusObj->sessionLogin($id, $email)) 
				header('Location: http://localhost/rankwatch-task/login.php');
		}
	}
	else
		header('Location: http://localhost/rankwatch-task/login.php');
?>