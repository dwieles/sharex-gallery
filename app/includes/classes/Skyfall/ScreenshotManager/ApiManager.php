<?php
    namespace Skyfall\ScreenshotManager;

    class ApiManager Extends Main {
        public function __construct() {
            ob_start();

            if($errors = parent::verifyConfig()) {
                self::die('Error(s) in config: ' . implode(',', $errors));
            }

            session_start();
            $request_token = filter_input(INPUT_POST, 'token');
            if($request_token !== self::API_TOKEN) {
                ob_flush();
                self::die('Invalid token');
            }

            // API always sends JSON
        	header('Content-Type: application/json');
        }

        public static function dieOnException(\Exception $e) {
            self::die(err: $e->getMessage());
        }

        public static function die($err, $url = '', $del = '') {
            ob_flush();
            die(json_encode(['url' => $url, 'del' => $del, 'err' => $err]));
        }
    }
