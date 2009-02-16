<?php

function debug($t){
  global $debug;
  if ($debug){
    print_r($t);
    print "\n";
  }
}

function get_dom($url){
  debug($url);
   
  $p = parse_url($url);
  
  global $root;
  $root = "{$p['scheme']}://{$p['host']}";
  
  global $path;
  $path = $root . dirname($p['path']);
  
  global $relative;
  $relative = $root . $p['path'];
   
  //$html = @DOMDocument::loadHTMLFile($url);
  
  $dom = new DOMDocument('1.0', 'UTF-8');
  $dom->preserveWhiteSpace = TRUE;
  @$dom->loadHTMLFile($url);
  
  return new Zend_Dom_Query($dom->saveHTML());
}

function format($node, $def){
    switch ($def->type){
      case 'text':
      default:
        return $node->textContent;
      break;
      
      case 'attribute':
        if ($def->attribute == 'href')
          return $node->getAttribute($def->attribute); // FIXME
        else
          return $node->getAttribute($def->attribute);
      break;
      
      case 'match':
        if (preg_match(sprintf('/%s/', $def->match), $node->textContent, $matches))
          return $matches[1];
      break;
            
      case 'html':
        $d = new DOMDocument();
        $d->appendChild($d->importNode($node, TRUE));
        return $d->saveHTML();
      break;
      
      case 'innerhtml':
        return innerHTML($node);
      break;
    }
  }

function first($array){
  return current(array_slice($array, 0, 1));
}

function sanical($text){
  $text = filter_var($text, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
  $text = preg_replace('/&.+?;/', ' ', $text);
  $text = str_replace(array("\n", ',', ';'), array('\\n', '\,', '\;'), $text);
  print trim($text) . "\n";
}

function clean_html($html){
  $html = preg_replace('/<!--[^>]*-->/', '', $html);
  return $html;
}

function innerHTML($node){
  $d = new DOMDocument();     

  foreach ($node->childNodes as $child)
      $d->appendChild($d->importNode($child, TRUE));
   
  return $d->saveHTML();
}

function innerXML($node){
  $output = array();

  foreach ($node->children() as $child)
    $output[] = $child->asXML();
    
  return implode(' ', $output);
}

function base_url($url){
  global $root;
  global $path;
  global $relative;
  
  $url = (string) $url;
  if (!preg_match('!^\w+://!', $url)){
    if (preg_match('!^/!', $url))
      $url = $root . $url;
    elseif (preg_match('/^\?/', $url))
      $url = $relative . $url;
    else
      $url = $path . '/' . $url;
  }
  
  return $url;
}

function strtodate($format, $data){
  debug($format); debug($data);
  $date = DateTime::createFromFormat($format, trim($data));
  if (is_object($date)){
    debug($date->format('c'));
    return $date->format('c');
  }
}

function ical($defs, $events){
  require 'icalendar.tpl.php';
}

