(function(){
    var jquery = document.createElement("script");
    jquery.type = "text/javascript";
    jquery.src = chrome.extension.getURL("jquery-1.8.3.min.js");
    jquery.onload = function() {
        var s = document.createElement("script");
        s.type = "text/javascript";
        s.src = chrome.extension.getURL("index.user.js");
        document.head.appendChild(s);
    }
    document.head.appendChild(jquery);
})();
