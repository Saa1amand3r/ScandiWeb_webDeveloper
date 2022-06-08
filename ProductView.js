var oReq = new XMLHttpRequest(); // New request object

oReq.responseType = "json";
oReq.onload = function() {
    if (oReq.status != 200) {
        alert (oReq.status);
    }else {
        const object = oReq.response;
        for (var i = 0; i < object.length; i += 1) {
            var form = document.getElementById("delete-button-form");
            var div = document.createElement("div");
            div.setAttribute("id", object[i].id);
            div.setAttribute("class", "product");
            form.appendChild(div);
            var checkbox = document.createElement("input");
            checkbox.setAttribute("class", "delete-checkbox");
            checkbox.setAttribute("type", "checkbox");
            checkbox.setAttribute("name", object[i].id);
            div.appendChild(checkbox);
            var div2 = document.createElement("div");
            div2.setAttribute("class", "data");
            div.appendChild(div2);
            var sku = document.createElement("label");
            sku.innerHTML = object[i].sku;
            div2.appendChild(sku);
            var name = document.createElement("label");
            name.innerHTML = object[i].name;
            div2.appendChild(name);
            var price = document.createElement("label");
            price.innerHTML = object[i].price;
            div2.appendChild(price);
            var params = document.createElement("label");
            params.innerHTML = object[i].paramName + ": " + object[i].parameters;
            div2.appendChild(params);
        }
    }
};
oReq.open("post", "http://localhost/ScandiWeb_webDeveloper/script.php", true);
oReq.send();