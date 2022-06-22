const submit = document.getElementById("save-btn");
submit.addEventListener("click", validateForm);
const skuInput = document.getElementById("sku");
skuInput.addEventListener("change", validateForm);

function validateForm(e) {
    var valid= true;
    const skuError = document.getElementById("sku-error");
    var sku = skuInput.value;
    if (document.getElementById(sku) ) {
        e.preventDefault();
        skuError.classList.add("visible");
        valid=false;
        return valid;
    } 
    else {
        skuError.classList.remove("visible");
    }
    return valid;
}