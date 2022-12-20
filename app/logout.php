<?php
	require $_SERVER['DOCUMENT_ROOT'] . '/includes/classes/autoloader.php';
	use Skyfall\ScreenshotManager\WebManager;

	session_start();

	$_SESSION['authorized'] = false;
	unset($_SESSION['authorized']);

	unset($_SESSION);
	session_destroy();

	Header('Location: ' . WebManager::getURL() . '/login');
?>