<?php

function get_dom($url){
  global $path;
  $path = dirname($url);
  
  $p = parse_url($url);
  
  global $root;
  $root = "{$p['scheme']}://{$p['host']}";
   
  $html = @DOMDocument::loadHTMLFile($url);
  $dom = new Zend_Dom_Query($html->saveHTML());
  
  return $dom;  
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
  $output = array();
  foreach ($node->childNodes as $child)
    $output[] = $child->saveXML();
   
  return implode(' ', $output);
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
  
  $url = (string) $url;
  if (!preg_match('!^\w+://!', $url)){
    if (preg_match('!^/!', $url))
      $url = $root . $url;
    else{
      $url = $path . '/' . $url;
    }
  }
  
  return $url;
}

function strtodate($format, $data){
  debug($format); debug($data);
  $date = DateTime::createFromFormat($format, trim($data));
  debug($date->getTimestamp());
  if (is_object($date))
    return $date->format('c');
}

function ical($defs, $events){
  require 'icalendar.tpl.php';
}

function debug($t){
  $debug = 0;
  if ($debug){
    print_r($t);
    print "\n";
  }
}

