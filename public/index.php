<?php

echo __dir__;
require_once __DIR__.'/../autoload.php';
use App\app;
session_start();
$app = new app();
