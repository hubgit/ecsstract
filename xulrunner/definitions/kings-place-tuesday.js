{
  "name": "Kings Place Tuesdays",
  "enabled": 0,
  
  "url": "http://www.kingsplace.co.uk/music/this-is-tuesday",  
  "root": "p.prod-event",
  
  "properties": {
    "dc:identifier": ["strong a", ["attribute", "href"], "return text.replace(/^:/, '')"],
    "dc:title": ["strong a", "text"],
    "dc:date": ["", ["match", "Time:\s+(\d+:\d+.+?\(.+?\))"], "return text; var d = Date.parseDate(text.replace(/&nbsp;/gi,''), 'H:i (l j F)'); if (d) return d.getTime();"],
    "dc:description": ["", "html"]
  }
}