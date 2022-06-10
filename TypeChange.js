function selectType() {
    var selectedValue = document.getElementById("productType").value;
    var typeForm = document.getElementById("typeForm");
    var html = "view/" + selectedValue + "Type.html";
    typeForm.innerHTML = "";
    fetch(html)
        .then(response=> response.text())
        .then(text=> typeForm.innerHTML = text);
}