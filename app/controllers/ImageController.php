<?php

require_once 'models/ImageHandler.php';

/**
 * Image controller class
 */
class ImageController
{
    public function __construct()
    {

    }

    /**
     * Handles page request and performs the approriate action based on input
     */
    public function handleRequest()
    {
        try {
            if (isset($_GET['path']))
                $path = PUBLIC_PATH . "/" . $_GET['path'];
            if (isset($_GET['height']))
                $height = $_GET['height'];
            if (isset($_GET['width']))
                $width = $_GET['width'];
            if (isset($_GET['scale']))
                $scale = $_GET['scale'];

            if (isset($path)) {
                $handler = new ImageHandler($path);

                if ($handler->load()) {

                    if (isset($width) && isset($height) && !isset($scale)) {
                        $handler->resize($width, $height);
                    } else if (isset($width) && !isset($scale)) {
                        $handler->resizeToWidth($width);
                    } else if (isset($height) && !isset($scale)) {
                        $handler->resizeToHeight($height);
                    } else if (isset($scale)) {
                        $handler->scale($scale);
                    } else {
                        throw new Exception('Bad request');
                    }
                    $handler->render();
                } else {
                    throw new Exception('Could not handle file');
                }
            }
        } catch(Exception $e) {
            header('HTTP/1.1 400 Bad Request');
        }
    }

}
