<div id="login">
    <?php if ($sf_user->hasFlash('login_error')): ?>
        <p id="login-error"><?php echo $sf_user->getFlash('login_error') ?></p>
    <?php endif; ?>
    <form action="<?php echo url_for('/user/login') ?>" method="post">
        <div class="field">
            <label for="username">Username</label>
            <input type="text" name="username" />
        </div>
        <div class="field">
            <label for="password">Password</label>
            <input type="password" name="password" />
        </div>
        <input type="submit" value="Login" />
    </form>
</div>