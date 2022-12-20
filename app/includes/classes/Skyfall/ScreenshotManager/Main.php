<?php

namespace Skyfall\ScreenshotManager;

class Main extends Settings {
    public static function verifyConfig() {
        $errors = [];

        if(empty(self::API_TOKEN)) {
            $errors[] = 'API Token may not be empty';
        }

        if(empty(self::SITE_PASSWORD)) {
            $errors[] = 'Site password may not be empty';
        }

        if(str_contains(DIRECTORY_SEPARATOR, self::UPLOAD_FOLDER)) {
            $errors[] = 'File upload folder may not contain slashes';
        }

        if(!file_exists($_SERVER['DOCUMENT_ROOT'] . '/' .self::UPLOAD_FOLDER)) {
            $errors[] = 'File upload folder does not exist: ' . self::UPLOAD_FOLDER;
        }

        if(0775 === (@fileperms(self::UPLOAD_FOLDER) & 0777)) {
            $errors[] = 'Upload folder does not have the proper permissions. (0777)';
        }

        if(0775 === (@fileperms(self::TMP_FOLDER) & 0777)) {
            $errors[] = 'Temporary files folder does not have the proper permissions. (0777)';
        }

        return $errors;
    }

    public static function getURL($index = false) {
        return 'https://' . self::DOMAIN_NAME . ($index ? '/' . WebManager::INDEX_PAGE : '');
    }

    public static function getUploadFolderURL() {
        return self::getURL() . (self::UPLOAD_URL_OMIT_FOLDER ? '/' . self::UPLOAD_FOLDER : '') . '/';
    }

    public static function getUploadFolder() {
        return '/var/www/html/' . self::UPLOAD_FOLDER . '/';
    }

    public static function print_pre($var) {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }

    /**
     * Generates a filename unique to the upload folder, regardless of extension
     *
     * @return string
     * 
     */
    public static function generateFileName(): string {
        while(true) {
            $word = array_merge(range('a', 'z'), range('A', 'Z'));
            shuffle($word);
            $filename = substr(implode($word), 0, self::FILENAME_LENGTH);

            if(count(glob(self::getUploadFolder() . $filename . '.*')) === 0) break;
        };

        return $filename;
    }
}
