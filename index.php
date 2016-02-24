<?php
error_reporting(E_ALL);
define('ROOT', __DIR__);

require_once 'lib/SSCE/base.class.php';
$oApplication   = new SSCE\Application('lib/config.json');