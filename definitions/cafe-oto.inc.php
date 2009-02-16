<?php

namespace cafe_oto;

function fix($property, $data){
  switch ($property){
    case 'dc:date':
      $data = preg_replace('/\s+/', ' ', $data);
      $data = preg_replace('/^\D*/i', '', $data);
      preg_match('/(\d+(?:\w+)?) (\w+) \'(\d+)\s?•\s?([\d:-]+)([ap]m).*?\s?•\s?(.*)/i', $data, $matches);
      if ($matches) {
        list($full, $day, $month, $year, $time, $am, $price) = $matches;
        
        if (preg_match('/(.+?)-(.+)/', $time, $matches))
          $time = $matches[1];
          
        if (!strstr($time, ':'))
          $time .= ':00';
          
        $data = sprintf('%d %s %02d %s%s', $day, ucfirst(strtolower($month)), $year, $time, $am);
      }
    break;
  }
  
  return $data;
}
