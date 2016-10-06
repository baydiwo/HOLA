<?php
	ini_set('display_errors',1);
	session_start();

	require_once 'class.user.php';
	$session = new USER();

	// if user session is not active(not loggedin) this page will help 'home.php and profile.php' to redirect to login page
	// put this file within secured pages that users (users can't access without login)

	if(!$session->is_loggedin())
	{
		// session no set redirects to login page
		$session->redirect('index.php');
	}

	$auth_user = new USER();
	$user_id = $_SESSION['user_session'];
	$stmt = $auth_user->runQuery("SELECT * FROM admin WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
