#!/opt/php5.3/bin/php
<?php

global $debug;
$debug = 0;
  
chdir(realpath(__DIR__));
$now = time();
  
$files = scandir('../definitions');
foreach ($files as $file){
  if (!preg_match('/\.defs\.js$/', $file))
    continue;
     
  $out = sprintf('../output/%s.ics', basename($file, '.defs.js'));
  
  if (!file_exists($out) || $argv[1] == 'force' || filemtime($out) < $now - 3600 * 24){
    print "$file\n";
    system(sprintf("./scrape.php %s > %s", escapeshellarg($file), escapeshellarg($out)));
  }
}
