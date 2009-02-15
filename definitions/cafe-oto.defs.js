{
  "name": "Cafe Oto",
  "enabled": 1,
  
  "url": "http://www.cafeoto.co.uk/programme.shtm",  
  "root": "#maincontent tr",
  
  "properties": {
    "dc:identifier": { "selector":"#progpics a", "type":"attribute", "attribute":"href" },      
    "dc:title": ".bandname",    
    "dc:date": { "selector":".bodytext", "date":"j M y g:iA" },      
    "dc:description": { "type":"innerhtml" }
  }
}
