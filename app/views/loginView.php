<h1>Логин</h1>
<p id="error_msg"></p>
<form action="/admin/loginform" method="post" id="login_form">
    <label>Логин</label>
    <input type="text" name="login" placeholder="Логин"><br>
    <label>Пароль</label>
    <input type="password" name="password" placeholder="Пароль"><br>
    <input type="button" value="Войти" id="loginForm_btn">
</form>
<script src="/resources/js/login.js"></script>