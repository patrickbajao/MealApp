<div id="login-form">
    <h2 class="title">Login</h2>
    <form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
        <?php if($form->hasErrors()): ?>
            <p class="error">Please enter your correct username and password.</p>
        <?php endif; ?>
        <p class="notes">
            Login using your LunchApp account. Don't have an account yet? <?php echo link_to('Register now!', '@register') ?>
        </p>
        <div>
            <?php echo $form['username']->renderLabel() ?>
            <?php echo $form['username']->render() ?>
        </div>
        <div>
            <?php echo $form['password']->renderLabel() ?>
            <?php echo $form['password']->render() ?>
        </div>
        <?php echo $form['_csrf_token']->render() ?>
        <input type="submit" value="Login" />
    </form>
    <form action="<?php echo url_for('@openid_signin') ?>" method="post" id="openid">
        <?php if($sf_user->hasFlash('error')): ?>
            <p class="error"><?php echo $sf_user->getFlash('error') ?></p>
        <?php endif; ?>
        <p class="notes">
            Login using your OpenID account then register it as an LunchApp account!
        </p>
        <div>
            <label for="openid">OpenID</label>
            <input type="text" name="openid" />
        </div>
        <input type="submit" value="Login OpenID" />
    </form>
</div>