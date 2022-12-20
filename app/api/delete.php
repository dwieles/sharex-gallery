<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/classes/autoloader.php';
	use Skyfall\ScreenshotManager\ApiManager;
	$api = new ApiManager();

	// Set our input filter, default to GET
	$request_type_filter = ($_SERVER['REQUEST_METHOD'] === 'POST') ? INPUT_POST : INPUT_GET;

	// Verify filename
	$filename = filter_input($request_type_filter, 'file', FILTER_SANITIZE_STRING);
	if(!$filename) throw new \Exception('Invalid file argument');

	// delete file
	if (!unlink(ApiManager::UPLOAD_FOLDER . $filename)) {
		throw new \Exception('File could not be deleted.');
	} 

	throw new \Exception('File was deleted.');
?>