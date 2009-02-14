var eccstract = {
  scrape: function(defs){    
    var nodes = document.querySelectorAll(defs.root);
    var items = [];    
    for each (node in nodes){
      var properties = {};
      
      for (property in defs.properties){
        var def = defs.properties[property];
        
        var selector = def[0];
        var resultType = def[1];
        var fixFunction = def[2];
        
        var item = (selector) ? node.querySelector(selector) : node;
        
        var result;
        if (item)
          result = eccstract.format(item, resultType); 
        
        if (result && fixFunction){        
          var func = new Function("text", fixFunction);
          result = func(result);
        }
        
        properties[property] = result;
      }
      
      items.push(properties);
    }

    return items;
  },
  
  format: function(node, type){
    var param; 
       
    var def = type;
    if (typeof def == "object"){
      type = def[0];
      param = def[1];
    }
    
    switch (type){
      case "text":
      default:
        return node.textContent;
      break;
      
      case "attribute":
        if (param == "href")
          return node[param];
        else
          return node.getAttribute(param);
      break
      
      case "match":
        var re = new RegExp(param, "i");
        var matches = re.exec(node.textContent);
        if (matches)
          return matches[1];
      break;
            
      case "html":
        var outer = document.createElement("div");
        outer.appendChild(node.cloneNode(true));
        return outer.innerHTML;
      break;
      
      case "innerhtml":
        return node.innerHTML;
      break;
    }
  }
}

