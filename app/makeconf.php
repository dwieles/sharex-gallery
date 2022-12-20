<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/includes/classes/autoloader.php';
    use Skyfall\ScreenshotManager\WebManager;
    $web = new WebManager();

    $result_json = [
        'Name' => WebManager::SITE_NAME . ' - ' . $_SERVER['HTTP_HOST'],
        'Version' => WebManager::SITE_VERSION,
        'DestinationType' => 'ImageUploader, FileUploader, TextUploader',
	    'RequestMethod' => 'POST',
        'RequestURL' => WebManager::getURL() . '/api/upload.php',
	    'Headers' => [
	    	'User-Agent' => WebManager::USER_AGENT
	    ],
	    'Body' => 'MultipartFormData',
            'Arguments' => [
		    'token' => WebManager::API_TOKEN
	    ],
        'FileFormName' => 'file_upload',
        'URL' => '$json:url$',
        "DeletionURL" => '$json:delete$',
        "ErrorMessage" => '$json:err$'
    ];

    header("Content-Disposition: attachment; filename=sharex_uploader.sxcu");
    header('Content-Type: application/json');
    echo json_encode($result_json);
?>
