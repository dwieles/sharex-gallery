<?php
	require $_SERVER['DOCUMENT_ROOT'] . '/includes/classes/autoloader.php';
	use Skyfall\ScreenshotManager\WebManager;
	$login_error = false;

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	if(isset($_SESSION['authorized']) && $_SESSION['authorized'] === true) {
		Header('Location: ' . WebManager::getURL() . '/' . WebManager::INDEX_PAGE);
	}

	// variable will be set to false if parameter is missing
	$token = filter_input(INPUT_POST, 'password');

	// check if password is correct
	if($token == WebManager::SITE_PASSWORD) {
		$_SESSION['authorized'] = true;
		Header('Location: ' . WebManager::getURL() . '/' . WebManager::INDEX_PAGE);
	}

	// else show an error only if post isn't empty
	else if(!empty($_POST)) {
		$login_error = true;
	}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Login - <?php echo WebManager::SITE_NAME; ?></title>

	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html, charset=UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=0" />
	<meta name="theme-color" content="#36393E">

	<link rel="stylesheet" type="text/css" href="/static/css/base.css">
	<link rel="stylesheet" type="text/css" href="/static/css/login.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script type="text/javascript" src="/static/js/login.js"></script>
</head>

<body>
	<section class="container">
		<header class="header">
			<h1>Login</h1>
			<p>Enter the site password to continue</p>
		</header>

		<section class="main-content">
			<form method="post">
				<input type="password" placeholder="Enter your password" name="password" id="password-field" autocomplete="on" required>
				<section class="error-msg"><?php echo ($login_error ? 'ⓘ Invalid Password' : ''); ?></section>
				<button type="submit" id="form-submit">Log In</button>
			</form>
		</section>
	</section>
</body>
</html>
