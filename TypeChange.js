function selectType() {
    var selectedValue = document.getElementById("productType").value;
    var typeForm = document.getElementById("typeForm");
    var html = "view/" + selectedValue + ".html"; // need to input http address
    typeForm.innerHTML = "";
    fetch(html)
        .then(response=> response.text())
        .then(text=> typeForm.innerHTML = text);

// we can use fetch here if we have remote server
}