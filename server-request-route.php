<?php

    if (!file_exists('classes/registerLogin.php')) 
        die('<h2>Something went wrong...</h2>');

    require_once('classes/registerLogin.php');
    
	$registerLoginObj = new registerLogin();
	
	if (isset($_POST)) {
		if (isset($_POST['country_id']) && !empty($_POST['country_id'])) {
			$states = $registerLoginObj->getStates($_POST['country_id']);
			echo json_encode($states);
			exit;
		}
		elseif (isset($_POST['state_id']) && !empty($_POST['state_id'])) {
			$cities = $registerLoginObj->getCities($_POST['state_id']);
			echo json_encode($cities);
			exit;
		}
		elseif (isset($_POST['registerationForm']) && !empty($_POST['registerationForm'])) {
			$register = $registerLoginObj->register($_POST);

			if ($register == true)
				header('Location: http://localhost/rankwatch-task/login.php?register=success');
			elseif ($register == 'exist') 
			   header('Location: http://localhost/rankwatch-task/registration.php?error=exist');
			elseif ($register == 'error') 
			   header('Location: http://localhost/rankwatch-task/registration.php?error=error');
			exit;
		}
		elseif (isset($_POST['loginFrom']) && !empty($_POST['loginFrom'])) {
			$login = $registerLoginObj->login($_POST['email'], $_POST['user_password']);
			if ($login == true)
				header('Location: http://localhost/rankwatch-task/home.php');
			exit;
		}
		elseif (isset($_POST['sendmailFrom']) && !empty($_POST['sendmailFrom'])) {
			$send = $registerLoginObj->sendMail($_POST);
			if ($send == true)
				header('Location: http://localhost/rankwatch-task/send-ur-mail.php?send=success');
			else
				header('Location: http://localhost/rankwatch-task/send-ur-mail.php?send=unsuccess');
			exit;
		}
		if (isset($_POST['url']) && !empty($_POST['url'])) {
			$webData = $registerLoginObj->fetchWebData($_POST);
			echo json_encode($webData);
			exit;
		}
	}
	if (isset($_GET)) {
		if (isset($_GET['logoutForm']) && !empty($_GET['logoutForm'])) {
			$logout = $registerLoginObj->logout($_GET['logoutForm']);
			if ($logout == true)
				header('Location: http://localhost/rankwatch-task/login.php');
			exit;
		}
	}

?>