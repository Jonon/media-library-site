<?php

require_once("app_path.php");
require_once("controllers/RpcController.php");

$controller = new RpcController();
$controller->handleRequest();
