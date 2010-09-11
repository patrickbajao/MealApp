<div id="login-form">
    <h2 class="title">Login</h2>
    <form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
        <?php if($form->hasErrors()): ?>
            <p class="error">Please enter your correct username and password.</p>
        <?php endif; ?>
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
</div>