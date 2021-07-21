document.getElementById('makeOrder_btn').addEventListener('click', function(){
    console.log('sent');
    const url = "/cart/saveorder";
    let form = document.getElementById('checkout_form');
    let data = new FormData(form);

    const request = new XMLHttpRequest();
    request.open("POST", url, true);
    request.addEventListener("readystatechange", () => {
        if(request.readyState === 4 && request.status === 200) {
            console.log(request.responseText);
            document.getElementById('ItemsCount_spn').innerText = "0";
            form.style.display = 'none';
            document.getElementById('completed').innerText = "Заказ добавлен. Вы можете отследить его по <a href='/product/track?id="+request.responseText+"'> сылке </a>";
        }
    });

    request.send(data);
});