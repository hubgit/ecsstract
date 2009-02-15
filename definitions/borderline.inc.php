<?php

namespace borderline;

function fix($property, $data){
  switch ($property){
    case 'dc:date':
        $data = preg_replace('/\s+/', ' ', $data); 
        $data = preg_replace('/^[a-z]*/i', '', $data);
    break;
  }
  
  return $data;
}
