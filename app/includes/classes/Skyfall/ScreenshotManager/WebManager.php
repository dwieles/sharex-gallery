<?php
	namespace Skyfall\ScreenshotManager;

	class WebManager Extends Main {
		public function __construct() {
			ob_start();

			if($errors = parent::verifyConfig()) {
				die('Error(s) in config: <br>' . implode('<br>', $errors));
			}

			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}

			if(!isset($_SESSION['authorized']) || $_SESSION['authorized'] !== true) {
				ob_flush();

				Header('Location: ' . self::getURL() . '/login');
				die();
			}
		}

		/**
		 * Calculate free and total disk space for a given drive
		 *
		 * @param string $disk
		 * 
		 * @return string
		 * 
		 */
		public static function getDiskSpace(string $disk): string {
			$free = \disk_free_space($disk);
			$total = \disk_total_space($disk);

			return self::fancyBytes($total - $free) . ' / ' . self::fancyBytes($total);
		}

		/**
		 * Scan files in a folder
		 *
		 * @param int $count
		 * @param int $offset
		 * 
		 * @return array files sorted by date (newest first)
		 * 
		 */
		public static function getUploads(int $count = 80, int $offset = 0): array {
			$output = array();

			foreach(new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(self::getUploadFolder(), \FilesystemIterator::SKIP_DOTS | \FilesystemIterator::UNIX_PATHS)) as $value) {      
				if (!$value->isFile()) continue;
				$output[] = array($value->getMTime(), $value->getSize(), $value->getFilename(), $value->getExtension());
			}

			usort($output, function($a, $b) {
				return strlen($b[0]) <=> strlen($a[0]);
			});

			return array_slice($output, $offset, $count);
		}

		/**
		 * Convert bytes to a human-friendly size denomination
		 *
		 * @param int $bytes
		 * 
		 * @return string
		 * 
		 */
		public static function fancyBytes(int $bytes): string {
			$si_prefix = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
			$base = 1024;

			$class = min((int) log($bytes, $base), count($si_prefix) - 1);
			return sprintf('%1.2f', $bytes / pow($base, $class)) . ' ' . $si_prefix[$class];
		}
	}
