<?php

require_once __DIR__ . '/vendor/autoload.php';
ini_set('display_errors', 1);

use EOF\HTTP\Request\BaseRequest;
use EOF\HTTP\Response\BaseResponse;
use Website\Demo\Pages\DemoPagesFactory;

$page = new DemoPagesFactory(
    new BaseRequest()
);

$page->sendThrough(new BaseResponse());
