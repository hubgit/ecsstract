{
  "name": "Borderline",
  "enabled": 1,
  
  "url": "http://www.mamagroup.co.uk/borderline/index.html",  
  "root": "#table_listings tr",
  
  "properties": {
    "dc:identifier": { "selector":".buytixlink a", "type":"attribute", "attribute":"href" },    
    "dc:title": ".lst_head" ,
    "dc:description": { "type":"html" },
    "price": ".lst_price",
    "dc:date": { "selector":".lst_date", "date": "j M g a" }      
    "start": { "derived":"dc:date" }
  },
  
  "prefixes": {
    "dc": "http://purl.org/dc/elements/1.1/"
    }
}
