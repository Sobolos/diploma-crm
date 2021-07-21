/**
 * Закрепляет дилера за закзом
 */
function takeInWork(e) {
    console.log('click');
    let id = e.dataset.orderid;
    const url = "/admin/takeinwork";
    let data = 'orderId='+id;

    const request = new XMLHttpRequest();
    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.addEventListener("readystatechange", () => {
        if(request.readyState === 4 && request.status === 200) {
            console.log(request.responseText)
            window.location.reload();
        }
    });

    request.send(data);
}

/**
 * Отметить товар для заказа
 */
function makeOrderItem(e) {
    let itemCount = e.dataset.itemcount;
    let itemId = e.dataset.itemid;
    let orderId = e.dataset.orderid;
    const url = "/admin/makeorderitem";
    let data = "&itemCount="+itemCount+"&itemId="+itemId+"&orderId="+orderId;

    const request = new XMLHttpRequest();
    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.addEventListener("readystatechange", () => {
        if(request.readyState === 4 && request.status === 200) {
            console.log(request.responseText)
            window.location.reload();
            document.getElementById('manufacturing_status').innerText = "Товар отправлен на производство";
        }
    });

    request.send(data);
}

/**
 * Укомплектовать товар в заказ
 */
function completeOrderItem(e) {
    let id = e.dataset.orderid;
    let itemCount = e.dataset.itemcount;
    let itemId = e.dataset.itemid;
    const url = "/admin/completeorderitem";
    let data = 'orderId='+id+"&itemCount="+itemCount+"&itemId="+itemId;

    const request = new XMLHttpRequest();
    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.addEventListener("readystatechange", () => {
        if(request.readyState === 4 && request.status === 200) {
            console.log(request.responseText)
            window.location.reload();
        }
    });

    request.send(data);
}

/**
 * Заказ укомплектован
 */
function CompleteOrder(e) {
    let id = e.dataset.orderid;
    const url = "/admin/completeorder";
    let data = 'orderId='+id;

    const request = new XMLHttpRequest();
    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.addEventListener("readystatechange", () => {
        if(request.readyState === 4 && request.status === 200) {
            console.log(request.responseText)
            window.location.reload();
        }
    });

    request.send(data);
}

/**
 * Заказ завершен
 */
function FinishOrder(e) {
    let id = e.dataset.orderid;
    const url = "/admin/finishorder";
    let data = 'orderId='+id;

    const request = new XMLHttpRequest();
    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.addEventListener("readystatechange", () => {
        if(request.readyState === 4 && request.status === 200) {
            console.log(request.responseText)
            window.location.reload();
        }
    });

    request.send(data);
}

/**
 * Товар произведен
 */
function completeManufacturingItem(e) {
    let id = e.dataset.orderid;
    let itemCount = e.dataset.itemcount;
    let itemId = e.dataset.itemid;
    const url = "/admin/completemanufacturingitem";
    let data = 'orderId='+id+"&itemCount="+itemCount+"&itemId="+itemId;

    const request = new XMLHttpRequest();
    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.addEventListener("readystatechange", () => {
        if(request.readyState === 4 && request.status === 200) {
            console.log(request.responseText)
            window.location.reload();
        }
    });

    request.send(data);
}

function finishManufacturingOrder(e) {
    let id = e.dataset.orderid;
    let dealerId = e.dataset.dealerid;
    const url = "/admin/finishmanufacturingorder";
    let data = 'orderId='+id+"&dealerId="+dealerId;

    const request = new XMLHttpRequest();
    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.addEventListener("readystatechange", () => {
        if(request.readyState === 4 && request.status === 200) {
            console.log(request.responseText)
            window.history.back();
        }
    });

    request.send(data);
}