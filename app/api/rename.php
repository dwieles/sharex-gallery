<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/classes/autoloader.php';
	use Skyfall\ScreenshotManager\ApiManager;
	$api = new ApiManager();

	// Set our input filter, default to GET
	$request_type_filter = ($_SERVER['REQUEST_METHOD'] === 'POST') ? INPUT_POST : INPUT_GET;

	// Verify filename
	$old_filename = filter_input($request_type_filter, 'old_filename', FILTER_SANITIZE_STRING);
	if(!$old_filename) {
		throw new \Exception('Invalid file argument');
	}

	// Verify NEW filename
	$new_filename = filter_input($request_type_filter, 'new_filename', FILTER_SANITIZE_STRING);
	if(!$new_filename) {
		throw new \Exception('Invalid file argument');
	}
	
	if (!rename($_CONFIG['UPLOAD_FOLDER'] . $old_filename, ApiManager::UPLOAD_FOLDER . $new_filename)) {
		throw new \Exception('File could not be renamed. Does the webserver user have the correct permissions?');
	} 

	throw new \Exception('File was renamed.');
?>