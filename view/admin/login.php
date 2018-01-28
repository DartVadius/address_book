<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <?php if (!empty($error_message)): ?>
            <p style="text-align: center; color: red"><?=$error_message?></p>
        <?php endif; ?>
    </div>
    <div class="col-lg-3"></div>
</div>
<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6" style="border:1px solid black; padding: 5px">
        <p style="text-align: center"><b style="font-size: 18px">Login</b</p>
    </div>
    <div class="col-lg-3"></div>
</div>
<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6" style="border:1px solid black; padding: 5px">
        <form method="post" action="/admin/login" name="login_form">
            <div class="row" style="padding: 5px">
                <div class="col-lg-6" style="text-align: right; font-size: 18px"><b>Login:</b></div>
                <div class="col-lg-6"><input type="text" size="20" name="login"></div>
            </div>
            <div class="row" style="padding: 5px">
                <div class="col-lg-6" style="text-align: right; font-size: 18px"><b>Password:</b></div>
                <div class="col-lg-6"><input type="password" size="20" name="password"></div>
            </div>
            <div class="row" style="padding: 5px">
                <div class="col-lg-6"></div>
                <div class="col-lg-6"><input type="submit" value="Login"></div>
            </div>
        </form>
    </div>
    <div class="col-lg-3"></div>
</div>