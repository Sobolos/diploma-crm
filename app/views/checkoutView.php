<form id="checkout_form" method="post">
    <label>Имя</label>
    <input type="text" id="clientName_inp" name="name" required><br>
    <label>Фамилия</label>
    <input type="text" id="clientSurname_inp" name="surname" required><br>
    <label>Телефон</label>
    <input type="text" id="clientPhone_inp" name="phone" required><br>
    <label>E-mail</label>
    <input type="email" id="clientEmail_inp" name="email" required><br>
    <label>Страна</label>
    <input type="text" id="clientCountry_inp" name="country" required><br>
    <label>Город</label>
    <input type="text" id="clientCity_inp" name="city" required><br>
    <label>Улица</label>
    <input type="text" id="clientStreet_inp" name="street" required><br>
    <label>Дом</label>
    <input type="text" id="clientHose_inp" name="house" required><br>
    <label>Подъезд</label>
    <input type="text" id="clientEntrance_inp" name="entrance"><br>
    <label>Квартира</label>
    <input type="text" id="clientApartment_inp" name="apartment"><br>
    <input type="button" id="makeOrder_btn" value="Оформить">
</form>
<p id="completed"></p>
<script src="/resources/js/checkout.js"></script>