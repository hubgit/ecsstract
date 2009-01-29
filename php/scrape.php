#!/usr/bin/env php
<?php

//require __DIR__ . '/../../main.inc.php';
$dir = __DIR__ . '/../definitions';

$files = scandir($dir);
foreach ($files as $file){
  if (!preg_match('/\.js$/', $file))
    continue;
    
  //debug($file);
  
  $json = file_get_contents($dir . '/' . $file);
  $json = str_replace('\\', '\\\\', $json); // for regular expressions

  $defs = json_decode($json);
  if (!is_object($defs))
    die("Error parsing JSON definitions:" . json_last_error());
    
  if (!$defs->enabled)
    continue;

  $params = array(
    'url' => $defs->url,
    'defs' => json_encode($defs),
    );

  //$eccstract = 'http://0.0.0.0:10000?' . http_build_query($params); // does urlencode instead of rawurlencode, adds unwanted plusses
  $url = sprintf('http://0.0.0.0:10000?url=%s&defs=%s', urlencode($params['url']), rawurlencode($params['defs'])); // better to use POST?
  //debug($url);

  $json = file_get_contents($url);
  print $json; //debug($json);

  $items = json_decode($json);
  //debug($items);

  if (!is_object($items))
    die("Error parsing JSON response:" . json_last_error());
}


  
