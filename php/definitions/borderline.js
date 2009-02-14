{
  "name": "Borderline",
  "enabled": 1,
  
  "url": "http://www.mamagroup.co.uk/borderline/index.html",  
  "root": "#table_listings tr",
  
  "properties": {
    "dc:identifier": { "selector":".buytixlink a", "type":"attribute", "attribute":"href", "fix": {
      "php":"return base_url($data);" 
      } },
      
    "dc:title": ".lst_head" ,
    "dc:description": { "type":"html" },
    "price": ".lst_price",
    
    "dc:date": { "selector":".lst_date", "fix": { 
      "php":"$data = preg_replace('/\s+/', ' ', $data); $data = preg_replace('/^[a-z]*/i', '', $data); return strtodate('j M g a', $data);", 
      "javascript":"return data.replace(/\s+/, ' ');" 
      } },
      
    "start": { "derived":"dc:date", "fix": { 
      "php":"return strtotime($data);" 
      } }
  },
  
  "prefixes": {
    "dc": "http://purl.org/dc/elements/1.1/"
    }
}
