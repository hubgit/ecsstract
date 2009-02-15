<?php

namespace kings-place-tuesday;

function fix($property, $data){
  switch ($property){
    case 'dc:date':
        $data = preg_replace('/\s+/', ' ', $data); 
        $data = preg_replace('/^[a-z]*/i', '', $data);
    break;
    
    case 'dc:identifier':
      $data = base_url($data);
    break;
  }
  
  return $data;
}
