<?php

require_once __DIR__ . '/vendor/autoload.php';
ini_set('display_errors', 1);

use EOF\HTTP\Response\BaseResponse;
use Website\Demo\Website;
use Website\Demo\Homepage;

$website = new Website(
    new Homepage()
);

$website->sendThrough(new BaseResponse());
