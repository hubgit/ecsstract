var serverSocket;
var port = 10000;

var listen = {
  startListening: function(){
    //dumpr("startListening");
    
    if (socketListener)
      socketListener.close();
      
    var socketListener = new SocketListener();
    
    serverSocket = Components.classes["@mozilla.org/network/server-socket;1"].createInstance(Components.interfaces.nsIServerSocket);
    serverSocket.init(port, true, -1); // true = listens only on local loopback address
    serverSocket.asyncListen(socketListener);
  },

  onStartRequest: function(request, context) {
    //dumpr("onStartRequest");
  },

  onStopRequest: function(request, context, status) {
    //dumpr("onStopRequest");
    listen.transport.close(null);
  },

  onDataAvailable: function(request, context, inputStream, offset, count) {
    //dumpr("onDataAvailable");
    
    listen.data = listen.instream.read(count);
    
    if (!listen.data.match(/[\n\r]{2}/))
      return false;

    var params = parseGETParams(listen.data);
    dumpr(params);
    eccstract.defs = JSON.parse(params.defs);
  
    var url = params.url ? params.url : eccstract.defs.url;
    
    if (url && url.match(/^https?\:\/\/[^\@]+$/))
      browser.loadURI(url, null, null);
  },
  
  send: function(text){
    //dumpr("send");
    listen.instream.close();

    text = "HTTP/1.0 200 OK\n" + "Content-type: application/json\n\n" + text;
    listen.outstream.write(text, text.length);
    listen.outstream.close();
  },
};

function SocketListener(){}

SocketListener.prototype = {
  onStopListening: function(serv, status) {
    //dumpr("onStopListening");
  },

  onSocketAccepted: function(serv, transport) {
    //dumpr("onSocketAccepted");
    
    listen.data = "";
    listen.transport = transport;

    var stream = listen.transport.openInputStream(0, 0, 0);

    listen.instream = Components.classes["@mozilla.org/scriptableinputstream;1"].createInstance(Components.interfaces.nsIScriptableInputStream);
    listen.instream.init(stream);

    // make sure stream reading is blocking (see http://simile.mit.edu/issues/browse/crowbar-1)
    listen.outstream = listen.transport.openOutputStream(1, 0, 0); 

    var pump = Components.classes["@mozilla.org/network/input-stream-pump;1"].createInstance(Components.interfaces.nsIInputStreamPump);
    pump.init(stream, -1, -1, 0, 0, false);
    pump.asyncRead(listen, null);
  }
};

