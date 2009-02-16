<?php

namespace southbank;

function fix($property, $data){
  switch ($property){
    case 'dc:date':
      $data = preg_replace('/\s+/', ' ', $data);
      $data = preg_replace('/^\D*/i', '', $data);
      preg_match('/(.+?) - /', $data, $matches);
      if ($matches)
        $data = $matches[1];
    break;
  }
  
  return $data;
}
