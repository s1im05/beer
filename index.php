<?php
error_reporting(E_ALL & ~E_DEPRECATED);
define('ROOT', __DIR__);

require_once 'lib/SSCE/base.class.php';
$oApplication   = new SSCE\Application('lib/config.json');