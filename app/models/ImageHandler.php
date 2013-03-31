<?php

/**
 * ImageHandler
 */
class ImageHandler
{
    private $_filepath;
    private $_image;
    private $_mime;

    public function __construct($filepath)
    {
        $this->_filepath = $filepath;
    }
    
    private function getWidth()
    {
        return imagesx($this->_image);
    }
    
    private function getHeight()
    {
        return imagesy($this->_image);
    }

    public function load()
    {
        $imageInfo = getimagesize($this->_filepath);
        if ($imageInfo) {
            $this->_mime = $imageInfo[2];
            if ($this->_mime == IMAGETYPE_JPEG) {
                $this->_image = imagecreatefromjpeg($this->_filepath);
            } else if ($this->_mime == IMAGETYPE_PNG) {
                $this->_image = imagecreatefrompng($this->_filepath);
            }
        }
        return $this->_image != false;
    }
    
    /**
     * Remder image to browser
     * 
     * @param IMAGETYPE $mime Mimetype of rendered image
     */
    public function render($mime = IMAGETYPE_JPEG)
    {
        header("Content-Type: " . image_type_to_mime_type($mime));
        if ($mime == IMAGETYPE_JPEG) {
            imagejpeg($this->_image);
        } else if ($mime == IMAGETYPE_PNG) {
            imagepng($this->_image);
        }
        exit;
    }
    
    /**
     * Resize image to size
     * 
     * @param int $width Width in pixels
     * @param int $height Height in pixels
     */
    public function resize($width, $height)
    {
        $newImage = imagecreatetruecolor($width, $height);
        imagecopyresampled($newImage, $this->_image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->_image = $newImage;
    }
    
    /**
     * Resize image by width
     * 
     * @param int $width Width in pixels
     */
    public function resizeToWidth($width)
    {
        $ratio = $width / $this->getWidth();
        $height = $this->getHeight() * $ratio;
        $this->resize($width, $height);
    }
    
    /**
     * Resize image to height
     * 
     * @param int $height Height in pixels
     */
    public function resizeToHeight($height)
    {
        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width, $height);
    }
    
    /**
     * Scale image
     * 
     * @param int $scale Desired scale in percent
     */
    public function scale($scale)
    {
        $width = $this->getWidth() * $scale / 100;
        $height = $this->getHeight() * $scale / 100;
        $this->resize($width, $height);
    }
    
}
