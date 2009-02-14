{
  "name": "Borderline",
  "enabled": 1,
  
  "url": "http://www.mamagroup.co.uk/borderline/index.html",  
  "root": "#table_listings tr",
  
  "properties": {
    "dc:identifier": [".buytixlink a", ["attribute", "href"]],
    "dc:title": [".lst_head", "text"],
    "dc:description": ["", "html"],
    "event:price": [".lst_price", "text"]
    "dc:date": [".lst_date", "text", "return text.replace(/\s+/, ''); var d = Date.parseDate(text.replace(/&nbsp;/gi,''), 'H:i (l j F)'); if (d) return d.getTime();"],
  }
}
