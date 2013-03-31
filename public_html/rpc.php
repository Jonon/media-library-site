<?php

require_once("paths.php");
require_once("controllers/RpcController.php");

$controller = new RpcController();
$controller->handleRequest();
