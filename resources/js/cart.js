document.getElementById('ItemAddToCart_lnk').addEventListener('click', function(){
    let	id_product = document.getElementById('ItemAddToCart_lnk').getAttribute('data-id');
    let qty_product = document.getElementById('ItemsCount_inp').value;

    const request = new XMLHttpRequest();
    const url = "/cart/add";
    const params = "id=" + id_product+ "&count=" + qty_product;

    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.addEventListener("readystatechange", () => {
        if(request.readyState === 4 && request.status === 200) {
            document.getElementById('ItemsCount_spn').innerText = request.responseText;
        }
    });

    request.send(params);
});

