var oReq = new XMLHttpRequest();
    oReq.responseType = "json";
    oReq.onload = function() {
        const objects = oReq.response;
        for (var i = 0; i <objects.length; i+=1) {
            var meta = document.createElement("input");
            meta.setAttribute("id", objects[i].sku);
            meta.setAttribute("type", "hidden");
            meta.setAttribute("value", objects[i].sku);
            document.getElementById("product_form").appendChild(meta);
        }
    }
    oReq.open("post", "http://localhost/ScandiWeb_webDeveloper/main.php", true);
    oReq.send();