<?php

namespace Skyfall\ScreenshotManager;

class Settings {
	const DOMAIN_NAME = 'example.com';

	// Set this to "gallery" if you rename index.php to gallery.php
	const INDEX_PAGE = 'index';
	const SITE_NAME = 'ShareX Gallery';
	const SITE_VERSION = '0.1';
	const SITE_PASSWORD = 'somethingstrong';
	const API_TOKEN = 'somethingstrongagain';
	const FILENAME_LENGTH = 6;
	const UPLOAD_FOLDER = 'uploads';
	const FILESIZE_LIMIT = 500 * 1000000;
	const TMP_FOLDER = 'tmp';
	const USER_AGENT = 'ShareX Uploader';

	// Returns 'example.com/abc.png' instead of 'example.com/uploads/abc.png'
	const UPLOAD_URL_OMIT_FOLDER = true;
}
