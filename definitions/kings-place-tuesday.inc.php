<?php

namespace kings_place_tuesday;

function fix($property, $data){
  switch ($property){
    case 'dc:date':
      $data = html_entity_decode($data);
      $data = preg_replace('/\s+/', ' ', $data);
    break;
    
    case 'dc:identifier':
      $data = base_url($data);
    break;
  }
  
  return $data;
}
