<?php
	use Skyfall\ScreenshotManager\WebManager;
	$current_page = (filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT)) ? $_GET['page'] : 0;

	// scan the upload directory for files using our custom scan function
	// this sorts it on date new->old
	// $uploads = WebManager::scan_dir(WebManager::getUploadFolder());

	$items_per_page = 80;
	$offset = $items_per_page * $current_page;
	$uploads = WebManager::getUploads($items_per_page, $offset);
	$pages = count($uploads) / $items_per_page;

	$prevBTN = WebManager::getURL(true) . '?page=' . ($current_page - 1 < 0 ? 0 : $current_page - 1);
	$nextBTN = WebManager::getURL(true) . '?page=' . ($pages > 1 ? $current_page + 1 : 0);

	// generate other buttons/labels
	$homeBTN = WebManager::getURL(true) . '?page=0';
	$confURL = WebManager::getURL(false) . '/makeconf.php';
	$diskTXT = WebManager::getDiskSpace(WebManager::UPLOAD_FOLDER);

	$_NAVBAR = array(
		'<header>',
			'<h1>' . WebManager::SITE_NAME . '</h1>',
			'<p>' . $diskTXT . '</p>',
			'<section class="header-content">',
				"<a href=\"$prevBTN\"><button><</button></a>",
				"<a href=\"$homeBTN\"><button>Home</button></a>",
				"<a href=\"$nextBTN\"><button>></button></a>",
			'</section>',
		'</header>');

	$_NAVBAR = implode('', $_NAVBAR);
?>
