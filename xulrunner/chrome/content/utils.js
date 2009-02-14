function jsdump(str){
  Components.classes['@mozilla.org/consoleservice;1'].getService(Components.interfaces.nsIConsoleService).logStringMessage(str);
}

function loadjQuery() {
  eccstract.dump("loading jQuery");

  return getContent("chrome://eccstract/jquery.js") + "; var jQ = jQuery.noConflict(true);";
}

function getContent(url) {
  //dumpr(url);
  
  var ioService = Components.classes["@mozilla.org/network/io-service;1"].getService(Components.interfaces.nsIIOService);
  var scriptableStream = Components.classes["@mozilla.org/scriptableinputstream;1"].getService(Components.interfaces.nsIScriptableInputStream);
  var channel = ioService.newChannel(url, null, null);
  channel.QueryInterface(Components.interfaces.nsIRequest);
  channel.loadFlags |= Components.interfaces.nsIRequest.LOAD_BYPASS_CACHE;
  channel.QueryInterface(Components.interfaces.nsIChannel);
  var input = channel.open();
  scriptableStream.init(input);
  
  var str = "";
  var avail;
  while ((avail = input.available()) > 0)
    str += scriptableStream.read(avail);
  scriptableStream.close();
  input.close();
  return str;
}

/* seems to eval scripts?
function getContent(url){
  var xmlhttp = Components.classes["@mozilla.org/xmlextras/xmlhttprequest;1"].createInstance();
  xmlhttp.open("GET", url, false);
  xmlhttp.send(null);
  return xmlhttp.responseText;
}
*/

function parseGETParams(data) {
  var params = {};
  var url = data.split(/[\n\r]/)[0].split(" ")[1];
  var query = url.split("?")[1];
  if (query) {
    var tokens = query.split("&");
    for (var i = 0; i < tokens.length; i++) {
      var token = tokens[i];
      var param = token.split("=");
      var name = param[0];
      var value = decodeURIComponent(param[1]);
      params[name] = value;
    }
  }
  return params;
}

function dumpr(object){
  dump(odump(object));  
}

function odump(object, depth, max){
  depth = depth || 0;
  max = max || 3;

  if (depth > max)
    return false;

  var indent = "";
  for (var i = 0; i < depth; i++)
    indent += "  ";

  if (typeof object == "string")
    return "\n" + indent + object;
    
  var output = "";  
  for (var key in object){
    output += "\n" + indent + key + ": ";
    switch (typeof object[key]){
      case "object": output += arguments.callee(object[key], depth + 1, max); break;
      case "function": output += "function"; break;
      default: output += object[key]; break;        
    }
  }
  return output;
}
