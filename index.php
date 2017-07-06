<?php

require_once __DIR__ . '/vendor/autoload.php';
ini_set('display_errors', 1);

use EOF\HTTP\Response\BaseResponse;
use EOF\Website\LocalWebsite;

$website = new LocalWebsite('Demo', 'Homepage');

$website->displayThrough(new BaseResponse());
