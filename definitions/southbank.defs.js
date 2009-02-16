{
  "name": "Southbank Centre",
  "enabled": 1,
  
  "url": "http://www.southbankcentre.co.uk/all-events?action=calendar&page=1&venue=",
  "root": "#col1 .list",
    
  "properties": {
    "dc:identifier": { "selector":".more a", "type":"attribute", "attribute":"href" },      
    "dc:title": "h4",    
    "dc:date": { "selector":".datetime", "date":"j F Y" },      
    "dc:description": { "selector":".info2", "type":"html" },
    "location": ".venue"
  },

  "next": ".pagination a"
}
