var oReq = new XMLHttpRequest();

oReq.responseType = "json";
oReq.onload = function() {
    const objects = oReq.response;
    objects.sort(function(a,b) {
        return a.id - b.id;
    });
    for (var i = 0; i < objects.length; i += 1) {
        var form = document.getElementById("delete-button-form");
        var div = document.createElement("div");
        div.setAttribute("id", objects[i].id);
        div.setAttribute("class", "product");
        form.appendChild(div);
        var checkbox = document.createElement("input");
        checkbox.setAttribute("class", "delete-checkbox");
        checkbox.setAttribute("type", "checkbox");
        checkbox.setAttribute("name", objects[i].id);
        div.appendChild(checkbox);
        var div2 = document.createElement("div");
        div2.setAttribute("class", "data");
        div.appendChild(div2);
        var sku = document.createElement("label");
        sku.innerHTML = objects[i].sku;
        div2.appendChild(sku);
        var name = document.createElement("label");
        name.innerHTML = objects[i].name;
        div2.appendChild(name);
        var price = document.createElement("label");
        price.innerHTML = objects[i].price + "$";
        div2.appendChild(price);
        var params = document.createElement("label");
        params.innerHTML = objects[i].paramName + ": " + objects[i].parameters;
        div2.appendChild(params);
    }
};
oReq.open("post", "https://juniortest-erik-gerbreder.000webhostapp.com/main.php", true);
oReq.send();