{
  "name": "Kings Place Tuesdays",
  "enabled": 1,
  
  "url": "http://www.kingsplace.co.uk/music/this-is-tuesday",  
  "root": "p.prod-event",
  
  "properties": {
    "dc:identifier": { "selector":"strong a", "type":"attribute", "attribute":"href", "fix": {
      "php":"return base_url($data);" 
      } },
      
    "dc:title": "strong a",
    
    "dc:date": { "type":"match", "match":"Time:\s+(\d+:\d+.+?\(.+?\))", "fix":{ 
      "javascript":"return data;", 
      "php":"$data = html_entity_decode($data); $data = preg_replace('/\s+/', ' ', $data); return strtodate('G:i  (l j F)', $data);" 
      } },
      
    "dc:description": { "type":"html" }
  }
}
