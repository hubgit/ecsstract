#!/opt/php5.3/bin/php
<?php

date_default_timezone_set('Europe/London');

require __DIR__ . '/includes/main.inc.php';

$definitions = __DIR__ . '/../definitions/';

if ($argv[1])
  $files = array($argv[1]);
else
  $files = scandir($definitions);
  
foreach ($files as $file){
  if (!preg_match('/\.defs\.js$/', $file))
    continue;
    
  $base = basename($file, '.defs.js');
  $inc = $definitions . $base . '.inc.php';
  if (file_exists($inc))
    include $inc;
  $fix = preg_replace('/\W/', '_', $base) . '\fix';
  
  debug($file);
  $json = file_get_contents($definitions . $file);
  $json = str_replace('\\', '\\\\', $json); // for regular expressions

  $defs = json_decode($json);
  debug($defs);
  
  if (!is_object($defs))
    die("Error parsing JSON definitions:" . json_last_error());
    
  if (!$defs->enabled)
    continue;
  
  $dom = get_dom($defs->url);
  
  $nodes = $dom->query($defs->root);
  debug(count($nodes) . ' nodes');
  
  $items = array();
  foreach ($nodes as $node){
    $d = new DOMDocument();
    $d->appendChild($d->importNode($node, TRUE));
    $zend = new Zend_Dom_Query($d->saveHTML());
    //debug($d->saveHTML());
   
    $properties = array();
    foreach ($defs->properties as $property => $def){
      if (is_string($def))
        $def = (object) array('selector' => $def);
        
      //debug($def);
      if ($def->selector){
        $t = array();
        foreach ($zend->query($def->selector) as $selected)
          $t[] = $selected;
        $item = $t[0];
      }
      else
        $item = $node;
      
      if (!$item)
        continue;
       
      if ($def->derived)
        $data = $properties[$def->derived];
      else
        $data = format($item, $def);
      
      if (function_exists($fix))
        $data = call_user_func($fix, $property, $data);
      
      if ($def->date)
        $data = strtodate($def->date, $data);
      
      $properties[$property] = $data;
    }
    
    if (!($properties['dc:identifier'] && $properties['dc:date'] && $properties['dc:title']))
      continue;
      
    if ($properties['dc:identifier'])
      $properties['dc:identifier'] = base_url($properties['dc:identifier']);
      
    if (!$properties['start'])
      $properties['start'] = strtotime($properties['dc:date']);
    
    if (!$properties['end'] && is_numeric($properties['start']))
      $properties['end'] = $properties['start'] + 3600; // 1hr  

    $items[] = $properties;
  }
  
  //debug($items); exit();

  ical($defs, $items);
}


  
