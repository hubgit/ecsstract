#!/opt/php5.3/bin/php
<?php
  
chdir(realpath(__DIR__));
  
$files = scandir('../definitions');
foreach ($files as $file){
  if (!preg_match('/\.js$/', $file))
    continue;
    
  print "$file\n";
     
  system(sprintf("./scrape.php %s > '../output/%s.ics'", escapeshellarg($file), pathinfo($file, PATHINFO_FILENAME)));
}
