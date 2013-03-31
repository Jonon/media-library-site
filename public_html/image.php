<?php

require_once("paths.php");
require_once("controllers/ImageController.php");

$controller = new ImageController();
$controller->handleRequest();
