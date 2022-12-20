<?php
require $_SERVER['DOCUMENT_ROOT'] . '/includes/classes/autoloader.php';
use Skyfall\ScreenshotManager\ApiManager;
$api = new ApiManager();

try {
	// If no files were uploaded
	if (!isset($_FILES['file_upload']['error']) || is_array($_FILES['file_upload']['error'])) {
		throw new \Exception('No file found');
	}

	// Validate upload error
	switch ($_FILES['file_upload']['error']) {
		case UPLOAD_ERR_OK:
			break;
		case UPLOAD_ERR_NO_FILE:
			throw new \Exception('No file sent.');
		case UPLOAD_ERR_INI_SIZE:
		case UPLOAD_ERR_FORM_SIZE:
			throw new \Exception('Exceeded filesize limit.');
		default:
			throw new \Exception('Unknown file upload error');
	}

	// Reject upload if the file is larger than 500MB
	if ($_FILES['file_upload']['size'] > ApiManager::FILESIZE_LIMIT) {
		throw new \Exception('Exceeded filesize limit');
	}

	// Get file extension based on uploaded file
	$ext = explode('.', $_FILES['file_upload']['name']);
	$ext = $ext[count($ext) - 1];
	if(!$ext) throw new \Exception('Failed to get file extension from filename');

	// This function generates an unique filename
	$filename = ApiManager::generateFileName() . '.' . $ext;

	// If we cannot upload the moved file
	if (!move_uploaded_file($_FILES['file_upload']['tmp_name'], ApiManager::getUploadFolder() . $filename)) {
		throw new \Exception('Could not write file: No permissions?');
	}

	// File was uploaded successfully. Generate ShareX URLs
	$url = ApiManager::getURL() . '/' . (ApiManager::UPLOAD_URL_OMIT_FOLDER ? '' : ApiManager::UPLOAD_FOLDER . '/') . $filename;
	$del_url = ApiManager::getURL() . "/api/delete?id=$filename";

	// Send our JSON reply
	ApiManager::die(err: '', url: $url, del: $del_url);
} catch(Exception $e) {
	ApiManager::die($e->getMessage());
}
