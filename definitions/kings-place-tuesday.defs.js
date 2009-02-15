{
  "name": "Kings Place Tuesdays",
  "enabled": 1,
  
  "url": "http://www.kingsplace.co.uk/music/this-is-tuesday",  
  "root": "p.prod-event",
  
  "properties": {
    "dc:identifier": { "selector":"strong a", "type":"attribute", "attribute":"href" },      
    "dc:title": "strong a",    
    "dc:date": { "type":"match", "match":"Time:\s+(\d+:\d+.+?\(.+?\))", "date":"G:i  (l j F)" },      
    "dc:description": { "type":"html" }
  }
}
