<?php

if (phpversion() < 5.3) // DateTime::createFromFormat, __DIR__
  die ('Needs PHP 5.3');

define('ROOT', realpath(__DIR__) . '/../');

$paths = array(ROOT . '/libs', ROOT . '/includes', get_include_path());

set_include_path(implode(PATH_SEPARATOR, $paths));

require 'functions.inc.php';
require 'Zend/Dom/Query.php';

$date = getdate();
