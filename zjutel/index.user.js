function open() {
    var img = $("font").find("img");
    img.each(function(k,v){
        if (v.src.indexOf("w.gif") != -1) {
            var p1 = $(this).parents("tr").children("td").length;
            var p2 = $(this).parents("tr").next().children("td").length;
            if (p1 >= p2) {
                var c = this.parentNode.attributes[0];
                var urlS = c.childNodes[0].textContent;
                var idx = urlS.indexOf("?", 0)
                var url = urlS.substr(idx, urlS.length - idx - 2);
                var a = document.createElement("a");
                a.href = url;
                document.body.appendChild(a);
                a.click();
                return false;
            }
        }
    });
}
window.setTimeout(open, 300);